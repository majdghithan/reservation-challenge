<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateReservation extends Component
{
    public Room $room;
    public int $room_price;

    public int $total_price;

    #[Validate('required|string|min:3|max:100')]
    public string $name = 'John Doe';

    #[Validate('required|email')]
    public string $email = 'majd@gmail.com';

    #[Validate('required|string|min:3|max:255')]
    public string $phone= '1234567890';

    #[Validate('required|date|after:yesterday')]
    public string $start_date = '01/10/2024';

    #[Validate('required|date|after:start_date')]
    public string $end_date = '01/11/2024';

    #[Validate('required|integer|min:1')]
    public int $persons = 1;

    #[Validate('nullable|string|max:255')]
    public string $notes;

    #[Validate('nullable|exists:features,id')]
    public array $features = [];

    public function mount(): void
    {
        $this->room_price = $this->room->current_price;
        $this->total_price = $this->room_price;

        $this->room->load('features');
    }

    public function save()
    {
        $data = $this->validate();

        $data['season_id'] = $this->room->current_season->id;
        $data['room_id'] = $this->room->id;

        //assuming that the reservation is paid
        $data['is_paid'] = true;

        $end_date = Carbon::parse($data['end_date'])->subDay()->format('Y-m-d');
        $start_date = Carbon::parse($data['start_date'])->addDay()->format('Y-m-d');

        $isAvailable = Reservation::where('room_id', $this->room->id)
            ->where(function (Builder $query) use ($start_date, $end_date) {
                    $query->whereBetween('start_date', [$start_date, $end_date])
                        ->orWhereBetween('end_date', [$start_date, $end_date])
                ->orWhere(function($query) use($start_date, $end_date){
                    $query->where('start_date','<=',$start_date)
                        ->where('end_date','>=',$end_date);
        });
            })
            ->get();

        dd($isAvailable);

        if($data['season_id'] == null){
            $this->addError('start_date', 'This season is not available. Please contact the admin.');
            return;
        }

        $features_price = $this->getFeaturesPrice($data['features']);

        $data['price'] = $this->room_price + $features_price;

        $reservation = $this->room->reservations()->create($data);

        foreach ($this->features as $feature) {
            $reservation->features()->attach(
                [$feature => ['price' => $this->room->features()->where('feature_id', $feature)->first()->pivot->price]]
            );
        }

        $this->reset();

        session()->put('message', 'Reservation successfully saved.');
        return redirect()->route('success');
    }

    public function updated($name, $value)
    {
        $this->total_price = $this->room_price + $this->getFeaturesPrice($this->features);
    }
    public function render(): \Illuminate\View\View
    {
        return view('livewire.create-reservation');
    }

    private function getFeaturesPrice($features)
    {
        return $this->room->features()->whereIn('feature_id', $features)->sum('price');
    }
}

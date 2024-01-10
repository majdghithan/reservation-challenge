<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class ShowRoom extends Component
{

    public Room $room;
    public $price;

    public function mount(): void
    {
        $this->price = $this->room->current_price;
        $this->room->load('features', 'seasons');
    }
    public function render(): \Illuminate\View\View
    {
        return view('livewire.show-room');
    }
}

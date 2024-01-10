<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Services\AddSeason;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;


class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    #[On('refreshPrices')]
    public function refresh(): void
    {
        $this->js('window.location.reload()');
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        return AddSeason::AddSeasonID($data);
    }
}

<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Services\AddSeason;
use Filament\Resources\Pages\CreateRecord;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        return AddSeason::AddSeasonID($data);
    }


}

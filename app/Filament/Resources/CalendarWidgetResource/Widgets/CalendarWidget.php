<?php

namespace App\Filament\Resources\CalendarWidgetResource\Widgets;

use App\Filament\Resources\ReservationResource;
use App\Models\Reservation;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{

    public function fetchEvents(array $info): array
    {
        return Reservation::query()
            ->where('start_date', '>=', $info['start'])
            ->where('end_date', '<=', $info['end'])
            ->get()
            ->map(
                fn (Reservation $reservation) => [
                    'title' => $reservation->room?->name . ' - ' . $reservation->name,
                    'start' => $reservation->start_date,
                    'end' => $reservation->end_date,
                    'url' => ReservationResource::getUrl(name: 'edit', parameters: ['record' => $reservation->id]),
                    'shouldOpenUrlInNewTab' => false
                ]
            )
            ->all();
    }

}

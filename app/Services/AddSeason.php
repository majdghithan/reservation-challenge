<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AddSeason
{
    public static function AddSeasonID($data): array
    {
        $season = DB::table('seasons')
            ->where('start_date', '<=', $data['start_date'])
            ->where('end_date', '>=', $data['end_date'])
            ->first();

        $room_season = DB::table('room_season')
            ->where('room_id', $data['room_id'])
            ->where('season_id', $season?->id)
            ->first();

        if($room_season) {
            $data['season_id'] = $season->id;
        }

        return $data;
    }

}

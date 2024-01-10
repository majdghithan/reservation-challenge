<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //can make cron job to update this every year and updating the dates to be taken from current year for example, for this challenge this is static without much validation...
        $seasons = [
            'Winter' => [
                'start_date' => '2024-01-01',
                'end_date' => '2024-03-31',
            ],
            'Spring' => [
                'start_date' => '2024-04-01',
                'end_date' => '2024-06-30',
            ],
            'Summer' => [
                'start_date' => '2024-07-01',
                'end_date' => '2024-09-30',
            ],

            'Autumn' => [
                'start_date' => '2024-10-01',
                'end_date' => '2024-12-31',
            ],
        ];

        foreach ($seasons as $name => $dates) {
            Season::create([
                'name' => $name,
                'start_date' => $dates['start_date'],
                'end_date' => $dates['end_date'],
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options=[
            'Breakfast',
            'Lunch',
            'Dinner',
            'Wifi',
            'TV',
            'Air Conditioning',
            'Heating',
            'Kitchen',
            'Parking',
            'Elevator',
            'Gym',
            'Pool',
        ];

        foreach ($options as $option) {
            Feature::create([
                'name' => $option,
                'description' => 'Description '.$option,
            ]);
        }
    }
}

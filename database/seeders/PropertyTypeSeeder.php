<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            'House',
            'Apartment',
            'Condo',
            'Townhome',
            'Multi-Family',
            'Land',
            'Mobile Home',
            'Farm',
            'Other',
        ];
        foreach ($options as $option) {
            PropertyType::create([
                'name' => $option,
            ]);
        }
    }
}

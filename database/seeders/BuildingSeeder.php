<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::create([
            'name' => 'Building 1',
            'exact_address' => 'Address 1',
            'city' => 'City 1',
            'description' => 'Description 1',
            'featured_image' => 'https://via.placeholder.com/150',
            'property_type_id' => 1,
            'user_id' => 2,
        ]); //1

        Building::create([
            'name' => 'Building 2',
            'exact_address' => 'Address 2',
            'city' => 'City 2',
            'description' => 'Description 2',
            'featured_image' => 'https://via.placeholder.com/150',
            'property_type_id' => 2,
            'user_id' => 2,
        ]); //2

        Building::create([
            'name' => 'Building 3',
            'exact_address' => 'Address 3',
            'city' => 'City 3',
            'description' => 'Description 3',
            'featured_image' => 'https://via.placeholder.com/150',
            'property_type_id' => 3,
            'user_id' => 3,
        ]); //3

        Building::create([
            'name' => 'Building 4',
            'exact_address' => 'Address 4',
            'city' => 'City 4',
            'description' => 'Description 4',
            'featured_image' => 'https://via.placeholder.com/150',
            'property_type_id' => 4,
            'user_id' => 3,
        ]); //4
    }
}

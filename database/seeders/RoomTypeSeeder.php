<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            'Single Room',
            'Double Room',
            'Triple Room',
            'Quad Room',
            'Queen Room',
            'King Room',
            'Twin Room',
            'Double-double Room',
            'Studio',
            'Master Suite',
        ];

        foreach ($options as $option) {
            RoomType::create([
                'name' => $option,
                'description' => 'Description ' . $option,
            ]);
        }
    }
}

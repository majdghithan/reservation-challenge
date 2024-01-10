<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room_1 = Room::create([
            'name' => 'Room 1',
            'description' => 'Room 1 description',
            'image' => 'https://via.placeholder.com/150',
            'room_type_id' => 1,
            'building_id' => 1,
        ]); //1

        $room_1->features()->attach(
            [
                1 => ['price' => 100],
                2 => ['price' => 200],
                3 => ['price' => 300],
            ]
        );

        $room_1->seasons()->attach(
            [
                1 => ['price' => 100],
                2 => ['price' => 200],
                3 => ['price' => 300],
                4 => ['price' => 400],
            ]
        );

        $room_2 = Room::create([
            'name' => 'Room 2',
            'description' => 'Room 2 description',
            'image' => 'https://via.placeholder.com/150',
            'room_type_id' => 2,
            'building_id' => 2,
        ]); //2

        $room_2->features()->attach(
            [
                4 => ['price' => 100],
                5 => ['price' => 200],
                6 => ['price' => 300],
            ]
        );

        $room_2->seasons()->attach(
            [
                1 => ['price' => 120],
                2 => ['price' => 250],
                3 => ['price' => 360],
                4 => ['price' => 410],
            ]
        );

        $room_3 = Room::create([
            'name' => 'Room 3',
            'description' => 'Room 3 description',
            'image' => 'https://via.placeholder.com/150',
            'room_type_id' => 3,
            'building_id' => 3,
        ]); //3

        $room_3->features()->attach(
            [
                7 => ['price' => 100],
                8 => ['price' => 200],
                9 => ['price' => 300],
            ]
        );

        $room_3->seasons()->attach(
            [
                1 => ['price' => 130],
                2 => ['price' => 260],
                3 => ['price' => 370],
                4 => ['price' => 420],
            ]
        );

        $room_4 = Room::create([
            'name' => 'Room 4',
            'description' => 'Room 4 description',
            'image' => 'https://via.placeholder.com/150',
            'room_type_id' => 4,
            'building_id' => 4,
        ]); //4

        $room_4->features()->attach(
            [
                2 => ['price' => 100],
                10 => ['price' => 200],
                4 => ['price' => 300],
            ]
        );

        $room_4->seasons()->attach(
            [
                1 => ['price' => 140],
                2 => ['price' => 270],
                3 => ['price' => 380],
                4 => ['price' => 430],
            ]
        );
    }
}

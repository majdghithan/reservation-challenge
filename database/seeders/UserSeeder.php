<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@majd.com',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin'); //1

        User::create([
            'name' => 'Employee 1',
            'email' => 'employee1@majd.com',
            'password' => bcrypt('password'),
        ])->assignRole('employee'); //2

        User::create([
            'name' => 'Employee 2',
            'email' => 'employee2@majd.com',
            'password' => bcrypt('password'),
        ])->assignRole('employee'); //3
    }
}

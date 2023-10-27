<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'id' => 1,
            'role' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'name' => 'admin',
            'phone' => '082121495806',
            'entrance_date' => now()->format('Y-m-d'),
            'salary' => 'Rp. 1.500.00',
            'status' => 'active',
        ]);
        
        User::insert([
            'id' => 2,
            'role' => 4,
            'email' => 'tailor1@gmail.com',
            'password' => Hash::make('Aggygga13@'),
            'name' => 'tailor1',
            'phone' => '082121495806',
            'entrance_date' => now()->format('Y-m-d'),
            'salary' => 'Rp. 1.500.00',
            'status' => 'active',
        ]);
    }
}

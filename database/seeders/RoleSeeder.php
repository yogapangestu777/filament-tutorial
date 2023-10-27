<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            'id' => 1,
            'name' => 'leader',
        ]);
        Role::insert([
            'id' => 2,
            'name' => 'admin',
        ]);
        Role::insert([
            'id' => 3,
            'name' => 'cutting',
        ]);
        Role::insert([
            'id' => 4,
            'name' => 'operator',
        ]);
    }
}

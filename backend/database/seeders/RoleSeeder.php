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
            'name' => 'Admin',
            'description' => 'Administrator role',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Role::insert([
            'name' => 'User',
            'description' => 'Regular user role',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

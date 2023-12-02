<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            'name' => 'View',
            'description' => 'Permission to view content',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Permission::insert([
            'name' => 'Edit',
            'description' => 'Permission to edit content',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Permission::insert([
            'name' => 'Create',
            'description' => 'Permission to Create content',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Permission::insert([
            'name' => 'Delete',
            'description' => 'Permission to Delete content',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

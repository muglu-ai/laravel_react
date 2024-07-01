<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'role_key' => 'admin',
            'description' => 'Admin role'
        ]);
        Role::create([
            'name' => 'User',
            'role_key' => 'user',
            'description' => 'User role'
        ]);
        Role::create([
            'name' => 'Viewer',
            'role_key' => 'viewer',
            'description' => 'Viewer role'
        ]);
    }
}

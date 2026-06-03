<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
{
    \App\Models\User::factory()->create([
        'name' => 'Super Admin',
        'email' => 'super@admin.com',
        'role' => 'super_admin',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::factory()->create([
        'name' => 'Admin Hotel',
        'email' => 'admin@hotel.com',
        'role' => 'admin_hotel',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::factory()->create([
        'name' => 'Usuario',
        'email' => 'user@test.com',
        'role' => 'user',
        'password' => bcrypt('password'),
    ]);
}
}

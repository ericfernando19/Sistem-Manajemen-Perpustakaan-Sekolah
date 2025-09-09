<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin Perpus',
            'email' => 'admin@perpus.test',
            'role' => 'admin',
        ]);

        // 5 user biasa
        User::factory(5)->create([
            'role' => 'user',
        ]);
    }
}

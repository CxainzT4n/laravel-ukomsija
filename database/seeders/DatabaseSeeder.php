<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'pangestu',
            'username' => 'gestu',
            'password' => Hash::make('user123'),
            'level' => 'user',
        ]);
        User::create([
            'name' => 'Administrator',
            'username' => 'Admin',
            'password' => Hash::make('admin123'),
            'level' => 'administrator',
        ]);
    }
}

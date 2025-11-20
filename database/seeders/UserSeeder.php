<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@news.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Penulis
        User::create([
            'name' => 'Jurnalis 1',
            'email' => 'penulis@news.com',
            'password' => Hash::make('password'),
            'role' => 'penulis'
        ]);
    }
}
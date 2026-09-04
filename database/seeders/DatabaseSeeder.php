<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder-seeder lain
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PartnerSeeder::class,
        ]);
    }
}

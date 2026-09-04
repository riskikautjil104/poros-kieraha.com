<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'HeartWare Digital',
                'category' => 'Media Partner',
                'image_url' => 'https://poros-kieraha.com/assets/img/logo/hr.png',
                'link' => null,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Partner Name 2',
                'category' => 'Technology',
                'image_url' => 'https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg',
                'link' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Partner Name 3',
                'category' => 'Business',
                'image_url' => 'https://poros-kieraha.com/assets/img/logo/hr.png',
                'link' => null,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Partner Name 4',
                'category' => 'Education',
                'image_url' => 'https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg',
                'link' => null,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Partner Name 5',
                'category' => 'Healthcare',
                'image_url' => 'https://poros-kieraha.com/assets/img/logo/hr.png',
                'link' => null,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Partner Name 6',
                'category' => 'Finance',
                'image_url' => 'https://i.pinimg.com/736x/6e/1f/75/6e1f7515e2a7e0bc6bd0fb74e64a94ae.jpg',
                'link' => null,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        \DB::table('partners')->truncate();
        \DB::table('partners')->insert($partners);
    }
}


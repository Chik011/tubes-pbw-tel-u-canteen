<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::insert([
            [
                'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng spesial',
                'price' => 18000,
                'image' => 'naci_oyeng.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayam Bakar',
                'description' => 'Ayam bakar rempah',
                'price' => 18000,
                'image' => 'ayam_bakar.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sate Ayam',
                'description' => 'Sate ayam bumbu kacang',
                'price' => 25000,
                'image' => 'sate_ayam.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bakso daging Sapi dengan Mie',
                'description' => 'Bakso daging sapi kenyal dengan mie segar',
                'price' => 15000,
                'image' => 'bakso.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi ayam goreng',
                'description' => 'nasi ayam goreng enak',
                'price' => 15000,
                'image' => 'ayam_oyeng.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soto ayam',
                'description' => 'Soto ayam enak',
                'price' => 18000,
                'image' => 'soto_ayam.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gado Gado',
                'description' => 'Gado Gado',
                'price' => 18000,
                'image' => 'gado.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Ayam',
                'description' => 'Mie Ayam enak',
                'price' => 18000,
                'image' => 'mi_ayam.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rendang',
                'description' => 'Rendang daging sapi pedas',
                'price' => 18000,
                'image' => 'rendang.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Goreng Telor',
                'description' => 'Mie Goreng Telor',
                'price' => 10000,
                'image' => 'mie_goreng.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        [
            'name' => 'Picang Oyeng Anet',
            'description' => 'Picang Oyeng Anet Enyak',
            'price' => 6000,
            'image' => '1767603811_68d37921c8b99.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);
    }
}

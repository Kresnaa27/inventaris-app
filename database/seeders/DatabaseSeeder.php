<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin & User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@inventaris.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dewa (User)',
            'email' => 'dewa@inventaris.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 2. Buat Contoh Data Barang Awal
        Item::create([
            'code' => 'BRG-001',
            'name' => 'Kamera Canon EOS 80D',
            'category' => 'Elektronik',
            'stock' => 5,
        ]);

        Item::create([
            'code' => 'BRG-002',
            'name' => 'Laptop ASUS TUF Gaming',
            'category' => 'Elektronik',
            'stock' => 3,
        ]);
    }
}
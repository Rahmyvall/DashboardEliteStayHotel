<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // HAPUS DATA LAMA BIAR TIDAK BENTROK (PENTING)
        User::whereIn('email', [
            'admin@gmail.com',
            'resepsionis@gmail.com',
            'pelanggan@gmail.com',
        ])->delete();

        // ADMIN
        User::create([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'no_hp' => '081111111111',
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // RESEPSIONIS
        User::create([
            'nama_lengkap' => 'Resepsionis Hotel',
            'email' => 'resepsionis@gmail.com',
            'password' => Hash::make('resepsionis12345'),
            'no_hp' => '082222222222',
            'role' => 'resepsionis',
            'status' => 'aktif',
        ]);

        // PELANGGAN
        User::create([
            'nama_lengkap' => 'Pelanggan',
            'email' => 'pelanggan@gmail.com',
            'password' => Hash::make('pelanggan12345'),
            'no_hp' => '083333333333',
            'role' => 'pelanggan',
            'status' => 'aktif',
        ]);
    }
}

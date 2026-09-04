<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\User;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID user pertama yang ada di database
        $user = User::first();

        // Pastikan user ada sebelum insert
        if ($user) {
            Jenis::create([
                'nama_jenis' => 'Makanan',
                'user_id'    => $user->id, // Tambahkan baris ini
            ]);

            Jenis::create([
                'nama_jenis' => 'Minuman',
                'user_id'    => $user->id, // Tambahkan baris ini
            ]);
        }
    }
}
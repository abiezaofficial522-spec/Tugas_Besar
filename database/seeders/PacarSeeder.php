<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pacar;

class PacarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pacar::create([
            'nama' => 'Jule',
            'usia' => 25,
            'alamat' => 'Jakarta',
            'pekerjaan' => 'Mahasiswa',
            'hobi' => 'Membaca',
        ]);

        Pacar::create([
            'nama' => 'Lucinta',
            'usia' => 24,
            'alamat' => 'Bandung',
            'pekerjaan' => 'Designer',
            'hobi' => 'Melukis',
        ]);

        Pacar::create([
            'nama' => 'Cecep',
            'usia' => 26,
            'alamat' => 'Surabaya',
            'pekerjaan' => 'Programmer',
            'hobi' => 'Coding',
        ]);
    }
}

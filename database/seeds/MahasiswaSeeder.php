<?php

use Illuminate\Database\Seeder;
use App\Angkatan;
use App\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $angkatans = Angkatan::select('tahun')
            ->pluck('tahun');

        foreach ($angkatans as $angkatan) {
            factory(Mahasiswa::class, 40)
                ->create(['angkatan' => $angkatan]);
        }
    }
}

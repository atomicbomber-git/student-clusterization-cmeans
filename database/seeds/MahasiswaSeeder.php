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
        $angkatan_ids = Angkatan::select('id')
            ->pluck('id');

        foreach ($angkatan_ids as $angkatan_id) {
            factory(Mahasiswa::class, 40)
                ->create(['angkatan_id' => $angkatan_id]);
        }
    }
}

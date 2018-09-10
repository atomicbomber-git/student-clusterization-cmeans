<?php

use Illuminate\Database\Seeder;
use App\TahunAjaran;
use App\Mahasiswa;
use App\Nilai;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ganjil_genap = ['GANJIL', 'GENAP'];

        $tahun_ajarans = TahunAjaran::select('nama')
            ->pluck('nama');

        $mahasiswas = Mahasiswa::select('NIM')
            ->pluck('NIM');

        foreach ($tahun_ajarans as $tahun_ajaran) {
            foreach ($ganjil_genap as $gg) {
                foreach ($mahasiswas as $mahasiswa) {
                    $test = factory(Nilai::class)->create([
                        'NIM' => $mahasiswa,
                        'ganjil_genap' => $gg,
                        'tahun_ajaran' => $tahun_ajaran
                    ]);
                    
                }
            }
        }
    }
}

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

        $tahun_ajaran_ids = TahunAjaran::select('id')
            ->pluck('id');

        $mahasiswa_ids = Mahasiswa::select('id')
            ->pluck('id');

        foreach ($tahun_ajaran_ids as $tahun_ajaran_id) {
            foreach ($ganjil_genap as $gg) {
                foreach ($mahasiswa_ids as $mahasiswa_id) {
                    $test = factory(Nilai::class)->create([
                        'mahasiswa_id' => $mahasiswa_id,
                        'ganjil_genap' => $gg,
                        'tahun_ajaran_id' => $tahun_ajaran_id
                    ]);
                    
                }
            }
        }
    }
}

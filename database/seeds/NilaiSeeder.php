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

        $tahun_ajarans = TahunAjaran::select('id', 'tahun_mulai')
            ->get();

        $mahasiswas = Mahasiswa::select('id', 'angkatan_id')
            ->with('angkatan:id,tahun')
            ->get();

        foreach ($tahun_ajarans as $tahun_ajaran) {
            foreach ($ganjil_genap as $gg) {
                foreach ($mahasiswas as $mahasiswa) {
                    if ($mahasiswa->angkatan->tahun <= $tahun_ajaran->tahun_mulai) {
                        $test = factory(Nilai::class)->create([
                            'mahasiswa_id' => $mahasiswa->id,
                            'ganjil_genap' => $gg,
                            'tahun_ajaran_id' => $tahun_ajaran->id
                        ]);
                    }
                }
            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start_year = 2013;
        $end_year = 2018;

        for ($i = $start_year; $i <= $end_year; ++$i) {
            TahunAjaran::create([
                'tahun_mulai' => $i,
                'tahun_selesai' => $i + 1
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Angkatan;

class AngkatanSeeder extends Seeder
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

        for ($i = $start_year; $i < $end_year; ++$i) {
            Angkatan::create(['tahun' => $i]);
        }

    }
}

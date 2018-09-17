<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(AngkatanSeeder::class);
        $this->call(TahunAjaranSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(NilaiSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Angkatan;
use App\Mahasiswa;
use App\User;

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

            $users = factory(User::class, 40)->create(['type' => 'mahasiswa']);

            foreach ($users as $user) {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'angkatan_id' => $angkatan_id,
                    'NIM' => $user->username
                ]);
            }
        }
    }
}

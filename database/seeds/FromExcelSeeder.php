<?php

use Illuminate\Database\Seeder;
use App\Imports\DataImport;
use App\Angkatan;
use App\User;
use App\Mahasiswa;
use App\TahunAjaran;
use App\Nilai;

class FromExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Seed admin
        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => bcrypt('admin'),
            'type' => 'administrator'
        ]);

        $data = (new DataImport)->toCollection('data.xls')->first();
        
        $columns = [
            'NIM' => 0,
            'nama' => 1,
            'tahun_ajaran' => 2,
            'semester' => 3,
            'perkuliahan' => 4,
            'ips' => 5,
            'ipk' => 6
        ];

        // Remove the first row, which contains the header
        $data->shift();

        $mahasiswa_angkatan_map = $data->groupBy($columns['NIM'])
            ->map(function($mahasiswa, $NIM) use($columns) {
                $mahasiswa = $mahasiswa->sortBy($columns['tahun_ajaran']);
                $angkatan = explode("/", $mahasiswa->first()[$columns['tahun_ajaran']])[0]; 
                
                return [
                    'NIM' => $NIM,
                    'angkatan' => $angkatan
                ];
            });

        $angkatans = $mahasiswa_angkatan_map->unique('angkatan')
            ->mapWithKeys(function($record) {
                $angkatan_id = Angkatan::create(['tahun' => $record['angkatan']])->id;
                return [$record['angkatan'] => $angkatan_id];
            });

        // Extract student data and seed
        $unique_students = $data->unique($columns['NIM']);

        $tahun_ajarans = $data->unique($columns['tahun_ajaran'])
            ->pluck($columns['tahun_ajaran'])
            ->map(function($record) {

                $result = [];
                $result['code'] = $record;

                $temp = explode("/", $record);
                $result['id'] = TahunAjaran::create([
                    'tahun_mulai' => $temp[0],
                    'tahun_selesai' => $temp[1]
                ])->id;
                
                return $result;
            })
            ->keyBy('code');

        foreach ($unique_students as $student) {
            $user = User::create([
                'name' => $student[$columns['nama']],
                'username' => $student[$columns['NIM']],
                'password' => bcrypt($student[$columns['NIM']]),
                'type' => 'mahasiswa'
            ]);

            $mahasiswa = Mahasiswa::create([
                'user_id' => $user->id,
                'angkatan_id' => $angkatans[$mahasiswa_angkatan_map[$student[$columns['NIM']]]["angkatan"]],
                'NIM' => $student[$columns['NIM']],
            ]);

            $student["mahasiswa_id"] = $mahasiswa->id;
        }

        $unique_students = $unique_students->keyBy($columns['NIM']);

        foreach ($data as $row) {
            if ($row[$columns['perkuliahan']] == 'Pendek') {
                continue;
            }

            Nilai::create([
                'mahasiswa_id' => $unique_students[$row[$columns['NIM']]]["mahasiswa_id"],
                'ganjil_genap' => strtoupper($row[$columns['semester']]),
                'tahun_ajaran_id' => $tahun_ajarans[$row[$columns['tahun_ajaran']]]["id"],
                'IPK' => $row[$columns['ipk']],
                'IPS' => $row[$columns['ips']],
            ]);
        }
    }
}

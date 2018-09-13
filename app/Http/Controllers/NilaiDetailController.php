<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;
use App\Angkatan;
use App\Nilai;
use App\Mahasiswa;

class NilaiDetailController extends Controller
{
    public function index(TahunAjaran $tahun_ajaran, $ganjil_genap, Angkatan $angkatan)
    {
        $mahasiswas = Mahasiswa::query()
            ->select('id', 'NIM')
            ->where('angkatan_id', $angkatan->id)
            ->with([
                'nilai' => function($query) use ($ganjil_genap, $tahun_ajaran) {
                    $query
                        ->select('id', 'mahasiswa_id', 'IPK', 'IPS', 'cluster')
                        ->where('tahun_ajaran_id', $tahun_ajaran->id)
                        ->where('ganjil_genap', $ganjil_genap);
                }
            ])
            ->get();

        return view(
            'nilai.detail.index',
            compact(
                'tahun_ajaran',
                'ganjil_genap',
                'angkatan',
                'mahasiswas'
            )
        );
    }
}

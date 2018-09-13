<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\TahunAjaran;
use App\Nilai;
use App\Angkatan;

class NilaiController extends Controller
{
    public function index()
    {
        $tahun_ajarans = TahunAjaran::query()
            ->select('id', 'tahun_mulai', 'tahun_selesai')
            ->orderBy('tahun_selesai', 'DESC')
            ->get();

        $angkatans = Angkatan::query()
            ->select('id', 'tahun')
            ->get();

        $ganjil_genap = Nilai::ganjil_genap();

        return view('nilai.index', compact('tahun_ajarans', 'ganjil_genap', 'angkatans'));
    }
}

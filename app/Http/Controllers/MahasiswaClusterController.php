<?php

namespace App\Http\Controllers;

use App\Mahasiswa;

class MahasiswaClusterController extends Controller
{
    public function index(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load([
            "user:name,id",
            "nilais",
            "nilais.tahun_ajaran",
        ]);

        $mahasiswa->nilais = $mahasiswa->nilais
            ->sortByDesc("tahun_ajaran.tahun_mulai");

        return view("mahasiswa-cluster.index", compact("mahasiswa"));
    }
}

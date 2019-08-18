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

        return view("mahasiswa-cluster.index", compact("mahasiswa"));
    }
}

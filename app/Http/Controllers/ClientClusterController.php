<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientClusterController extends Controller
{
    public function index()
    {
        $mahasiswa_id = auth()->user()->mahasiswa->id;

        $mahasiswa_clusters = DB::select("
            SELECT cluster, ganjil_genap, tahun_mulai, tahun_selesai, \"IPK\", \"IPS\" FROM nilais
                JOIN tahun_ajarans ON tahun_ajarans.id = nilais.tahun_ajaran_id
                WHERE
                    mahasiswa_id = $mahasiswa_id
                ORDER BY
                    tahun_selesai DESC,
                    ganjil_genap DESC
        ");

        // $mahasiswa_genap_clusters = collect($mahasiswa_genap_clusters)
        //     ->groupBy(function($nilai) {
        //         return $nilai->tahun_mulai . '-' . $nilai->tahun_selesai;
        //     });

        return view('client.cluster.index', compact('mahasiswa_clusters'));
    }
}

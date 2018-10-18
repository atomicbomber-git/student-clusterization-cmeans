<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientClusterController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $smallest_average_clusters = DB::select('
            SELECT tahun_ajaran_id, ganjil_genap, FIRST_VALUE(cluster) OVER (PARTITION BY tahun_ajaran_id ORDER BY average) AS smallest_average_cluster
            FROM (
                SELECT tahun_ajaran_id, ganjil_genap, angkatan_id, cluster, AVG(("IPK" + "IPS") / 2) AS average
                    FROM nilais INNER JOIN mahasiswas ON mahasiswas.id = nilais.mahasiswa_id
                    WHERE angkatan_id = ? AND cluster IS NOT NULL
                    GROUP BY tahun_ajaran_id, ganjil_genap, angkatan_id, cluster
                    ORDER BY tahun_ajaran_id DESC, ganjil_genap DESC, angkatan_id DESC) subtable
        ', [$mahasiswa->angkatan_id]);

        $smallest_average_clusters = collect($smallest_average_clusters)
            ->unique()
            ->mapWithKeys(function($record) {
                return [$record->tahun_ajaran_id . '-' . $record->ganjil_genap => $record->smallest_average_cluster];
            });

        $mahasiswa_clusters = DB::select("
            SELECT cluster, ganjil_genap, tahun_ajarans.id AS tahun_ajaran_id, tahun_mulai, tahun_selesai, \"IPK\", \"IPS\" FROM nilais
                JOIN tahun_ajarans ON tahun_ajarans.id = nilais.tahun_ajaran_id
                WHERE
                    mahasiswa_id = ?
                ORDER BY
                    tahun_selesai DESC,
                    ganjil_genap DESC
        ", [$mahasiswa->id]);

        return view('client.cluster.index', compact('mahasiswa_clusters', 'smallest_average_clusters'));
    }
}

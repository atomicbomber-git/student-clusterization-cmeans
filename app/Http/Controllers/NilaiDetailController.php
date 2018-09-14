<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\TahunAjaran;
use App\Angkatan;
use App\Nilai;
use App\Mahasiswa;
use App\CMeansClusterizer;

class NilaiDetailController extends Controller
{
    public function index(TahunAjaran $tahun_ajaran, $ganjil_genap, Angkatan $angkatan)
    {
        $mahasiswas = DB::table('mahasiswas')
            ->select('nilais.id AS nilai_id', 'NIM', 'IPK', 'IPS', 'cluster')
            ->join('nilais', 'nilais.mahasiswa_id', '=', 'mahasiswas.id')
            ->where('angkatan_id', $angkatan->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('ganjil_genap', $ganjil_genap)

            ->when(request('sort'), function($query) {
                if (request('order') !== 'ASC' || request('order') !== 'DESC') {
                    $order = 'ASC';
                }
                $order = request('order');
                
                $query->orderBy(
                    request('sort'),
                    $order
                );
            })
            ->get();


        $sortable_url = function ($attribute) {
            if (request('sort') === $attribute) {
                switch (request('order')) {
                    case 'ASC':
                        $sort = $attribute;
                        $order = 'DESC';
                        break;
                    case 'DESC':
                        $sort = '';
                        $order = 'ASC';
                        break;
                    default:
                        $sort = $attribute;
                        $order = 'ASC';
                }
            }
            else {
                $sort = $attribute;
                $order = 'ASC';
            }

            return request()->fullUrlWithQuery([
                'sort' => $sort,
                'order' => $order
            ]);

        };

        return view(
            'nilai.detail.index',
            compact(
                'tahun_ajaran',
                'ganjil_genap',
                'angkatan',
                'mahasiswas',
                'sortable_url'
            )
        );
    }

    public function update(TahunAjaran $tahun_ajaran, $ganjil_genap, Angkatan $angkatan)
    {
        $data = $this->validate(request(), [
            'nilais' => ['required', 'array'],
            'nilais.*.IPK' => ['nullable', 'min:0', 'max:4'],
            'nilais.*.IPS' => ['nullable', 'min:0', 'max:4']
        ]);
        
        DB::transaction(function() use($data) {
            foreach ($data['nilais'] as $id => $nilai) {
                Nilai
                    ::where('id', $id)
                    ->update(array_merge($nilai, ['cluster' => NULL]));
            }
        });

        return back()
            ->with('message.success', __('messages.update.success'));
    }

    public function clusterize(TahunAjaran $tahun_ajaran, $ganjil_genap, Angkatan $angkatan)
    {
        $data = $this->validate(request(), [
            'n_clusters' => 'integer|required|gte:2'
        ]);

        $nilais = Mahasiswa::query()
            ->select('id', 'NIM')
            ->where('angkatan_id', $angkatan->id)
            ->with(['nilai' => function ($query) use($tahun_ajaran, $ganjil_genap) {
                $query
                    ->select('id', 'mahasiswa_id', 'IPK', 'IPS')
                    ->where('tahun_ajaran_id', $tahun_ajaran->id)
                    ->where('ganjil_genap', $ganjil_genap);
            }])
            ->get()
            ->pluck('nilai')
            ->mapWithKeys(function ($nilai) {
                return [$nilai->id => [
                    'IPK' => $nilai->IPK,
                    'IPS' => $nilai->IPS
                ]];
            });

        $clusterizer = new CMeansClusterizer(
            $nilais->toArray(),
            $data['n_clusters'],
            1000,
            5
        );

        $result = $clusterizer->clusterize();
        DB::transaction(function() use($result) {
            foreach ($result as $nilai_id => $cluster) {
                Nilai::where('id', $nilai_id)
                    ->update(['cluster' => $cluster]);
            }
        });

        return redirect()
            ->route('nilai.detail.index', [$tahun_ajaran, $ganjil_genap, $angkatan])
            ->with('message.success', __('messages.update.success'));
    }
}

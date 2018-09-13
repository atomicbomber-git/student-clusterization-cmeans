<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
                    ->update($nilai);
            }
        });

        return back()
            ->with('message.success', __('messages.update.success'));
    }
}

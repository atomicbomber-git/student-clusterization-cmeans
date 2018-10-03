<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\TahunAjaran;
use App\Mahasiswa;
use App\Nilai;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajarans = TahunAjaran::query()
            ->select('id', 'tahun_mulai', 'tahun_selesai')
            ->orderBy('tahun_selesai', 'DESC')
            ->get();

        return view('tahun_ajaran.index', compact('tahun_ajarans'));
    }

    public function create()
    {
        $data = $this->validate(request(), [
            'tahun_mulai' => ['required', 'string'],
            'tahun_selesai' => [
                'required',
                'string',
                'different:tahun_mulai',
                Rule::unique('tahun_ajarans')
                    ->where(function ($query) {
                        $query->where('tahun_mulai', request('tahun_mulai'));
                    })
            ]
        ]);

        DB::transaction(function () use($data) {
            $tahun_ajaran = TahunAjaran::create($data);

            $mahasiswa_ids = DB::table('mahasiswas')
                ->select('mahasiswas.id')
                ->join('angkatans', 'angkatans.id', '=', 'mahasiswas.angkatan_id')
                ->where('angkatans.tahun', '<=', $tahun_ajaran->tahun_mulai)
                ->pluck('id');

            foreach ($mahasiswa_ids as $mahasiswa_id) {
                foreach (Nilai::ganjil_genap() as $ganjil_genap) {
                    Nilai::create([
                        'mahasiswa_id' => $mahasiswa_id,
                        'tahun_ajaran_id' => $tahun_ajaran->id,
                        'ganjil_genap' => $ganjil_genap
                    ]);
                }
            }
        });

        return redirect()
            ->back()
            ->with('message.success', __('messages.create.success'));
    }

    public function edit(TahunAjaran $tahun_ajaran)
    {
        return view('tahun_ajaran.edit', compact('tahun_ajaran'));
    }

    public function update(TahunAjaran $tahun_ajaran)
    {
        $data = $this->validate(request(), [
            'tahun_mulai' => ['required', 'string'],
            'tahun_selesai' => [
                'required',
                'string',
                'different:tahun_mulai',
                Rule::unique('tahun_ajarans')
                    ->ignore($tahun_ajaran->id)
                    ->where(function ($query) {
                        $query->where('tahun_mulai', request('tahun_mulai'));
                    })
            ]
        ]);

        $tahun_ajaran->update($data);

        return redirect()
            ->back()
            ->with('message.success', __('messages.update.success'));
    }

    public function delete(TahunAjaran $tahun_ajaran)
    {
        $tahun_ajaran->delete();
        return redirect()
            ->back()
            ->with('message.success', __('messages.delete.success'));
    }
}

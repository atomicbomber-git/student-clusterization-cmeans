<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Angkatan;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::query()
            ->select('id', 'NIM', 'angkatan_id')
            ->with('angkatan:id,tahun')
            ->withCount('nilais')
            ->paginate(25);

        $angkatans = Angkatan::query()
            ->select('id', 'tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

        return view('mahasiswa.index', compact('mahasiswas', 'angkatans'));
    }

    public function create()
    {
        $angkatan_ids = Angkatan::select('id')->pluck('id');
        
        $data = $this->validate(request(), [
            'NIM' => ['required', 'unique:mahasiswas'],
            'angkatan_id' => ['required', Rule::in($angkatan_ids)]
        ]);

        Mahasiswa::create($data);

        return redirect()
            ->back()
            ->with('message.success', __('messages.create.success'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $angkatans = Angkatan::select('id', 'tahun')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'angkatans'));
    }

    public function update(Mahasiswa $mahasiswa)
    {
        $angkatan_ids = Angkatan::select('id')->pluck('id');
        
        $data = $this->validate(request(), [
            'NIM' => ['required', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'angkatan_id' => ['required', Rule::in($angkatan_ids)]
        ]);

        $mahasiswa->update($data);
        return redirect()
            ->back()
            ->with('message.success', __('messages.update.success'));
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()
            ->back()
            ->with('message.success', __('messages.delete.success'));
    }
}

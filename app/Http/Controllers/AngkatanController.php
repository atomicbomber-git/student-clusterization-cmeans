<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Angkatan;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatans = Angkatan::query()
            ->select('id', 'tahun')
            ->orderBy('tahun', 'DESC')
            ->withCount('mahasiswas')
            ->get();

        return view('angkatan.index', compact('angkatans'));
    }

    public function create()
    {
        $data = $this->validate(request(), [
            'tahun' => ['required', 'integer', 'unique:angkatans']
        ]);

        Angkatan::create($data);

        return redirect()
            ->back()
            ->with('message.success', __('messages.create.success'));
    }

    public function edit(Angkatan $angkatan)
    {
        return view('angkatan.edit', compact('angkatan'));
    }

    public function update(Angkatan $angkatan)
    {
        $data = $this->validate(request(), [
            'tahun' => ['required', 'integer', Rule::unique('angkatans')->ignore($angkatan->id)]
        ]);

        $angkatan->update($data);

        return redirect()
            ->back()
            ->with('message.success', __('messages.update.success'));
    }

    public function delete(Angkatan $angkatan)
    {
        $angkatan->delete();
        return redirect()
            ->back()
            ->with('message.success', __('messages.delete.success'));
    }
}

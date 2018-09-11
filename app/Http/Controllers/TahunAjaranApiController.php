<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;

class TahunAjaranApiController extends Controller
{
    public function create()
    {
        $data = $this->validate(request(), [
            'nama' => 'required|string|unique:tahun_ajarans'
        ]);

        TahunAjaran::create($data);

        return [
            'status' => 'success'
        ];
    }

    public function index()
    {
        return TahunAjaran::query()
            ->select('nama')
            ->withCount('nilais')
            ->get();
    }

    public function delete()
    {
        $data = $this->validate(request(), [
            'nama' => 'required|string'
        ]);

        $tahun_ajaran = TahunAjaran::where($data)->first();
        
        if ($tahun_ajaran->nilais()->count() > 0) {
            abort(422, 'Tahun ajaran terkait dengan data nilai.');
        }

        $tahun_ajaran->delete();

        return [
            'status' => 'success'
        ];
    }
}

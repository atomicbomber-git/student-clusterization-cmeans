<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajarans = TahunAjaran::query()
            ->select('nama')
            ->get();

        return view('tahun_ajaran.index', compact('tahun_ajarans'));
    }
}

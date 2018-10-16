<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientClusterController extends Controller
{
    public function index()
    {
        return view('client.cluster.index');
    }
}

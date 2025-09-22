<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetiroDefinitivoController extends Controller
{
    public function index()
    {
        return view('retiros_def.index');
    }

    public function create()
    {
        return view('retiros_def.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('retiros-def.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasoConvivenciaController extends Controller
{
    public function index()
    {
        return view('convivencia.index');
    }

    public function create()
    {
        return view('convivencia.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('convivencia.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetiroDiarioController extends Controller
{
    public function index()
    {
        return view('retiros.index');
    }

    public function create()
    {
        return view('retiros.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('retiros.index');
    }

    public function form()
    {
        return view('retiros.form');
    }
}

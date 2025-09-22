<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        $q = Alumno::query();
        if ($request->has('curso_id')) $q->where('curso_id', $request->curso_id);
        if ($request->has('estado')) $q->where('estado', $request->estado);

        $perPage = $request->get('per_page', 15);
        $data = $q->paginate($perPage);
        return response()->json($data);
    }

    public function show($id)
    {
        $alumno = Alumno::with('curso','apoderadoPrincipal')->findOrFail($id);
        return response()->json($alumno);
    }
}

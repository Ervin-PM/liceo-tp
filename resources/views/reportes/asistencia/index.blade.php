@extends('layouts.app')

@section('content')
  <div class="p-4 bg-white rounded shadow-sm">
    <div class="flex justify-between items-center mb-3">
      <h2 class="text-2xl font-semibold">Reportes - Asistencia</h2>
      <div class="space-x-2">
        <a href="{{ route('reportes.asistencia.pdf') }}" class="bg-liceo-azul text-white px-3 py-1 rounded">Exportar PDF</a>
        <a href="{{ route('reportes.asistencia.excel') }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Exportar Excel</a>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm table-auto">
        <thead>
          <tr class="text-left">
            <th class="px-2 py-1">Apellidos</th>
            <th class="px-2 py-1">Nombres</th>
            <th class="px-2 py-1">Curso</th>
            <th class="px-2 py-1">Fecha</th>
            <th class="px-2 py-1">Estado</th>
          </tr>
        </thead>
        <tbody>
          @foreach($asistencias ?? [] as $r)
            <tr>
              <td class="px-2 py-1">{{ $r->alumno->apellidos }}</td>
              <td class="px-2 py-1">{{ $r->alumno->nombres }}</td>
              <td class="px-2 py-1">{{ optional($r->alumno->curso)->nombre }}</td>
              <td class="px-2 py-1">{{ $r->fecha }}</td>
              <td class="px-2 py-1">{{ $r->estado }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
  <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>

  <div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow">Total alumnos<br><span class="text-2xl font-bold">--</span></div>
    <div class="bg-white p-4 rounded shadow">Asistencia hoy<br><span class="text-2xl font-bold">-- %</span></div>
    <div class="bg-white p-4 rounded shadow">Retiros hoy<br><span class="text-2xl font-bold">--</span></div>
    <div class="bg-white p-4 rounded shadow">Suspendidos activos<br><span class="text-2xl font-bold">--</span></div>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <canvas id="asistenciaChart" height="100"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('asistenciaChart');
    if (ctx) {
      new Chart(ctx, {type:'bar', data:{labels:['A','B'], datasets:[{label:'Asistencia', data:[10,20], backgroundColor:'#0D47A1'}]}})
    }
  </script>

@endsection

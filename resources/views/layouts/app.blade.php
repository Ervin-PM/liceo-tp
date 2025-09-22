<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name','LiceoTP') }}</title>
  <link href="/build/assets/app.css" rel="stylesheet">
  @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex">
      <nav class="w-64 bg-liceo-azul text-white p-4">
        <h1 class="text-xl font-bold">Liceo TP</h1>
        <ul class="mt-6">
          <li><a href="{{ route('dashboard.index') }}" class="block py-2">Dashboard</a></li>
          <li><a href="{{ route('alumnos.index') }}" class="block py-2">Alumnos</a></li>
        </ul>
      </nav>
      <main class="flex-1 p-6">
        <div class="container mx-auto">
          @yield('content')
        </div>
      </main>
    </div>
    @livewireScripts
  </body>
</html>

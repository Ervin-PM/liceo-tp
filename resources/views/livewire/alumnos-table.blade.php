<div>
  <div class="flex items-center mb-4">
    <input wire:model.debounce.300ms="search" placeholder="Buscar por nombre o apellido" class="border px-2 py-1 rounded w-64" />
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="min-w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-2 text-left">Apellidos</th>
          <th class="p-2 text-left">Nombres</th>
          <th class="p-2 text-left">Curso</th>
        </tr>
      </thead>
      <tbody>
        @foreach($alumnos as $alumno)
        <tr class="border-t">
          <td class="p-2">{{ $alumno->apellidos }}</td>
          <td class="p-2">{{ $alumno->nombres }}</td>
          <td class="p-2">{{ optional($alumno->curso)->nombre }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $alumnos->links() }}
  </div>
</div>

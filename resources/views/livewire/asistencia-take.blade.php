<div class="p-4 bg-white rounded shadow-sm">
    <h2 class="text-lg font-semibold mb-3">Tomar Asistencia</h2>

    <div class="grid grid-cols-3 gap-3 mb-3">
        <div>
            <label class="block text-sm font-medium text-gray-700">Curso</label>
            <select wire:model="curso_id" class="mt-1 block w-full border rounded px-2 py-1">
                <option value="">-- Seleccionar curso --</option>
                @foreach($cursos as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Fecha</label>
            <input wire:model="fecha" type="date" class="mt-1 block w-full border rounded px-2 py-1" />
        </div>
        <div class="flex items-end">
            <button wire:click.prevent="loadAlumnos" class="bg-blue-600 text-white px-3 py-1 rounded">Cargar alumnos</button>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if(count($alumnos))
        <form wire:submit.prevent="submit">
            <table class="w-full text-sm table-auto mb-3">
                <thead>
                    <tr class="text-left">
                        <th class="px-2 py-1">Alumno</th>
                        <th class="px-2 py-1">Estado</th>
                        <th class="px-2 py-1">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $i => $a)
                        <tr>
                            <td class="px-2 py-1">{{ $a['apellidos'] }} {{ $a['nombres'] }}</td>
                            <td class="px-2 py-1">
                                <select wire:model="alumnos.{{ $i }}.estado" class="border rounded px-2 py-1">
                                    <option value="presente">Presente</option>
                                    <option value="ausente">Ausente</option>
                                    <option value="tarde">Tarde</option>
                                </select>
                            </td>
                            <td class="px-2 py-1">
                                <input wire:model="alumnos.{{ $i }}.comentario" class="border rounded px-2 py-1 w-full" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end">
                <button type="submit" class="bg-liceo-azul text-white px-4 py-2 rounded">Guardar asistencias</button>
            </div>
        </form>
    @else
        <div class="text-sm text-gray-600">No hay alumnos cargados. Seleccione un curso y haga clic en "Cargar alumnos".</div>
    @endif
</div>

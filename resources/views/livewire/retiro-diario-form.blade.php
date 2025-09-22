<div class="p-4 bg-white rounded shadow-sm">
    <h2 class="text-lg font-semibold mb-3">Registrar Retiro Diario</h2>

    @if(session()->has('success'))
        <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-3 gap-3 mb-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Alumno</label>
                <select wire:model="alumno_id" class="mt-1 block w-full border rounded px-2 py-1">
                    <option value="">-- Seleccionar alumno --</option>
                    @foreach($alumnos as $a)
                        <option value="{{ $a->id }}">{{ $a->apellidos }} {{ $a->nombres }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha</label>
                <input wire:model="fecha" type="date" class="mt-1 block w-full border rounded px-2 py-1" />
            </div>
            <div></div>
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700">Motivo</label>
            <textarea wire:model="motivo" class="mt-1 block w-full border rounded px-2 py-1"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-liceo-azul text-white px-4 py-2 rounded">Registrar</button>
        </div>
    </form>
</div>

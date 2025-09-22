<div class="bg-white p-4 rounded shadow mb-4">
  @if(session()->has('success'))
    <div class="mb-2 text-green-700">{{ session('success') }}</div>
  @endif

  <div class="grid grid-cols-3 gap-2">
    <input wire:model.defer="nombres" placeholder="Nombres" class="border p-2" />
    <input wire:model.defer="apellidos" placeholder="Apellidos" class="border p-2" />
    <input wire:model.defer="documento_identidad" placeholder="Documento (opcional)" class="border p-2" />
  </div>

  <div class="mt-2">
    <button wire:click="save" class="bg-liceo-azul text-white px-4 py-2 rounded">Guardar</button>
  </div>
</div>

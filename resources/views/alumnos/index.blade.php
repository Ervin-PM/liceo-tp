@extends('layouts.app')

@section('content')
  <h2 class="text-2xl font-semibold mb-4">Alumnos</h2>

  <div class="mb-4">
    @livewire('alumnos-form')
    @livewire('alumnos-table')
  </div>

@endsection


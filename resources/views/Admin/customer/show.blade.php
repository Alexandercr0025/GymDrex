@extends('Admin.master')

{{-- titulo --}}
@section('title', 'Empresa')

{{-- contenido --}}
@section('content')
    <div class="mx-6">
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-6">
            <div class="mx-4 my-3 rounded-lg shadow-lg">
                <div class="mx-2 my-4">
                    <label for="nombres" class="font-medium">Nombres</label>
                    <p class="text-gray-500">{{ $customer->nombres }} {{ $customer->apellidos }}</p>
                </div>
            </div>
            <div class="mx-4 my-3 rounded-lg shadow-lg">
                <div class="mx-2 my-4">
                    <label for="edad" class="font-medium">Edad</label>
                    <p class="text-gray-500">
                        {{ $customer->fecha_nacimiento ? date_diff(date_create($customer->fecha_nacimiento), date_create('today'))->y . ' años' : 'No registrado' }}
                    </p>
                </div>
            </div>
            <div class="mx-4 my-3 rounded-lg shadow-lg">
                <div class="mx-2 my-4">
                    <label for="codigo" class="font-medium">Codigo</label>
                    <p class="text-gray-500">{{ $customer->codigo }}</p>
                </div>
            </div>
            <div class="mx-4 my-3 rounded-lg shadow-lg">
                <div class="mx-2 my-4">
                    <label for="dni" class="font-medium">DNI</label>
                    <p class="text-gray-500">{{ $customer->dni }}</p>
                </div>
            </div>
            <div class="mx-4 my-3 rounded-lg shadow-lg">
                <div class="mx-2 my-4">
                    <label for="membresia" class="font-medium">Membresia</label>
                    <p class="text-gray-500">Fecha Inicio: {{ $customer->fecha_inicio }}</p>
                    <p class="text-gray-500">Fecha Fin: {{ $customer->fecha_fin }}</p>
                    <p class="text-gray-500">Estado:
                        @if (!is_null($customer->fecha_fin) && $customer->fecha_fin >= now())
                            Activo
                        @else
                            Inactivo
                        @endif
                    </p>
                </div>
            </div>
            <div class="mx-4 my-3 rounded-lg shadow-lg">
                <div class="mx-2 my-4">
                    <label for="coach" class="font-medium">Coach</label>
                    <p class="text-gray-500">Fecha Inicio: {{ $customer->fecha_inicio_coach }}</p>
                    <p class="text-gray-500">Fecha Fin: {{ $customer->fecha_fin_coach }}</p>
                    <p class="text-gray-500">Estado:
                        @if (!is_null($customer->fecha_fin_coach) && $customer->fecha_fin_coach >= now())
                            Activo
                        @else
                            Inactivo
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

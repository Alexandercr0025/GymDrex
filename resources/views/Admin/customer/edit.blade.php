@extends('Admin.master')

{{-- titulo --}}
@section('title', 'Empresa')

{{-- contenido --}}
@section('content')
    <div class="mx-8 my-6">
        <form action="{{ route('customer.update', $customer) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="mx-8">
                <div class="mx-4 mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mx-4 my-3">
                            <label class="mr-1" for="nombres">Nombres</label>
                            @error('nombres')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="text" name="nombres" value="{{ old('nombres', $customer->nombres) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus nombres...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="email">Email</label>
                            @error('email')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su email...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="apellidos">Apellidos</label>
                            @error('apellidos')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="text" name="apellidos" value="{{ old('apellidos', $customer->apellidos) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus apellidos...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="celular">Celular</label>
                            @error('celular')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="number" name="celular" value="{{ old('celular', $customer->celular) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su celular...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="dni">DNI</label>
                            @error('dni')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="number" name="dni" value="{{ old('dni', $customer->dni) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su dni...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            @error('fecha_nacimiento')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $customer->fecha_nacimiento) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus fecha_nacimiento...">
                        </div>
                    </div>
                </div>
                <div class="my-5 mx-auto flex-1 text-center">
                    <button
                        class="text-white bg-button font-medium rounded-full
                        text-xl px-10 py-2.5 text-center"
                        type="submit">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@extends('Admin.master')

{{-- titulo --}}
@section('title', 'Empresa')

{{-- contenido --}}
@section('content')
    <div class="mx-8 my-6">
        <form action="{{ route('customer.store') }}" method="post">
            @csrf
            <div class="mx-8">
                <div class="mx-4 mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mx-4 my-3">
                            <label class="mr-1" for="nombres">Nombres</label>
                            @error('nombres')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="text" name="nombres" value="{{ old('nombres') }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus nombres...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="email">Email</label>
                            @error('email')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su email...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="apellidos">Apellidos</label>
                            @error('apellidos')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="text" name="apellidos" value="{{ old('apellidos') }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus apellidos...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="celular">Celular</label>
                            @error('celular')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="number" name="celular" value="{{ old('celular') }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su celular...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="dni">DNI</label>
                            @error('dni')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="number" name="dni" value="{{ old('dni') }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su dni...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            @error('fecha_nacimiento')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus fecha_nacimiento...">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mx-4">
                    <div class="my-3 mx-4">
                        <label>Membresia</label>
                        <div class="rounded-lg border-button border">
                            <div class="m-2">
                                @foreach ($memberships as $m)
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <input type="radio" name="membresia" value="{{ $m->id }}"
                                                @if ($loop->first) checked @endif>
                                            <label for="opcion_{{ $m->id }}">{{ $m->nombre }}</label>
                                        </div>
                                        <label>$ {{ $m->precio }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="my-3 mx-4">
                        <label>Coach</label>
                        <div class="rounded-lg border-button border">
                            <div class="m-2">
                                <div class="grid grid-cols-2">
                                    <div>
                                        <input type="checkbox" name="coach" value="{{ $coach->id }}">
                                        <label for="coach">{{ $coach->nombre }}</label>
                                    </div>
                                    <label for="coach">{{ $coach->precio }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-5 mx-auto flex-1 text-center">
                    <button
                        class="text-white bg-button font-medium rounded-full
                            text-xl px-10 py-2.5 text-center"
                        type="submit">Registrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

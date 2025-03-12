@extends('Admin.master')

{{-- titulo --}}
@section('title', 'Empresa')

{{-- contenido --}}
@section('content')
<div class="mx-8">
    <div class="my-6">
        <h1 class="font-bold text-xl text-center">Informacion de la Empresa</h1>
        <div class="mx-4 my-2">
            <div class="rounded-md bg-main">
                <form action="{{ route('dashboard.panel.update', $panel) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mx-6 my-2 bg-main">
                        <label for="">Nombre</label>
                        <input name="nombre" class="w-full bg-main" type="text" value="{{ $panel->nombre }}" readonly>
                    </div>

                    <div class="mx-4 grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="m-2">
                            <label for="">Slogan</label>
                            <textarea name="slogan" class="w-full">{{ $panel->slogan }}</textarea>
                            {{-- <input name="slogan" class="w-full" type="text" value="{{ $panel->slogan }}"> --}}
                        </div>
                        <div class="m-2">
                            <label for="">Mensaje</label>
                            <textarea name="contenido" class="w-full">{{ $panel->contenido }}</textarea>
                            {{-- <input name="contenido" class="w-full" type="text" value="{{ $panel->contenido }}"> --}}
                        </div>
                        <div class="m-2">
                            <label for="">Descripcion</label>
                            <textarea name="descripcion" class="w-full">{{ $panel->descripcion }}</textarea>
                            {{-- <input name="descripcion" class="w-full" type="text" value="{{ $panel->descripcion }}"> --}}
                        </div>
                        <div class="m-2">
                            <label for="">Correo</label>
                            <input name="email" class="w-full" type="text" value="{{ $panel->email }}">
                        </div>
                        <div class="m-2">
                            <label for="">Celular</label>
                            <input name="celular" class="w-full" type="text" value="{{ $panel->celular }}">
                        </div>
                    </div>
                    <div class="mx-6 mt-4">
                        <button type="submit"
                        class="text-white bg-button font-medium rounded-2xl text-sm px-5 py-2.5 text-center">
                            Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div></div>
    <div></div>
    <hr>
    <div></div>
    <div></div>
    {{-- @foreach (json_decode($memberships[0]->beneficios, true) as $beneficio)
        <li>{{ $beneficio }}</li>
    @endforeach --}}
</div>
@endsection

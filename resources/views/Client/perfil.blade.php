@extends('client.master')

{{-- titulo --}}
@section('title', 'DREX | Perfil')

{{-- contenido --}}
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 my-12">
        <div class="mx-4">
            <h1 class="font-bold text-4xl">Bienvenido</h1>
            <p class="my-2 font-semibold">Ingrese sus credenciales para consultar su perfil </p>
            <div class="">
                {{-- <a class="btn btn-warning mt-2" href="{{ route('category.show', $c->id) }}">Show</a> --}}
                <form action="{{ route('perfil.shearch') }}" class="" method="post">
                    @csrf
                    <div class="my-8 w-full flex max-w-lg">
                        <select name="type" id="" class="bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2">
                            <option value="dni" {{ (old('type') == 'dni') ? 'selected' : '' }}>DNI</option>
                            <option value="codigo" {{ (old('type') == 'codigo') ? 'selected' : '' }}>CODIGO</option>
                        </select>
                        <input
                            name="valor"
                            class="ml-3 w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                            placeholder="Escriba su credencial..."
                            value="{{ old('valor') }}"/>
                    </div>
                    <div class="mt-28 flex max-w-xl justify-end">
                        <button class="rounded-full bg-button py-4 px-24 border border-transparent text-center text-2xl font-bold text-white"
                            type="submit">
                            Consultar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mx-4">
            <div class="mx-16">
                <img class="object-scale-down" src="img\Client\perfil.png" alt="">
            </div>
        </div>
    </div>
@endsection

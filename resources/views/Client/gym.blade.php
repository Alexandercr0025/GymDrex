@extends('client.master')

{{-- titulo --}}
@section('title', 'DREX | Gimnasios')

{{-- contenido --}}
@section('content')
    <div class="mx-4">
        {{-- Buscador --}}
        {{-- <form action="{{ route('gimnasio.shearch') }}" method="post">
            @csrf
            <div class="w-full max-w-lg mt-4">
                <div class="flex items-center">
                    <input name="ciudad" value="{{ old('ciudad', $ciudad) }}"
                        class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                        placeholder="Escriba su ciudad..." />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="relative z-40 w-6 h-6 right-7 text-button">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <button class="rounded-lg bg-button py-2 px-8 border border-transparent text-center text-sm text-white"
                        type="submit">
                        Buscar
                    </button>
                </div>
            </div>
        </form> --}}
        <form action="{{ route('gimnasio') }}" method="get">
            <div class="w-full max-w-lg mt-4">
                <div class="flex items-center">
                    <input name="ciudad" value="{{ old('ciudad', $ciudad) }}"
                        class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                        placeholder="Escriba su ciudad..." />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="relative z-40 w-6 h-6 right-7 text-button">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <button class="rounded-lg bg-button py-2 px-8 border border-transparent text-center text-sm text-white"
                        type="submit">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
        {{-- Contenido --}}
        <div class="grid grid-cols-1 md:grid-cols-2 m-5">
            @forelse ($gyms as $g)
                <div class="bg-box rounded-lg shadow-md m-4">
                    <div class="flex-col m-8">
                        {{-- imagen --}}
                        @if ($g->image)
                            <img class="rounded-lg object-cover" src="img\Client\{{ $g->image }}" alt="">
                        @else
                            <img class="rounded-lg object-cover" src="img\default.avif" alt="">
                        @endif
                        {{-- ciudad --}}
                        <h1>{{ $g->ciudad }}</h1>
                        {{-- direccion --}}
                        <div class="flow-root">
                            <p class="float-left text-left">{{ $g->direccion }}</p>
                            @if ($g->link)
                                <a href="{{ $g->link }}" target="_blank"
                                    class="float-right hover:underline text-blue-900">ver gym</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 mt-4">No tenemos un gimnasio en esta ciudad.</p>
            @endforelse
        </div>
        <div>
            {{ $gyms->links() }}
        </div>
    </div>
@endsection

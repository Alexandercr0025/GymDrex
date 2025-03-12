@extends('client.master')

{{-- titulo --}}
@section('title', 'DREX | Resultado de búsqueda')

{{-- contenido --}}
@section('content')
    <div class="mx-4">
        <div class="flex m-5">
            <a href="{{ route('principal') }}" class="ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 my-12">
            <div class="grid grid-cols-2 mx-10 space-x-5">
                {{-- {{$customer}} --}}
                <div class="">
                    @if ($customer->imagen)
                        <img class="rounded-lg object-cover" src="{{ asset('upload/customer/' . $customer->imagen) }}"
                            alt="">
                    @else
                        <img class="rounded-lg object-cover" src="{{ asset('image/default/customer/default.jpg') }}"
                            alt="">
                    @endif
                </div>
                <div class="flex-col">
                    <h1 class="font-bold text-3xl">{{ $customer->nombres }}</h1>
                    <p class="font-medium text-xl">{{ $customer->apellidos }}</p>
                    <p class="mt-32 font-medium text-sm">Suscripcion valida hasta {{ $customer->fecha_fin }}</p>
                </div>
            </div>
            <div class="grid grid-rows-2 my-5">
                <div class="my-5 mx-auto flex-1 text-center">
                    <form action="{{ route('perfil.send', $customer) }}" method="post">
                        @csrf
                        <button
                            class="text-black bg-box font-medium rounded-full
                        text-3xl px-10 py-2.5 text-center"
                            type="submit">Actualizar datos</button>
                    </form>
                </div>
                <div class="my-5 mx-auto flex-1 text-center">
                    <a href="{{ route('perfil.paypal', $customer) }}"
                        class="text-white bg-button font-medium rounded-full
                    text-3xl px-10 py-2.5 text-center">Actualizar
                        membresia</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('Admin.master')

{{-- titulo --}}
@section('title', 'Empresa')

{{-- contenido --}}
@section('content')
    <div class="mx-8 my-6">
        <label class="font-medium text-lg ml-8" for="">Bienvenido {{ $customer->nombres }}
            {{ $customer->apellidos }}</label>
        <div>
            <form action="{{ route('customer.membership.update', $customer) }}" method="post">
                @method('PATCH')
                @csrf

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
                <div class="ml-8">
                    <button class="px-2 py-1 border rounded font-bold inline-block transition-all bg-button text-white"
                    type="submit">Actualizar Membresia</button>
                </div>
            </form>
        </div>
    </div>
@endsection











{{--
<form action="{{ route('customer.membership', $c) }}" method="post">
    @method('PATCH')
    @csrf
    <button
        class="px-2 py-1 border rounded font-bold inline-block transition-all bg-button text-white"
        type="submit">Membresia</button>
</form> --}}

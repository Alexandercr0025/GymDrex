@extends('Admin.master')

{{-- titulo --}}
@section('title', 'Empresa')

{{-- contenido --}}
@section('content')
    <div class="mx-8 my-6">
        <div>
            <div class="mb-6">
                <a href="{{ route('customer.create') }}"
                    class="text-white bg-button font-medium rounded-full
                    text-sm px-5 py-2.5 text-center">
                    Agregar Cliente
                </a>
            </div>
            <div>
                <form action="{{ route('customer.index') }}" class="" method="get">
                    <div class="my-8 w-full flex max-w-lg">
                        <input name="dni"
                            class="ml-3 w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                            placeholder="Buscar por dni..." value="{{ old('dni') }}" />
                        <button
                            class="rounded-md bg-button py-1x px-2 ml-1 border border-transparent text-center font-bold text-white"
                            type="submit">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DNI
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Inicio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Fin
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Coach
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $c)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $c->nombres }} {{ $c->apellidos }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $c->dni }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $c->fecha_inicio }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $c->fecha_fin }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    @if (!is_null($c->fecha_fin) && $c->fecha_fin >= now())
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    @if (!is_null($c->fecha_fin_coach) && $c->fecha_fin_coach >= now())
                                        Si
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('customer.show', $c) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                    <a href="{{ route('customer.edit', $c) }}"
                                        class="font-medium text-blue-800 dark:text-blue-500 hover:underline">Editar</a>
                                    <a href="{{ route('customer.membership', $c) }}"
                                        class="px-2 py-1 border rounded font-bold inline-block transition-all bg-button text-white">Membresia</a>
                                    <form action="{{ route('customer.destroy', $c) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            class="px-2 py-1 border rounded font-bold inline-block transition-all bg-red-700 hover:bg-red-900 text-white"
                                            type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="my-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection

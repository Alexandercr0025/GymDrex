<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-main">
    @session('success')
        <div id="alert-box" class="m-3 z-50 absolute top-0 right-0">
            <div class="bg-green-700 rounded-lg text-white p-6">
                {{ $value }}
            </div>
        </div>
    @endsession
    <script>
        setTimeout(function() {
            let alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500); // Elimina el elemento después de la animación
            }
        }, 3000); // Desaparece después de 3 segundos
    </script>
    <div class="flex m-5">
        <a href="{{ route('principal') }}" class="ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
        </a>
    </div>
    <div>
        <form action="{{ route('perfil.update', $customer) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="mx-4 mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-4 md:gap-4">
                        <div class="row-span-4 my-3 mx-20 flex">
                            @if ($customer->imagen)
                                <img class="rounded-lg object-cover"
                                    src="{{ asset('upload/customer/' . $customer->imagen) }}" alt="">
                            @else
                                <img class="rounded-lg object-cover"
                                    src="{{ asset('image/default/customer/default.jpg') }}" alt="">
                            @endif
                        </div>

                        <div class="mx-4 my-3">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" value="{{ old('nombres', $customer->nombres) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus nombres...">
                        </div>
                        <div class="mx-4 my-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email', $customer->email) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su email...">
                        </div>
                        <div class="mx-4 my-3 col-start-2">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" value="{{ old('apellidos', $customer->apellidos) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus apellidos...">
                        </div>
                        <div class="mx-4 my-3 col-start-3">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" value="{{ old('celular', $customer->celular) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su celular...">
                        </div>
                        <div class="mx-4 my-3 col-start-2 row-start-3">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni', $customer->dni) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba su dni...">
                        </div>
                        <div class="mx-4 my-3 col-start-3 row-start-3">
                            <label for="codigo">CODIGO</label>
                            <input type="text" name="codigo" value="{{ old('codigo', $customer->codigo) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus codigo..." readonly>
                        </div>
                        <div class="mx-4 my-3 col-start-2 row-start-4">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $customer->fecha_nacimiento) }}"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2"
                                placeholder="Escriba sus fecha_nacimiento...">
                        </div>
                        <div class="mx-4 my-3 col-start-3 row-start-4">
                            <label for="imagen">Actualizar Imagen</label>
                            <input type="file" name="imagen"
                                class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-button rounded-lg px-2 py-2">
                        </div>

                    </div>
                </div>
                <div class="grid grid-cols-2">
                    <p class="ml-24 my-5 font-medium text-sm">Suscripcion valida hasta {{ $customer->fecha_fin }}</p>
                    <div class="my-5 mx-auto flex-1 text-center">
                        <button
                            class="text-black bg-box font-medium rounded-full
                                text-xl px-10 py-2.5 text-center"
                            type="submit">Actualizar datos</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="my-3 mx-auto flex-1 text-center">
            <a href="{{ route('perfil.paypal', $customer) }}"
                class="text-white bg-button font-medium rounded-full
                    text-xl px-10 py-2.5 text-center">
                Actualizar Membresia
            </a>
        </div>
    </div>
</body>

</html>

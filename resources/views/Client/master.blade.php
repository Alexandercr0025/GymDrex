<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])
</head>

<body class="flex flex-col min-h-screen bg-main">
    {{-- contactos --}}
    @if (request()->routeIs('principal'))
        <div class="mx-4 my-2 z-30">
            <a href="mailto:{{ $panels[0]->email }}" class="text-white hover:underline">{{ $panels[0]->email }}</a>
            <a href="https://wa.me/{{ $panels[0]->celular }}" target="_blank" class="text-white hover:underline">
                +51 {{ $panels[0]->celular }}
            </a>
        </div>
    @else
        <div class="mx-4 my-2 z-30">
            <a href="mailto:{{ $panels[0]->email }}" class="text-black hover:underline">{{ $panels[0]->email }}</a>
            <a href="https://wa.me/{{ $panels[0]->celular }}" target="_blank" class="text-black hover:underline">
                +51 {{ $panels[0]->celular }}
            </a>
        </div>
    @endif
    {{-- header --}}
    <header class="sticky top-4 px-4 z-50">
        <div class="py-4 bg-white rounded-xl flex px-4 items-center shadow-xl">
            {{-- logo --}}
            <div>
                <a href="{{ Route('principal') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" viewBox="0 0 262 227">
                        <g id="Vue.js_logo_strokes" fill="none" fill-rule="evenodd">
                            <g id="Path-2">
                                <polyline class="outer" stroke="#4B8" stroke-width="46"
                                    points="12.19 -24.031 131 181 250.351 -26.016">
                                </polyline>
                            </g>
                            <g id="Path-3" transform="translate(52)">
                                <polyline class="inner" stroke="#0038B8" stroke-width="42"
                                    points="15.797 -14.056 79 94 142.83 -17.863">
                                </polyline>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>
            {{-- links --}}
            <div class="ml-auto flex items-center space-x-4">
                <nav class="">
                    <ul class="flex space-x-4">
                        <li><a class="hover:underline" href="{{ route('gimnasio') }}">Gimnasios</a></li>
                        @if (request()->routeIs('principal'))
                            <li><a class="hover:underline" href="#nosotros">Sobre nosotros</a></li>
                        @endif
                        <li><a class="hover:underline" href="{{ route('perfil') }}">Perfil</a></li>
                    </ul>
                </nav>
                <a href="{{ route('perfil.create') }}"
                    class="text-white bg-button font-medium rounded-full
                text-sm px-5 py-2.5 text-center me-2 mb-2">Suscribete
                    ya!!</a>
            </div>
        </div>
    </header>
    {{-- Contenido --}}
    <main class="flex-1">
        @session('success')
        <div id="alert-box" class="m-3 z-50 absolute top-0 right-0">
            <div class="bg-green-700 rounded-lg text-white p-6">
                {{ $value }}
            </div>
        </div>
        @endsession
        @session('danger')
        <div id="alert-box" class="m-3 z-50 absolute top-0 right-0">
            <div class="bg-yellow-500 rounded-lg text-white p-6">
                {{ $value }}
            </div>
        </div>
        @endsession
        @session('error')
            <div id="alert-box" class="m-3 z-50 absolute top-0 right-0">
                <div class="bg-red-600 rounded-lg text-white p-6">
                    {{ $value }}
                </div>
            </div>
        @endsession
        <script>
            setTimeout(function () {
                let alertBox = document.getElementById('alert-box');
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(() => alertBox.remove(), 500); // Elimina el elemento después de la animación
                }
            }, 3000); // Desaparece después de 3 segundos
        </script>

        @yield('content')
    </main>
    {{-- footer --}}
    <footer class="bg-black text-white py-6">
        <div class="container mx-auto text-center">
            <h3 class="text-lg font-bold">Gimnasio {{ $panels[0]->nombre }}</h3>
            <p class="mt-2 text-sm">{{ $panels[0]->descripcion }}</p>
            <hr class="my-4 border-gray-700">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="font-semibold">Contactos:</p>
                    <p>{{ $panels[0]->celular }}</p>
                    <p>{{ $panels[0]->email }}</p>
                    <p>{{ $panels[0]->celular }}</p>
                </div>
                <div>
                    <p class="font-semibold">Horarios:</p>
                    <p>Lunes a Viernes: 6:00 AM - 10:00 PM</p>
                    <p>Sábados: 7:00 AM - 5:00 PM</p>
                    <p>Domingos: 8:00 AM - 2:00 PM</p>
                </div>
            </div>
            <hr class="my-4 border-gray-700">
            <p class="text-xs">&copy; {{ date('Y') }} Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
<script>
    document.querySelector('a[href="#nosotros"]').addEventListener('click', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado
        document.querySelector('#nosotros').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

</html>

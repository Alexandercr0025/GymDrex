<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | @yield('title')</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <header class="sticky top-0 z-50">
        <div class="py-4 bg-main flex px-4 items-center border-b-2 border-box">
            {{-- siderbar --}}
            <div></div>
            {{-- logo --}}
            <div>
                <a href="{{ Route('dashboard') }}">
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
            <div class="mx-10 flex items-center space-x-4">
                <nav class="">
                    <ul class="flex space-x-4">
                        <li><a class="hover:underline" href="{{ route('customer.index') }}">Clientes</a></li>
                        <li><a class="hover:underline" href="{{ route('dashboard.panel') }}">Empresa</a></li>
                    </ul>
                </nav>
            </div>
            <div class="ml-auto">
                <form action="{{ route('logout') }}" method="post">
                    @csrf

                    <button
                        class="text-white bg-button font-medium rounded-full
                        text-sm px-5 py-2.5 text-center">
                        Logout</button>
                </form>
            </div>
        </div>
    </header>
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
            setTimeout(function() {
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
</body>

</html>

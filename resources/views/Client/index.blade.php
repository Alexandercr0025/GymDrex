@extends('client.master')

{{-- titulo --}}
@section('title', 'DREX | Pagina principal')

{{-- contenido --}}
@section('content')

        <div class="h-screen">
            <div
                class="absolute inset-0 bg-cover bg-center brightness-50
            bg-[url('https://i0.wp.com/blog.smartfit.com.mx/wp-content/uploads/2024/05/movimiento-en-el-gym-progresion-peso-1-1024x576.jpg?resize=900%2C506&ssl=1')]">
            </div>
            <div class="relative text-white text-center mt-40">
                <div class="">
                    <h1 class="text-4xl md:text-9xl font-extrabold">Gimnasio {{ $panels[0]->nombre }}</h1>
                    <p class="text-2xl md:text-4xl font-bold">- {{ $panels[0]->slogan }} -</p>
                </div>
            </div>
        </div>

        <div id="nosotros">
            <div class="grid grid-cols-1 md:grid-cols-2 mx-4">
                <div>
                    <h1 class="text-3xl font-bold">Bienvenido a {{ $panels[0]->nombre }}</h1>
                    <p class="font-medium my-5">{{ $panels[0]->contenido }}</p>
                </div>
                <div class="flex items-center mx-auto">
                    <a href="{{ route('gimnasio') }}"
                        class="flex items-center text-black font-bold bg-transparent rounded-lg border border-button
                            text-sm px-3 pr-16 py-2 text-left">Busca
                        tu Ciudad...

                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="relative z-40 w-6 h-6 right-10 text-button">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white">
            <div>
                <div class="text-center my-5">
                    <h1 class="text-[#752E12] text-4xl font-bold my-3">Planes y Membresías</h1>
                    <h2 class="font-medium">Elige el plan que mejor se adapte a tu estilo de vida:</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 mx-32">
                    <div class="bg-main rounded-lg shadow-md m-4">
                        <div class="m-5">
                            <h3 class="font-bold text-lg text-center mx-20">Membresía Mensual</h3>
                            <ul class="list-disc mx-5 my-8">
                                <li>Acceso ilimitado al gimnasio durante 30 días.</li>
                                <li>Uso de zona de pesas, máquinas y entrenamiento funcional.</li>
                            </ul>
                            <p class="font-bold text-center">$ 12.23</p>
                        </div>
                    </div>
                    <div class="bg-box rounded-lg shadow-md m-4">
                        <div class="m-5">
                            <h3 class="font-bold text-lg text-center mx-20">Membresía Trimestral</h3>
                            <ul class="list-disc mx-5 my-8">
                                <li>Todos los beneficios de la membresía mensual.</li>
                                <li>Invitación gratuita para un amigo mensualmente.</li>
                            </ul>
                            <p class="font-bold text-center">$ 12.23</p>
                        </div>
                    </div>
                    <div class="bg-main rounded-lg shadow-md m-4">
                        <div class="m-5">
                            <h3 class="font-bold text-lg text-center mx-24">Membresía Anual</h3>
                            <ul class="list-disc mx-5 my-8">
                                <li>Todos los beneficios de la membresía trimestral.</li>
                                <li>Una sesión gratuita de entrenamiento personalizado cada trimestre.</li>
                            </ul>
                            <p class="font-bold text-center">$ 12.23</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="text-center my-5">
                    <h1 class="text-4xl font-bold my-3">Nuestros Servicios</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 mx-32">
                    <div class="bg-white rounded-lg shadow-lg m-4">
                        <div class="flex-col">
                            {{-- imagen --}}
                            <img class="rounded-lg object-cover" src="img\Client\huancayo.webp" alt="">
                            {{-- direccion --}}
                            <div class="mx-8 my-3">
                                <h2 class="text-3xl text-center font-bold">Zona de Pesas y Musculación</h2>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg m-4">
                        <div class="flex-col">
                            {{-- imagen --}}
                            <img class="rounded-lg object-cover" src="img\Client\huancayo.webp" alt="">
                            {{-- direccion --}}
                            <div class="mx-8 my-3">
                                <h2 class="text-3xl text-center font-bold">Clases Grupales</h2>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg m-4">
                        <div class="flex-col">
                            {{-- imagen --}}
                            <img class="rounded-lg object-cover" src="img\Client\huancayo.webp" alt="">
                            {{-- direccion --}}
                            <div class="mx-8 my-3">
                                <h2 class="text-3xl text-center font-bold">Entrenamiento Funcional</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-white my-5 mx-auto flex-1 text-center">
                    <a href="{{ route('perfil.create') }}"
                        class="text-white bg-button font-medium rounded-full
                    text-3xl px-16 py-2.5 text-center">Suscribete
                        ya!!</a>
                </div>
            </div>
        </div>
        <div class="bg-main">
            <div class="text-center my-5">
                <h1 class="text-4xl font-bold my-3">Mejores resultados?</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 mx-20 md:mx-64 mb-8">
                    <div class="bg-box rounded-lg shadow-md m-4 mx-14">
                        <div class="m-5">
                            <h3 class="font-bold text-lg text-center mx-10">Drex coach</h3>
                            <p class="mx-5 my-8">
                                Recibe guía personalizada de un coach experto cada vez que vayas al gym para optimizar tu entrenamiento.
                            </p>
                            <p class="font-bold text-center">$ 35.56</p>
                        </div>
                </div>
                <div class="mx-16">
                    <img class="object-scale-down" src="img\Client\perfil.png" alt="">
                </div>
            </div>
        </div>

@endsection

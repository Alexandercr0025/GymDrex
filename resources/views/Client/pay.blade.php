<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('app')['paypal_id'] }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div>
        <div class="flex m-5">
            <a href="{{ route('principal') }}" class="ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
            </a>
        </div>
        {{-- Crear alerta --}}
        {{-- <div id="alert-box"></div> --}}
        <div>
            <h1>Bienvenido {{ $customer->nombres }}</h1>
            <h2>usted esta registrado, continue su suscripcion...</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="flex-col">
                @foreach ($memberships as $m)
                    <div class="grid grid-cols-2">
                        <div>
                            <input type="radio" id="opcion_{{ $m->id }}" name="nombre"
                                value="{{ $m->id }}" data-precio="{{ $m->precio }}"
                                @if ($loop->first) checked @endif>
                            <label for="opcion_{{ $m->id }}">{{ $m->nombre }}</label>
                        </div>
                        <label for="opcion_{{ $m->id }}">{{ $m->precio }}</label>
                    </div>
                @endforeach
                {{-- <div class="grid grid-cols-2">
                    <div>
                        <input type="checkbox" id="coach" name="coach" value="1"
                            data-precio="{{ $coach->precio }}">
                        <label for="coach">{{ $coach->nombre }}</label>
                    </div>
                    <label for="coach">{{ $coach->precio }}</label>
                </div> --}}
                <div class="grid grid-cols-2">
                    <div>
                        <input type="checkbox" id="coach" name="coach" value="{{ $coach->id }}"
                            data-precio="{{ $coach->precio }}">
                        <label for="coach">{{ $coach->nombre }}</label>
                    </div>
                    <label for="coach">{{ $coach->precio }}</label>
                </div>
            </div>
            <div id="paypalButtons"></div>
        </div>
    </div>
    {{--
    aqui esta el paypal
    {{ $memberships[0]->beneficios }}
    <hr>
    {{-- @foreach (json_decode($memberships[0]->beneficios, true) as $beneficio)
        <li>{{ $beneficio }}</li>
    @endforeach --}}
</body>
<script>
    function obtenerPrecioSeleccionado() {
        let seleccionado = document.querySelector('input[name="nombre"]:checked');
        return seleccionado ? seleccionado.getAttribute("data-precio") : "0";
    }

    function obtenerCoachPrecioSeleccionado() {
        let coach = document.querySelector('#coach');
        return (coach && coach.checked) ? coach.getAttribute("data-precio") : "0";
    }

    function obtenerPrecioTotal() {
        let precioMembresia = obtenerPrecioSeleccionado(); // Precio de la membresía
        let precioCoach = obtenerCoachPrecioSeleccionado(); // Precio del coach
        return (parseFloat(precioMembresia) + parseFloat(precioCoach)).toFixed(2);
    }

    function obtenerMembresiaSeleccionada() {
        let seleccionado = document.querySelector('input[name="nombre"]:checked');
        return seleccionado ? seleccionado.value : null;
    }

    function obtenerCoachSeleccionado() {
        let coach = document.querySelector('#coach');
        return coach && coach.checked ? coach.value : 0;
    }

    paypal.Buttons({
        // usuario autenticado y acepta el pago
        createOrder: function(data, actions) {
            let precio = obtenerPrecioTotal();
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: precio,
                    }
                }]
            })
        },

        //
        onApprove: function(data, actions) {
            //enviar orden al servidor
            // console.log(precio)
            console.log(obtenerMembresiaSeleccionada())
            console.log(obtenerCoachSeleccionado())
            // axios.post('/paypal-process-order/'+data.orderID)
            // axios.post(`/paypal-process-order/${parseInt({{ $customer->id }})}/${data.orderID}`)

            if (obtenerCoachSeleccionado() == 0) {
                axios.post(
                    `/paypal-process-order/${parseInt({{ $customer->id }})}/${data.orderID}/${parseInt(obtenerMembresiaSeleccionada())}`
                ).then(response => {
                    if (response.data.success) {
                        mostrarAlerta(response.data.message, "success");
                        setTimeout(() => {
                            window.location.href = response.data.redirect;
                        }, 3000);
                    } else {
                        mostrarAlerta(response.data.message, "error");
                    }
                }).catch(error => {
                    console.error('Error procesando el pago:', error);
                    mostrarAlerta('Error inesperado. Intente de nuevo.', "error");
                });
            } else {
                axios.post(
                    `/paypal-process-order/${parseInt({{ $customer->id }})}/${data.orderID}/${parseInt(obtenerMembresiaSeleccionada())}/${parseInt(obtenerCoachSeleccionado())}`
                ).then(response => {
                    if (response.data.success) {
                        mostrarAlerta(response.data.message, "success");
                        setTimeout(() => {
                            window.location.href = response.data.redirect;
                        }, 3000);
                    } else {
                        mostrarAlerta(response.data.message, "error");
                    }
                }).catch(error => {
                    console.error('Error procesando el pago:', error);
                    mostrarAlerta('Error inesperado. Intente de nuevo.', "error");
                });
            }
            console.log('termino')
            // window.location.href = "{{ route('principal') }}";


            // axios.post(
            //     `/paypal-process-order/${parseInt({{ $customer->id }})}/${data.orderID}/${parseInt(obtenerMembresiaSeleccionada())}/${parseInt(obtenerCoachSeleccionado())}`
            //     )
            // axios.post(`/paypal-process-order/${customer_id}/${data.orderID}`, {
            //     membership: obtenerMembresiaSeleccionada(),
            //     coach: obtenerCoachSeleccionado()
            // })
        }

    }).render("#paypalButtons");

    function mostrarAlerta(mensaje, tipo) {
        let alertBox = document.createElement("div");
        alertBox.id = "alert-box";
        alertBox.className = "relative m-3 z-50 top-0 right-0";

        let alertContent = document.createElement("div");
        alertContent.className = tipo === "success" ? "bg-green-700 rounded-lg text-white p-6" :
            "bg-red-600 rounded-lg text-white p-6";
        alertContent.innerText = mensaje;

        alertBox.appendChild(alertContent);
        document.body.appendChild(alertBox);

        setTimeout(() => {
            alertBox.remove();
        }, 3000);
    }
</script>

</html>

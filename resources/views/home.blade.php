@extends('plantilla.plantilla')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        <!-- Versión "corta" -->
                        @if (session('error'))
                            <div>
                                <p>Está autorizado en la versión "Corta".</p>
                                <p>Corrije los siguentes errores:</p>
                            </div>

                            <div>
                                <div class="alert alert-danger" id="mensage_error">
                                    {{ session('error') }}
                                </div>
                                @if (session('error') == 'Serial numero de processador es incorrecto')
                                    <button id="pedirAyuda" class="btn btn-primary">
                                        Pedir ayuda online
                                    </button>
                                @endif

                                @if (session('error') == 'El servidor no está configurado. Configure el servidor.')
                                    <a href ="{{ route('configuracion.index') }}">
                                        <button id="pedirAyuda" class="btn btn-primary">
                                            Configurar el servidor.
                                        </button>
                                    </a>
                                @endif

                                <div class="d-none" id="button_comprobar_serial_number">
                                    <a href ="{{ route('home') }}">
                                        <button class="btn btn-primary mt-3">Comprobar cambio</button>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div>
                                <p>Está autorizado con exito!.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // funcion para enviar solicitud de cambio de serial number

        const buttonPedirAyuda = document.getElementById('pedirAyuda');

        buttonPedirAyuda.addEventListener('click', function(event) {
            var serialNumberProcessor = @json(session('serialNumberProcessor'));
            var localId = @json(session('localId'));

            $error_message = document.getElementById('mensage_error'); // ventana de message de error

            console.log(localId); // Verificar el valor de localId

            fetch('http://192.168.1.41:8000/api/verify-serial-change', {
                    method: 'POST',
                    body: JSON.stringify({
                        serialNumber: serialNumberProcessor,
                        local_id: localId || 1 // Usar localId de la sesión o 1 como fallback
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }

                })
                .then(response => response.json())
                .then(data => {

                        $button = document.getElementById('button_comprobar_serial_number');
                        $button.classList.remove('d-none');
                        $button.classList.add('d-block');

                    if (data.status === 'pending') {

                        $error_message.innerHTML = "Esperando confirmación del administrador";
                        $error_message.classList.remove('alert-danger', 'alert-success') ;
                        $error_message.classList.add('alert-warning');

                    } else if (data.status === 'ok') {
                        $error_message.innerHTML = "Serial number correcto.";
                        $error_message.classList.remove('alert-danger', 'alert-warning' );
                        $error_message.classList.add('alert-success');
                    }
                })
                .catch(error => {
                    $error_message.innerHTML = "Ocurrió un error al intentar enviar la solicitud.";
                    $error_message.classList.remove('alert-warning', 'alert-success');
                    $error_message.classList.add('alert-danger');
                });
        });
    </script>
@endsection

@extends('plantilla.plantilla')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 isla-list text-center p-2">
                <div class="">

                        <!-- Versión "corta" -->
                        @if (session('error'))
                            <div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <a class="btn btn-primary w-100 btn-ttl">Está autorizado en la versión "Corta"</a>
                                    </div>
                                </div>
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
                        @endif
                </div>
            </div>


            <!-- contenido principal -->

        <div class="container d-none d-md-block text-center pt-5">
            <div class="row">
                <div class="col-12 text-center d-flex justify-content-center mt-4 mb-3">
                    <div class="w-50 ttl">
                        <h1>Conexión dispositivos</h1>
                    </div>
                </div>

                <div class="col-12 text-center row justify-content-center mt-4 mb-3">
                    <div class="col-3 alert alert-warning m-2 alertInfo">Prometeo</div>
                    <div class="col-3 alert alert-warning m-2 alertInfo">ComDataHost</div>
                    <div class="col-3 alert alert-warning m-2 alertInfo">TicketServer</div>
                </div>

                <div class="mt-2">
                    <div class="row">
                        <div class="col-10 offset-1 isla-list">
                            <div class="pading-dinamico-3 pb-0">
                                <div class="row p-2">
                                    <div class="col-12">
                                        <a class="btn btn-primary w-100 btn-ttl">Dispositivos</a>
                                    </div>
                                </div>

                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Num</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Versión</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Comentario</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acumulados as $acumulado)
                                            <tr class="user-row
                                                @if ($acumulado->EstadoMaquina == 'OK')
                                                    bg-success-subtle
                                                @elseif ($acumulado->EstadoMaquina == 'ARRANCADO' || $acumulado->EstadoMaquina == 'LEYENDO DATOS')
                                                    bg-warning-subtle
                                                @elseif ($acumulado->EstadoMaquina == 'SIN DATOS' || $acumulado->EstadoMaquina == 'DESCONECTADO')
                                                    bg-danger-subtle
                                                @endif
                                            ">

                                                <td style="background-color:transparent">{{ $acumulado->NumPlaca }}</td>
                                                <td style="background-color:inherit">{{ $acumulado->nombre }}</td>
                                                <td style="background-color:inherit">{{ $acumulado->TipoProtocolo }}</td>
                                                <td style="background-color:inherit">{{ $acumulado->version }}</td>
                                                <td style="background-color:inherit">{{ $acumulado->EstadoMaquina }}</td>
                                                <td style="background-color:inherit">{{ $acumulado->comentario }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                   pagination
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-block d-md-none text-center pt-5">
            <div class="ttl d-flex align-items-center p-2">
                <div>
                    <a href="#" class="titleLink">
                        <i style="font-size: 30pt" class="bi bi-arrow-bar-left"></i>
                    </a>
                </div>
                <div>
                    <h1>Conexión dispositivos</h1>
                </div>
            </div>

            <div class="mt-5 p-3 isla-list">
                @if (count($acumulados) != 0)
                    <div class="row p-2 mb-4">
                        <div class="col-12">
                            <a class="btn btn-primary w-100 btn-ttl">Dispositivos</a>
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <table class="table table-bordered text-center overflow-auto">
                            <thead>
                                <tr>
                                    <th scope="col">Num</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Versión</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($acumulados as $acumulado)
                                    <tr class="user-row
                                        @if ($acumulado->EstadoMaquina == 'OK')
                                            bg-success-subtle
                                        @elseif ($acumulado->EstadoMaquina == 'ARRANCADO' || $acumulado->EstadoMaquina == 'LEYENDO DATOS')
                                            bg-warning-subtle
                                        @elseif ($acumulado->EstadoMaquina == 'SIN DATOS' || $acumulado->EstadoMaquina == 'DESCONECTADO')
                                            bg-danger-subtle
                                        @endif
                                    ">
                                        <td style="background-color:transparent">{{ $acumulado->NumPlaca }}</td>
                                        <td style="background-color:inherit">{{ $acumulado->nombre }}</td>
                                        <td style="background-color:inherit">{{ $acumulado->TipoProtocolo }}</td>
                                        <td style="background-color:inherit">{{ $acumulado->version }}</td>
                                        <td style="background-color:inherit">{{ $acumulado->EstadoMaquina }}</td>
                                        <td style="background-color:inherit">{{ $acumulado->comentario }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                          Pagination <!--  { $machines->links('vendor.pagination.bootstrap-5') }} -->
                    </div>
                @else
                    <p>No existen máquinas!</p>
                @endif
            </div>


        </div>
    </div>

    <script>
        // funcion para enviar solicitud de cambio de serial number

        function checkConnect () {

            const alertes = Array.from(document.querySelectorAll('.alertInfo'));
            console.log (alertes);

            setInterval (async () => {
                console.log ('k');
                const url = "/api/checkConexion"

                    fetch(url, {method: 'GET'})
                        .then (response => response.json())
                        .then (data => {

                            console.log (data);
                            alertes.forEach ((alert) => {
                                if (data) {
                                    // console.log ('ok', alert);
                                    alert.classList.remove('alert-warning');
                                    alert.classList.remove('alert-danger');
                                    alert.classList.add('alert-success');
                                } else {
                                    alert.classList.remove('alert-success');
                                    alert.classList.remove('alert-warning');
                                    alert.classList.add('alert-danger');
                                }
                            })
                        })
                        .catch (error => {
                            alertes.forEach (alert => {
                                alert.classList.remove('alert-success');
                                alert.classList.remove('alert-warning');
                                alert.classList.add('alert-danger');
                        })
                        })
                }, 10000);
            }



checkConnect ();



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

                        console.log(data);

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

        /*
        var configuracionTS_IP = @json(session('configuracionTS_IP'));
        var configuracionTS_Port = @json(session('configuracionTS_Port'));
        var configuracionCDH_IP = @json(session('configuracionCDH_IP'));
        var configuracionCDH_Port = @json(session('configuracionCDH_Port'));

        const conexiones = [{ ip:'192.168.1.41', port: '8000', alert: 'estado_Prometeo'},
                            { ip: configuracionTS_IP, port: configuracionTS_Port, alert: 'estado_TS'},
                            { ip: configuracionCDH_IP, port: configuracionCDH_Port, alert: 'estado_CDH'},
        ]

        function checkConnect () {



            conexiones.forEach ((conexion) => {
                console.log(conexion);
                const url = "http://" + conexion.ip + ':' + conexion.port;

                console.log (url);
                const alert = document.getElementById(conexion.alert);

             setInterval (async () => {
                  console.log ('k');
                  try {
                     const response = await fetch(utl, {method: 'GET'});
                     console.log ('response');
                        if (response.ok) {
                          console.log ('ok');
                          alert.classList.remove('alert-danger');
                          alert.classList.add('alert-success');
                     } else {
                            console.log ('no');
                            alert.classList.remove('alert-success');
                            alert.classList.add('alert-danger');
                     }
                 } catch (error) {
                      alert.classList.remove('alert-success');
                      alert.classList.add('alert-danger');
                      console.log ('error');
                 }
                }, 10000);
             })
        }
             */

    </script>
@endsection

@extends('plantilla.plantilla')
@section('titulo', 'Delegations')
@section('contenido')

<div class="container">
    <form action="{{ route('configuracion.update', $user_cambio->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="col-8 offset-2 isla-list p-4 mt-5 mb-5 border border-primary">
            <h2 class="mb-5"> Configurar conexión con maquina cambio</h2>

            <!-- IP -->
            <div class="form-floating">
                <input type="text" name="ip_cambio" class="form-control @error('ip_cambio') is-invalid @enderror"
                    id="ip_cambio" placeholder="IP"
                    @if (old('ip_cambio'))
                        value="{{ old('ip_cambio') }}"
                    @elseif ($user_cambio->ip)
                        value="{{$user_cambio->ip}}"
                    @endif>
                <label for="ip_cambio">IP</label>
                @if ($errors->has('ip_cambio'))
                    <div class="invalid-feedback"> {{ $errors->first('ip_cambio') }} </div>
                @endif
            </div>

            <!-- Puerto -->
            <div class="form-floating">
                <input type="text" name="port_cambio" class="form-control @error('port_cambio') is-invalid @enderror"
                    id="port_cambio" placeholder="Puerto"
                    @if (old('port_cambio'))
                        value="{{ old('port_cambio') }}"
                    @elseif ($user_cambio->port)
                        value="{{$user_cambio->port}}"
                    @endif>
                <label for="port_cambio">Puerto</label>
                @error('port_cambio')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>

        <div class="col-8 offset-2 isla-list p-4 mt-5 mb-5 border border-primary">
            <h2 class="mb-5"> Configurar ComDataHost</h2>

            <!-- IP -->
            <div class="form-floating pb-3">
                <input type="text" name="ip_comdatahost" class="form-control col-4 @error('ip_comdatahost') is-invalid @enderror"
                    id="ip_comdatahost" placeholder="IP"
                    @if (old('ip_comdatahost'))
                        value="{{ old('ip_comdatahost') }}"
                    @elseif ($user_comDataHost->ip)
                        value="{{$user_comDataHost->ip}}"
                    @endif>
                <label for="ip_comdatahost">IP</label>
                @error('ip_comdatahost')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>

            <!-- Puerto -->
            <div class="form-floating">
                <input type="text" name="port_comdatahost" class="form-control @error('port_comdatahost') is-invalid @enderror"
                    id="port_comdatahost" placeholder="Puerto"
                    @if (old('port_comdatahost'))
                        value="{{ old('port_comdatahost') }}"
                    @elseif ($user_comDataHost->port)
                        value="{{$user_comDataHost->port}}"
                    @endif>
                <label for="port_comdatahost">Puerto</label>
                @error('port_comdatahost')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>

         <!-- Botón de Enviar -->
        <div class="form-group mt-3 col-4 offset-4">
            <button type="submit" class="btn btn-primary w-100">Guardar configuración</button>
        </div>
    </form>
    <div class="d-flex">
        <a class="offset-4 col-4 pt-3 pb-3" href="{{ route('configuracion.buscar') }}">
            <button class="btn btn-primary w-100" >Obtener IP automaticámente</button>
        </a>
    </div>
    <div class="d-flex">
        <a class="offset-4 col-4 pt-3 pb-3" data-bs-toggle="modal"
           data-bs-target="#modalAccionesLocal{{ $user_cambio->id }}">
            <button class="btn btn-danger w-100" >Borrar datos de configuración</button>
        </a>
    </div>
    <!--MODAL ACCIONES-->
    <div class="modal fade" id="modalAccionesLocal{{ $user_cambio->id }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalAcciones" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">!Eliminar
                        configuración!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estas seguro que quieres eliminar datos del configuración?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('configuracion.destroy', $user_cambio->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


                                        <!--Modal eliminar-->
                                        <div class="modal fade" id="eliminarModal1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="eliminarModal1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">!Eliminar
                                                            configuración!</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estas seguro que quieres eliminar datos del configuración?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('configuracion.destroy', $user_cambio->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

@endsection

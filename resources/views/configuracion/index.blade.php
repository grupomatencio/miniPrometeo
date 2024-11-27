@extends('plantilla.plantilla')
@section('titulo', 'Delegations')
@section('contenido')

<div class="container">
    <form action="{{ route('configuracion.update', $data['user_cambio']) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="col-8 offset-2 isla-list p-4 mt-2 mb-2 border border-primary">
            <h2 class="mb-3"> Configurar conexión con maquina cambio</h2>

            <!-- IP -->
            <div class="form-floating pb-3">
                <input type="text" name="ip_cambio" class="form-control @error('ip_cambio') is-invalid @enderror"
                    id="ip_cambio" placeholder="IP"
                    @if (old('ip_cambio'))
                        value="{{ old('ip_cambio') }}"
                    @elseif ($data['user_cambio']->ip)
                        value="{{$data['user_cambio']->ip}}"
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
                    @elseif ($data['user_cambio']->port)
                        value="{{$data['user_cambio']->port}}"
                    @endif>
                <label for="port_cambio">Puerto</label>
                @error('port_cambio')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>

        <div class="col-8 offset-2 isla-list p-4 mt-2 mb-2 border border-primary">
            <h2 class="mb-3"> Configurar ComDataHost</h2>

            <!-- IP -->
            <div class="form-floating pb-3">
                <input type="text" name="ip_comdatahost" class="form-control col-4 @error('ip_comdatahost') is-invalid @enderror"
                    id="ip_comdatahost" placeholder="IP"
                    @if (old('ip_comdatahost'))
                        value="{{ old('ip_comdatahost') }}"
                    @elseif ($data['user_comDataHost']->ip)
                        value="{{$data['user_comDataHost']->ip}}"
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
                    @elseif ($data['user_comDataHost']->port)
                        value="{{$data['user_comDataHost']->port}}"
                    @endif>
                <label for="port_comdatahost">Puerto</label>
                @error('port_comdatahost')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>

        <div class="col-8 offset-2 isla-list p-4 mt-2 mb-2 border border-primary">
            <h2 class="mb-3"> Configurar disposición</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Delegación</th>
                        <th scope="col">Zona</th>
                        <th scope="col">Local</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{$data['name_delegation']}}
                        </td>
                        <td>
                            {{$data['name_zona']}}
                        </td>
                        <td>
                            @if (count($data['locales']) === 1 )
                                {{$data['locales'][0] -> name }}
                            @else
                                <select name="locales" class="form-control @error('locales') is-invalid @enderror">
                                    <option value =""> == Elije un Local ==</option>
                                    @foreach ($data['locales'] as $local)
                                        <option value = "{{$local -> id}}">{{$local -> name}} </option>
                                    @endforeach
                                </select>
                                @error('locales')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
                @if (session ('errorSerialNumber'))
                    <div class="text-danger fw-semibold text-center">{{ session ('errorSerialNumber') }} </div>
                @endif
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
           data-bs-target="#modalAccionesLocal{{ $data['user_cambio']->id }}">
            <button class="btn btn-danger w-100" >Borrar datos de configuración</button>
        </a>
    </div>
    <!--MODAL ACCIONES-->
    <div class="modal fade" id="modalAccionesLocal{{ $data['user_cambio']->id }}"
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
                    <form action="{{ route('configuracion.destroy', $data['user_cambio']) }}"
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
                                                        <form action="{{ route('configuracion.destroy', $data['user_cambio']) }}"
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

@extends('plantilla.plantilla')
@section('titulo', 'Delegations')
@section('contenido')
    <div class="container d-none d-md-block">
        <div class="row">
            <div class="col-12 text-center d-flex justify-content-center mt-3 mb-3" id="headerAll">
                <div class="w-50 ttl">
                    <h1>Sincronización </h1>
                </div>
            </div>
            <div class="d-flex justify-content-around">

                    <div class="row mt-5 p-5 col-6 border border-primary">
                        <h2 class="pt-3 pb-3 text-center">Quiere sincronizar?</h2>
                        <div class="col-6">
                            <a class="btn btn-primary w-100 btn-ttl me-2">SI</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-warning w-100 btn-ttl ms-2">NO</a>
                        </div>
                    </div>
            </div>

            <div class="d-flex justify-content-around">
                <div class="row mt-5 p-5 col-6 border border-primary">
                    <div class="col-12">
                        <a class="btn btn-primary w-100 btn-ttl me-2">Conexiones dispositivos</a>
                    </div>
                </div>
        </div>
        </div>
    </div>
@endsection

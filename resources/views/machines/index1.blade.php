@extends('plantilla.plantilla')
@section('titulo', 'Delegations')
@section('contenido')
    <div class="container d-none d-md-block">
        <div class="row">
            <div class="col-12 text-center d-flex justify-content-center mt-3 mb-3" id="headerAll">
                <div class="w-50 ttl">
                    <h1>Máquinas delegación </h1>
                </div>
            </div>

            <div class="col-10 offset-1 mt-5">
                <div class="row">
                    <div class="col-10 offset-1 isla-list">
                        <div class="p-4 pb-0">
                            <div class="row p-2">
                                <div class="col-12">
                                    <a class="btn btn-primary w-100 btn-ttl">Máquinas</a>
                                </div>
                            </div>
                            <form action="#" method="GET" class="mb-4"
                                autocomplete="off">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar máquinas...">
                                    <div class="input-group-append">
                                        <button class="btn btn-warning" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col"><a class="btn btn-primary w-100 btn-ttl"
                                                href="#">+</a></th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Identificador</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="col-4 offset-8 pb-4">
                                <a class="btn btn-danger w-100" data-bs-toggle="modal"
                                    data-bs-target="#modalPdf">Exportar <i class="bi bi-filetype-pdf"></i></a>

                                <!-- MODAL EXPORTAR PDF -->
                                <div class="modal fade" id="modalPdf" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="modalPdfLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalPdfLabel">¿Qué máquinas quieres
                                                    exportar?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <a class="btn btn-warning w-100 mb-2"
                                                        href="#">Máquinas
                                                        Salones</a>
                                                    <a class="btn btn-warning w-100"
                                                        href="#">Máquinas
                                                        Bares</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                Paginat
                            </div>
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
                <h1>Máquinas delegación NAME</h1>
            </div>
        </div>

        <div class="mt-5 p-3 isla-list">

        </div>
    </div>
@endsection

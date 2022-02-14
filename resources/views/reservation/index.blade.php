@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reservas</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Introduce el nombre de la clase o la fecha de la sesion a la que te gustaría unirte</div>
                <div class="card-body">
                    @csrf
                    <!-- ACTIVITY -->
                    <div class="row ms-auto">
                        <div class="btn-toolbar d-flex justify-content-center" role="toolbar">
                            <!-- Filter by activity name -->
                            <form class="d-flex form" action="">
                                <div class="input-group me-3">
                                    <div class="input-group-text" id="btnGroupAddon">Por Actividad</div>
                                    <input type="text" class="form-control filter-by-activity" placeholder="Boxeo" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                </div>
                            </form>

                            <!-- Filter by start date of the session -->
                            <form class="d-flex form" action="">
                                <div class="input-group me-3">
                                    <div class="input-group-text" id="btnGroupAddon">Por Fecha</div>
                                    <input type="text" class="form-control filter-by-date" placeholder="2022-02-25" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                </div>
                            </form>

                            <!-- Button to run the filtering query -->
                            <!-- <div class="btn-group me-2" role="group">
                                <input class="btn btn-primary btn-form" type="submit" value="Buscar">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container holding the AJAX table -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9 table-container">
            <!-- Table generated with JavaScript and AJAX -->
            <table class="table table-striped table-data text-center">
                <tr>
                    <th>Actividad</th>
                    <th>Dia de la semana</th>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Fecha</th>
                    <th>Añadir</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/sesion_filter.js') }}"></script>
@endsection
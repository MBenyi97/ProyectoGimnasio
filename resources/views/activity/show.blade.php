@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>
                <strong>{{$activity->name}}</strong>
                <a href="/activities" class="btn btn-danger">Atrás</a>
            </h1>

            <table class="table table-striped">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Capacidad</th>
                </tr>
                <tr>
                    <td>{{$activity->name}} </td>
                    <td>{{$activity->description}} </td>
                    <td>{{$activity->duration}} </td>
                    <td>{{$activity->capacity}} </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Sesiones</h1>

            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha final</th>
                </tr>
                @foreach($sesions as $sesion)
                @if ($sesion->activity_id==$activity->id)
                <tr>
                    <td>{{$activity->name}}</td>
                    <td>{{$sesion->date_start}} </td>
                    <td>{{$sesion->date_end}} </td>
                </tr>
                @else
                <tr>
                    <td colspan="3" class="text-center fw-bold">No hay sesiones registradas</td>
                </tr>
                @endif
                @endforeach
            </table>

        </div>
    </div>
</div>
@endsection
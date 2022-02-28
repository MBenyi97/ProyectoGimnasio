@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/activities">Actividades</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sesiones</li>
                </ol>
            </nav>

            <h1>
                <strong>{{$activity->name}}</strong>
                <a href="/activities" class="btn btn-danger">Atrás</a>
            </h1>

            <table class="table table-striped table-hover text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Capacidad</th>
                </tr>
                <tr>
                    <td>{{$activity->name}}</td>
                    <td>{{$activity->description}}</td>
                    <td>{{$activity->duration}}</td>
                    <td>
                        @php
                        $users = 0;
                        foreach ($activity->sesions as $sesion){
                        $users+=count($sesion->users);
                        }@endphp
                        {{$users}}/{{(count($activity->sesions)==0 ? '1' : count($activity->sesions)) * $activity->capacity}}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Sesiones</h1>
            <table class="table table-striped table-hover text-center">
                <tr>
                    <th>Actividad</th>
                    <th>Dia de la semana</th>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Fecha</th>
                    
                </tr>
                @forelse($activity->sesions as $sesion)
                <tr>
                    <td>{{$activity->name}}</td>
                    <td>{{$sesion->weekDay}} </td>
                    <td>{{Carbon\Carbon::parse($sesion->hour_start)->format('H:i')}}</td>
                    <td>{{Carbon\Carbon::parse($sesion->hour_end)->format('H:i')}}</td>
                    <td>{{Carbon\Carbon::parse($sesion->date)->format('d-m-Y')}} </td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center fw-bold">No hay sesiones registradas</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
<script src="https://unpkg.com/turbolinks"></script>
@endsection
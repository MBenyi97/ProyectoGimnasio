@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sesiones</li>
                </ol>
            </nav>
            <div class="btn-toolbar d-flex justify-content-between align-middle" role="toolbar">
                <h1>Lista de sesiones</h1>
                <div class="input-group">
                    <div class="container-fluid">
                        <form class="d-flex form-filter" action="/sesions" method="get">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" class="form-control filter-by-name" placeholder="Filtrar por actividad" name="name" value="{{$name}}">
                                <input class="btn btn-primary" type="submit" value="Filtrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <table class="table table-striped table-hover text-center">
                <tr>
                    <th>Actividad</th>
                    <th>Día de la semana</th>
                    <th>Duración</th>
                    <th>Capacidad</th>
                    <th>Hora inicial</th>
                    <th>Fecha</th>
                </tr>
                @forelse ($sesions as $sesion)
                <tr>
                    <td>{{$sesion->activity->name}}</td>
                    <td>{{$sesion->weekDay}}</td>
                    <td>{{$sesion->activity->duration}} mins</td>
                    <td>
                        @php
                        $users=count($sesion->users);
                        @endphp
                        {{$users}}/{{$sesion->activity->capacity}}
                    </td>
                    <td>{{Carbon\Carbon::parse($sesion->hour_start)->format('H:i')}}</td>
                    <td>{{Carbon\Carbon::parse($sesion->date)->format('d-m-Y')}} </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center fw-bold">No hay sesiones registradas</td>
                </tr>
                @endforelse
            </table>
            {{$sesions->links("pagination::bootstrap-4")}}
        </div>
    </div>
</div>
@endsection
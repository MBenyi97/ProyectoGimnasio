@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Activitidades</li>
                </ol>
            </nav>
            <div class="btn-toolbar d-flex justify-content-between align-middle" role="toolbar">
                <h1>Lista de actividades</h1>
                <div class="input-group">
                    <div class="container-fluid">
                        <form class="d-flex form-filter" action="/activities" method="get">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" class="form-control filter-by-name" placeholder="Filtrar por actividad" name="name" value="{{$name}}">
                                <input class="btn btn-primary" type="submit" value="Filtrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped text-center table-hover">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Capacidad total</th>
                </tr>
                @forelse ($activities as $activity)
                <tr>
                    <td>{{$activity->name}} </td>
                    <td>{{$activity->description}} </td>
                    <td>{{$activity->duration}} mins</td>
                    <td>{{$activity->total}}</td>
                    <td>{{$activity->users}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center fw-bold"><strong>No hay actividades registradas</strong></td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
<script src="https://unpkg.com/turbolinks"></script>
@endsection
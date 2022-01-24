@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Lista de actividades
                <a href="/activities/create" class="btn btn-primary float-right">
                    Nuevo
                </a>
            </h1>


            <table class="table table-striped">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Capacidad</th>
                    <th>Opciones</th>
                </tr>
                @forelse ($activities as $activity)
                <tr>
                    <td>{{$activity->activity}} </td>
                    <td>{{$activity->description}} </td>
                    <td>{{$activity->duration}} </td>
                    <td>{{$activity->capacity}} </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/activities/{{$activity->id}}">Ver</a>
                        <a class="btn btn-primary btn-sm" href="/activities/{{$activity->id}}/edit">Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">No hay acticidades registradas</td>
                </tr>
                @endforelse
            </table>





        </div>
    </div>
</div>
@endsection
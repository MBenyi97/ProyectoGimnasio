@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Lista de actividades
                <a href="/sesions/create" class="btn btn-success btn-lg float-right" role="button">
                    Nuevo
                </a>
            </h1>


            <table class="table table-striped">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Capacidad</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @forelse ($sesions as $sesion)
                <tr>
                    
                    <td>{{$sesion->fechaSesion}} </td>
                    <td>{{$sesion->horaInicio}} </td>
                    <td>{{$sesion->horaFinal}} </td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="/sesions/{{$sesion->id}}">Ver</a>
                        <a class="btn btn-warning" href="/sesions/{{$sesion->id}}/edit">Editar</a>
                        <!-- <a class="btn btn-danger" href="/sesions/{{$sesion->id}}">Borrar</a> -->
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
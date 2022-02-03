@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Lista de actividades
                <a href="/activities/create" class="btn btn-success btn-lg float-right" role="button">
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
                @forelse ($activities as $activity)
                <tr>
                    <td>{{$activity->name}} </td>
                    <td>{{$activity->description}} </td>
                    <td>{{$activity->duration}} </td>
                    <td>{{$activity->capacity}} </td>
                    <td class="text-center">
                        <!-- <a class="btn btn-danger" href="/activities/{{$activity->id}}">Borrar</a> -->
                        <form method="POST" action="/activities/{{$activity->id}}">
                            @csrf
                            
                            <input type="hidden" name="_m ethod" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                {{ __('Eliminar') }}
                            </button>
                        </form>
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
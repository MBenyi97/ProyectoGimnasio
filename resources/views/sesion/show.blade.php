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
                <h1>Tus sesiones {{$user->name}}</h1>
            </div>


            <table class="table table-striped table-hover text-center">
                <tr>
                    <th>Actividad</th>
                    <th>Día de la semana</th>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
                @forelse ($sesions as $sesion)
                <tr>
                    <td>{{$sesion->activity->name}}</td>
                    <td>{{$sesion->weekDay}}</td>
                    <td>{{Carbon\Carbon::parse($sesion->hour_start)->format('H:i')}}</td>
                    <td>{{Carbon\Carbon::parse($sesion->hour_end)->format('H:i')}}</td>
                    <td>{{Carbon\Carbon::parse($sesion->date)->format('d-m-Y')}} </td>
                    <td>
                        <form method="POST" action="/sesions/{{$sesion->id}}">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                <a class="btn btn-danger remove-sesion"><i class="bi bi-trash"></i></a>
                            </div>
                        </form>
                    </td>
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
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Actividades</li>
                </ol>
            </nav>

            <div class="btn-toolbar d-flex justify-content-between align-middle" role="toolbar">
                <h1>Lista de actividades
                    <a href="/activities/create" class="btn btn-success float-right" role="button">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </h1>
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
                    <th>Capacidad</th>
                    <th>Opciones</th>
                </tr>
                @forelse ($activities as $activity)
                <tr>
                    <td>{{$activity->name}} </td>
                    <td>{{$activity->description}} </td>
                    <td>{{$activity->duration}} </td>
                    <td>{{$activity->capacity}} </td>
                    <td>
                        <form method="POST" action="/activities/{{$activity->id}}" id="form-delete">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-primary" href="/activities/{{$activity->id}}"><i class="bi bi-collection"></i></a>
                                <a class="btn btn-warning" href="/activities/{{$activity->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-danger remove-activity"><i class="bi bi-trash"></i></a>
                            </div>
                        </form>
                    </td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center fw-bold"><strong>No hay actividades registradas</strong></td>
                </tr>
                @endforelse
            </table>
            {{$activities->links("pagination::bootstrap-4")}}
        </div>
    </div>
</div>
@if(Session::has('message'))
<script type="text/javascript">
    Swal.fire({
        title: "{{ Session::get('title') }}",
        text: "{{ Session::get('message') }}",
        icon: 'success'
    });
</script>
@endif
<script type="text/javascript">
    $(".remove-activity").click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Estás seguro?',
            text: "No podrás revertir los cambios!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isDismissed) {
                Swal.fire(
                    'Cancelado',
                    'Tu actividad no ha sido eliminada',
                    'error'
                );
            }
            if (result.isConfirmed) {
                Swal.fire(
                    'Borrado!',
                    'La actividad ha sido eliminada.',
                    'success'
                ).then(function() {
                    form.submit();
                });
            }
        });
    });
</script>
<script src="https://unpkg.com/turbolinks"></script>
@endsection
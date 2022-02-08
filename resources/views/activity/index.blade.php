@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actividades</li>
  </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Lista de actividades
                <a href="/activities/create" class="btn btn-success btn-lg float-right" role="button">
                    <i class="bi bi-plus-lg"></i>
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
                        <form method="POST" action="/activities/{{$activity->id}}" id="form-delete">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="/activities/{{$activity->id}}"><i class="bi bi-collection"></i></a>
                            <a class="btn btn-warning" href="/activities/{{$activity->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger remove-activity"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center fw-bold"><strong>No hay actividades registradas</strong></td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
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
@endsection
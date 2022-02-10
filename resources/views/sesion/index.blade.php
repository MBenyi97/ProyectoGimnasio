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
                <h1>Lista de sesiones
                    <a href="/sesions/create" class="btn btn-success btn-lg float-right" role="button">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </h1>
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
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </tr>
                @forelse ($activities as $activity)
                @foreach ($activity->sesions as $sesion)
                <tr>
                    <td>{{$sesion->activity->name}}</td>
                    <td>{{$sesion->weekDay}}</td>
                    <td>{{$sesion->hour_start}} </td>
                    <td>{{$sesion->hour_end}} </td>
                    <td>{{$sesion->date}} </td>
                    <td>
                        <form method="POST" action="/sesions/{{$sesion->id}}">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                <!-- <a class="btn btn-primary add-reservation" href="/reservations/create/{{$sesion->id}}" data-id="{{$sesion->id}}"><i class="bi bi-bookmark-plus"></i></a> -->
                                <a class="btn btn-warning" href="/sesions/{{$sesion->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                                <a class="btn btn-danger remove-sesion"><i class="bi bi-trash"></i></a>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
                @empty
                <tr>
                    <td colspan="4" class="text-center fw-bold">No hay sesiones registradas</td>
                </tr>
                @endforelse
            </table>
            {{$activities->links("pagination::bootstrap-4")}}

        </div>
    </div>
</div>
<script type="text/javascript">
    $(".remove-sesion").click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
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
                    'Tu sesión no ha sido eliminada',
                    'error'
                );
            }
            if (result.isConfirmed) {
                Swal.fire(
                    'Borrado!',
                    'La sesión ha sido eliminada.',
                    'success'
                ).then(function() {
                    form.submit();
                });
            }
        });
    });

    $(".add-reservation").click(function(event) {
        var form = $(this).closest("form");
        var sesion_id = $(this).data("id");
        event.preventDefault();
        Swal.fire({
            title: 'Confirmar',
            text: "Quieres unirte a esta clase?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, unirme!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isDismissed) {
                Swal.fire(
                    'Cancelado',
                    'No te has unido a esta clase',
                    'error'
                );
            }
            if (result.isConfirmed) {
                Swal.fire(
                    'Reservada!',
                    'Te has unido a la clase.',
                    'success'
                ).then(function() {
                    location.replace('/reservations/create/' + sesion_id);
                });
            }
        });
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Sesiones</li>
  </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Lista de sesiones
                <a href="/sesions/create" class="btn btn-success btn-lg float-right" role="button">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </h1>


            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha final</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @forelse ($sesions as $sesion)
                <tr>
                    <td>
                        @if ($sesion->activity_id == $sesion->activity->id)
                        {{$sesion->activity->name}}
                        @endif
                    </td>
                    <td>{{$sesion->date_start}} </td>
                    <td>{{$sesion->date_end}} </td>
                    <td class="text-center">
                        <form method="POST" action="/sesions/{{$sesion->id}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary add-reservation" href="/reservations/create/{{$sesion->id}}" data-id="{{$sesion->id}}"><i class="bi bi-bookmark-plus"></i></a>
                            <a class="btn btn-warning" href="/sesions/{{$sesion->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger remove-sesion"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center fw-bold">No hay sesiones registradas</td>
                </tr>
                @endforelse
            </table>
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
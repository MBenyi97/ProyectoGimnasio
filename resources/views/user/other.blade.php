@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/users">Usuarios</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reservas</li>
              </ol>
            </nav>
            <h1>
                Sesiones reservadas por el usuario <strong>{{$user->name}}</strong>
                <a href="/users" class="btn btn-danger">Atrás</a>
            </h1>

            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Día de la semana</th>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Fecha</th>
                    <th>Fecha de la reserva</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @forelse ($user->sesions as $sesion)
                <tr>
                    <td>{{$sesion->activity->name}}</td>
                    <td>{{$sesion->weekDay}}</td>
                    <td>{{$sesion->hour_start}} </td>
                    <td>{{$sesion->hour_end}} </td>
                    <td>{{Carbon\Carbon::parse($sesion->date)->format('d-m-Y')}} </td>
                    <td>{{$sesion->reservations->created_at}}</td>
                    <td class="text-center">
                        <form method="POST" action="/reservations/{{$user->id}}/{{$sesion->id}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger remove-reservation"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center fw-bold"><strong>No hay reservas</strong></td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".remove-reservation").click(function(event) {
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
                    'La reserva no ha sido eliminada',
                    'error'
                );
            }
            if (result.isConfirmed) {
                Swal.fire(
                    'Borrado!',
                    'La reserva ha sido eliminada.',
                    'success'
                ).then(function() {
                    form.submit();
                });
            }
        });
    });
</script>
@endsection
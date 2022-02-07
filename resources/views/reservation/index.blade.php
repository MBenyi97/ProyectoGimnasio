@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Lista de sesiones reservadas por el usuario <strong>{{$data['user']->name}}</strong></h1>

            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Fecha y hora inicial</th>
                    <th>Fecha y hora final</th>
                    <th>Fecha de la reserva</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @forelse ($reservations as $reservation)
                <tr>
                    @foreach ($data['activities'] as $activity)
                    @foreach ($data['activityNames'] as $activityName)
                    @if ($activity->name == $activityName)
                    <td>{{$activityName}} </td>
                    @endif
                    @endforeach
                    @endforeach
                    @foreach ($data['sesions'] as $sesion)
                    @if ($sesion->id == $reservation->sesion_id)
                    <td>{{$sesion->date_start}} </td>
                    <td>{{$sesion->date_end}} </td>
                    @endif
                    @endforeach
                    <td>{{$reservation->date}} </td>
                    <td class="text-center">
                        <form method="POST" action="/reservations/{{$reservation->id}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger remove-reservation"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center fw-bold"><strong>No hay reservas</strong></td>
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
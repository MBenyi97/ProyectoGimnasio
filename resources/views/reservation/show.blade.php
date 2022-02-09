@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clases inscritas</li>
              </ol>
            </nav>
            <h1>Lista de sesiones reservadas por el usuario <strong>{{$user->name}}</strong></h1>

            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Fecha y hora inicial</th>
                    <th>Fecha y hora final</th>
                    <th>Fecha de la reserva</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @forelse ($user->sesions as $sesion)
                <tr>
                    <td>{{$sesion->activity->name}} </td>
                    <td>{{$sesion->date_start}} </td>
                    <td>{{$sesion->date_end}} </td>
                    <td>{{$sesion->reservations->created_at}}</td>
                    <td class="text-center">
                        <form method="POST" action="/reservations/{{$sesion->id}}">
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
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
            <h1>Sesiones</h1>

            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Dia de la semana</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha final</th>
                </tr>
                @forelse($activity->sesions as $sesion)
                <tr>
                    <td>{{$activity->name}}</td>
                    <td>{{$sesion->weekDay}} </td>
                    <td>{{$sesion->date_start}} </td>
                    <td>{{$sesion->date_end}} </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center fw-bold">No hay sesiones registradas</td>
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
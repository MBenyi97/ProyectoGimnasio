@extends('reservation.index')

@section('table')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clases</li>
                </ol>
            </nav>
            <h1>Sesiones</h1>

            <table class="table table-striped">
                <tr>
                    <th>Actividad</th>
                    <th>Dia de la semana</th>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </tr>
               
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(".add-reservation").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Confirmar',
            text: "Quieres unirte a esta sesión?",
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
                    'No te has unido a esta clase',
                    'error'
                );
            }
            if (result.isConfirmed) {
                Swal.fire(
                    'Inscrit@!',
                    'Te has unido a esta clase.',
                    'success'
                );
            }
        });
    });
</script>
@endsection
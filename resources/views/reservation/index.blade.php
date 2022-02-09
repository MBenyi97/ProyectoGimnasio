@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reservas</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Introduce el nombre de la clase a la que te gustaría unirte</div>
                <div class="card-body">
                    @csrf
                    <!-- ACTIVITY -->
                    <div class="row ms-auto">
                        <div class="btn-toolbar d-flex justify-content-center" role="toolbar">
                            <form class="d-flex form" action="">
                                <div class="input-group me-3">
                                    <div class="input-group-text" id="btnGroupAddon">Actividad</div>
                                    <input type="text" class="form-control filter" placeholder="Escribe aquí" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                </div>

                                <div class="btn-group me-2" role="group">
                                    <input class="btn btn-primary btn-form" type="submit" value="Buscar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ajax-loader">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-form').click(function(e) {
            e.preventDefault();
            data = $('.filter').val();
            // $.get("/reservations/filter?filter=" + data);

            $.get("/reservations/filter?filter=" + data, function(data, status) {
                console.log("Data: " + data + " \nStatus: " + status);
                var json = JSON.stringify(data, undefined, 4);
                $('.ajax-loader').html(json);
            });
        });
    });

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
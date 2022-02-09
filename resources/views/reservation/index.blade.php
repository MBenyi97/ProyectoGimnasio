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

                                <!-- <div class="btn-group me-2" role="group">
                                    <input class="btn btn-primary btn-form" type="submit" value="Buscar">
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12" id="table">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.filter').on('keyup', function(e) {
            e.preventDefault();
            key = $(this).val();
            (key == '') ? emptyTable(): request(key);
        });

        function request(data) {
            $.get("/reservations/filter?filter=" + data, function(data, status) {
                loadTable(data);
            });
        }

        function loadTable(data) {
            var entry_data, sesion, activity_name, weekDay, date_start, date_end;
            data.forEach((activity) => {
                activity_name = '<td>' + activity.name + '</td>';
                activity.sesions.forEach(function(sesion) {
                    weekDay = '<td>' + sesion.weekDay + '</td>';
                    date_start = '<td>' + sesion.date_start + '</td>';
                    date_end = '<td>' + sesion.date_end + '</td>';
                    entry_data += '<tr id="entry-row">' + activity_name + weekDay + date_start + date_end + '</tr>';
                });
            });
            $('#table').html('<table class="table table-striped" id="table-data"><tr><th>Actividad</th><th>Día de la semana</th><th>Fecha y hora inicial</th><th>Fecha y hora final</th></tr></table>');
            $('#table-data').append(entry_data);
        }

        function emptyTable() {
            $('#table').html('');
        }
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
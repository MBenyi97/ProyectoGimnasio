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
                <div class="card-header">Introduce el nombre de la clase o la fecha de la sesion a la que te gustaría unirte</div>
                <div class="card-body">
                    @csrf
                    <!-- ACTIVITY -->
                    <div class="row ms-auto">
                        <div class="btn-toolbar d-flex justify-content-center" role="toolbar">
                            <!-- Filter by activity name -->
                            <form class="d-flex form" action="">
                                <div class="input-group me-3">
                                    <div class="input-group-text" id="btnGroupAddon">Por Actividad</div>
                                    <input type="text" class="form-control filter-by-activity" placeholder="Boxeo" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                </div>
                            </form>

                            <!-- Filter by start date of the session -->
                            <form class="d-flex form" action="">
                                <div class="input-group me-3">
                                    <div class="input-group-text" id="btnGroupAddon">Por Fecha</div>
                                    <input type="text" class="form-control filter-by-date" placeholder="2022-02-25" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                </div>
                            </form>

                            <!-- Button to run the filtering query -->
                            <!-- <div class="btn-group me-2" role="group">
                                <input class="btn btn-primary btn-form" type="submit" value="Buscar">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container holding the AJAX table -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 table-container">
            <!-- Table generated with JavaScript and AJAX -->
            @yield('table')
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/by_activity_name.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/by_sesion_date.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Code to filter by activity name
        $('.filter-by-activity').on('keyup', function(e) {
            e.preventDefault();
            key = $(this).val();
            const regLetters = /^[A-Z]|[a-z]/;
            (key.match(regLetters)) ? request(key): emptyTable();

            // Sends the get request to obtain the activity
            function request(data) {
                $.get("/reservations/filter?filter=" + data, function(data, status) {
                    (data != '') ? loadTableByName(data): false;
                });
            }

            // Loads the table with the activities output
            function loadTableByName(data) {
                $('.table-container').html('<table class="table table-striped table-data text-center"><tr><th>Actividad</th><th>Dia de la semana</th><th>Hora inicial</th><th>Hora final</th><th>Fecha</th><th>Añadir</th></tr></table>');
                var entry_data, activity_name, weekDay, date, hour_start, hour_end, join_btn;
                data.forEach(function(activity) {
                    activity_name = '<td>' + activity.name + '</td>';
                    activity.sesions.forEach(function(sesion) {
                        weekDay = '<td>' + sesion.weekDay + '</td>';
                        date = '<td>' + sesion.date + '</td>';
                        hour_start = '<td>' + sesion.hour_start + '</td>';
                        hour_end = '<td>' + sesion.hour_end + '</td>';
                        join_btn = ' <td><a class="btn btn-primary add-reservation" href="/reservations/create/' + sesion.id + '"><i class="bi bi-bookmark-plus"></i></a></td>';
                        entry_data += '<tr id="entry-row">' + activity_name + weekDay + hour_start + hour_end + date + join_btn + '</tr>';
                    });
                });
                $('.table-data').append(entry_data);
            }
        });

        // Code to filter by sesion date
        $('.filter-by-date').on('keyup', function(e) {
            e.preventDefault();
            key = $(this).val();
            const regLetters = /^\d{4}\-\d{2}\-\d{2}$/;
            (key.match(regLetters)) ? request(key): emptyTable();

            // Sends the get request to obtain the activity
            function request(data) {
                $.get("/reservations/filter?filter=" + data, function(data, status) {
                    (data != '') ? loadTableByDate(data): false;
                });
            }

            // Loads the table with the sesions output
            function loadTableByDate(data) {
                $('.table-container').html('<table class="table table-striped table-data text-center"><tr><th>Actividad</th><th>Dia de la semana</th><th>Hora inicial</th><th>Hora final</th><th>Fecha</th><th>Añadir</th></tr></table>');
                var entry_data, activity_name, weekDay, date, hour_start, hour_end, join_btn;
                data.forEach(function(sesion) {
                    activity_name = '<td>' + sesion.activity.name + '</td>';
                    weekDay = '<td>' + sesion.weekDay + '</td>';
                    date = '<td>' + sesion.date + '</td>';
                    hour_start = '<td>' + sesion.hour_start + '</td>';
                    hour_end = '<td>' + sesion.hour_end + '</td>';
                    join_btn = ' <td><a class="btn btn-primary add-reservation" href="/reservations/create/' + sesion.id + '"><i class="bi bi-bookmark-plus"></i></a></td>';
                    entry_data += '<tr id="entry-row">' + activity_name + weekDay + hour_start + hour_end + date + join_btn + '</tr>';
                });
                $('.table-data').append(entry_data);
            }
        });
    });

    // Function to clear the table
    function emptyTable() {
        $('.table-container').html('');
    }

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
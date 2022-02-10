$(document).ready(function () {
    // Code to filter by activity name
    $('.filter-by-activity').on('keyup', function (e) {
        e.preventDefault();
        key = $(this).val();
        const regLetters = /^[A-Z]|[a-z]/;
        (key.match(regLetters)) ? request(key) : emptyTable();
    });

    // Sends the get request to obtain the activity
    function request(data) {
        $.get("/reservations/filter?filter=" + data, function (data, status) {
            (data != '') ? loadTableByName(data) : false;
        });
    }
});

// Loads the table with the activities output
function loadTableByName(data) {
    $('.table-container').html('<table class="table table-striped table-data text-center"><tr><th>Actividad</th><th>Dia de la semana</th><th>Hora inicial</th><th>Hora final</th><th>Fecha</th><th>Añadir</th></tr></table>');
    var entry_data, activity_name, weekDay, date, hour_start, hour_end, join_btn;
    data.forEach(function (activity) {
        activity_name = '<td>' + activity.name + '</td>';
        activity.sesions.forEach(function (sesion) {
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

// Function to clear the table
function emptyTable() {
    $('.table-container').html('');
}
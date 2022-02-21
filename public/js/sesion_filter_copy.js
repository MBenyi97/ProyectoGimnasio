$('.table-container').hide();
$('.entry-row').remove();
$(document).ready(function () {
    // Cuando el usuario presiona una tecla, carga las actividades que tengan ese nombre
    $('.filter-by-activity').on('keyup', function (e) {
        e.preventDefault();
        // Recogemos el valor de la tecla presionada
        key = ($(this).val());
        // Borramos las entradas de la tabla, por si el usuario escribe otro nombre de actividad
        $('.entry-row').remove();
        // Realizamos la petición get, con el nombre de actividad que el usuario ha escrito
        $.get("/reservations/filter?filter=" + key, function (data) {
            // Función que carga la tabla
            loadTable(data);
        });
    });

    // Cuando el usuario presiona una tecla, carga las sesiones que tengan esa fecha
    $('.filter-by-date').on('keyup', function (e) {
        e.preventDefault();
        // Recogemos el valor de la tecla presionada
        key = ($(this).val());
        // Borramos las entradas de la tabla, por si el usuario escribe otro nombre de actividad
        $('.entry-row').remove();
        // Realizamos la petición get, con el nombre de actividad que el usuario ha escrito
        $.get("/reservations/filter?filter=" + key, function (data) {
            // Función que carga la tabla
            loadTable(data);
        });
    });
});

function loadTable(data) {
    emptyTable();
    $('.table-container').show();
    data.forEach((sesion) => {
        $('.table-data').append(`
        <tr>
            <td>sesion.activity.name</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>`);
        $('.activity_name').append(sesion.activity.name);
        $('.weekDay').append(sesion.weekDay);
        $('.date').append(sesion.date);
        $('.hour_start').append(sesion.hour_start);
        $('.hour_end').append(sesion.hour_end);
        $('.join_btn').append(`<a class="btn btn-primary" onclick="sweetAlert(${sesion.id})"><i class='bi bi-bookmark-plus'></i></a>`);
    });
    // Mostramos la tabla con las nuevas entradas
    $('.table-container').show();
}

// Función para añadir la reserva cuando el usuario haga click
function addReservation(id) {
    // Función AJAX con petición POST para añadir la sesión
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: `/reservations/create/${id}`,
    }).then((data) => {
        // Cuando la petición se ha reliza, te redirige de nuevo a la página de las reservas
        location.replace('/reservations/');
    }).catch((err) => {
        // Si la petición falla te devuelve por consola un error
        console.log(`Ha ocurrido un error realizando la petición ${err.message}.`);
    }).done(() => {
        // Cuando la petición se realiza con exito, devuelve un mensaje de exito
        console.log('La reserva ha sido realizada!');
    });
}
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
    // Borramos las entradas de la tabla, por si el usuario escribe otro nombre de actividad
    $('.entry-row').remove();
    // Función forEach que recorre los datos de las sesiones pasados por la petición GET
    data.forEach((sesion) => {
        let activity_name = sesion.activity.name;
        let weekDay = sesion.weekDay;
        let date = sesion.date;
        let hour_start = sesion.hour_start;
        let hour_end = sesion.hour_end;
        // Botón que tiene una función onclick para que cuando hagas click añada la sesión
        let join_btn = `<a class="btn btn-primary" onclick="addReservation(${sesion.id})"><i class='bi bi-bookmark-plus'></i></a>`;
        // Carga las filas de la tabla cada sesión
        $('.table-data').append(
            `<tr class="entry-row"><td>${activity_name}</td><td>${weekDay}</td><td>${date}</td><td>${hour_start}</td><td>${hour_end}</td><td>${join_btn}</td></tr>`
        );
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
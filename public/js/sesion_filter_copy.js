$('.table-container').hide();
$(document).ready(function () {
    // Filter by activity name
    $('.filter-by-activity').on('keyup', function (e) {
        e.preventDefault();
        key = $(this).val();
        const regLetters = /^[A-Z]|[a-z]/;
        (key.match(regLetters)) ? request(key) : emptyTable();
    });

    // Filter by sesion date
    $('.filter-by-date').on('keyup', function (e) {
        e.preventDefault();
        key = $(this).val();
        const regLetters = /^\d{4}\-\d{2}\-\d{2}$/;
        (key.match(regLetters)) ? request(key) : emptyTable();
    });

    // Sends the get request to obtain the sesions
    function request(data) {
        $.get("/reservations/filter?filter=" + data, function (data) {
            console.log(data);
            emptyTable();
            (data != '') ? loadTable(data) : false;
        });
    }
});

// Loads the table with the sesions input
function loadTable(data) {
    emptyTable();
    $('.table-container').show();
    var table_row;
    data.forEach((sesion) => {
        table_row.innerHTML(`<tr><td class="activity_name"></td><td class="weekDay"></td><td class="hour_start"></td><td class="hour_end"></td><td class="date"></td><td class="join_btn"></td></tr>`);
        $('.table-row').next(table_row);
        $('.activity_name').append(sesion.activity.name);
        $('.weekDay').append(sesion.weekDay);
        $('.date').append(sesion.date);
        $('.hour_start').append(sesion.hour_start);
        $('.hour_end').append(sesion.hour_end);
        $('.join_btn').append(`<a class="btn btn-primary" onclick="sweetAlert(${sesion.id})"><i class='bi bi-bookmark-plus'></i></a>`);
    });
}

// Adds the reservations
function addReservation(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: `/reservations/create/${id}`,
    }).then((data) => {
        console.log(data);
        location.replace('/reservations/');
    }).catch((err) => {
        console.log(`Ha ocurrido un error realizando la petición ${err.message}.`);
    });
}

// Sweet alert confirmation message
function sweetAlert(id) {
    Swal.fire({
        title: 'Confirmar',
        text: "Quieres unirte a esta clase?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, unirme!',
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
                'Reservada!',
                'Te has unido a la clase.',
                'success'
            ).then(function () {
                addReservation(id);
            });
        }
    });
}

// Function to clear the table
function emptyTable() {
    $('.entry-row').remove();
    $('.table-container').hide();
}
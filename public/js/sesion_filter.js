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
        $.get("/reservations/filter?filter=" + data, function (data, status) {
            (data != '') ? loadTable(data) : false;
        });
    }
});

// Loads the table with the sesions input
function loadTable(data) {
    $('.table-container').show();
    var table_row = document.createElement('tr');
    var link_btn = document.createElement('a');
    var activity_name = document.createElement('td');
    var weekDay = document.createElement('td');
    var hour_start = document.createElement('td');
    var hour_end = document.createElement('td');
    var date = document.createElement('td');
    var join_btn = document.createElement('td');
    var entry_data;
    data.forEach((sesion) => {
        activity_name.innerHTML = sesion.activity.name;
        weekDay.innerHTML = sesion.weekDay;
        date.innerHTML = sesion.date;
        hour_start.innerHTML = sesion.hour_start;
        hour_end.innerHTML = sesion.hour_end;
        link_btn.innerHTML = "<i class='bi bi-bookmark-plus'></i>";
        link_btn.setAttribute('class', 'btn btn-primary add-reservation')
        link_btn.setAttribute('href', `/reservations/create/${sesion.id}`);
        join_btn.appendChild(link_btn);
        table_row.setAttribute('class', 'entry-row');
        table_row.append(activity_name, weekDay, hour_start, hour_end, date, join_btn);
        entry_data += table_row.outerHTML;
    });
    $('.table-data').append(entry_data);
}

// Function to clear the table
function emptyTable() {
    $('.table-container').hide();
    $('.entry-row').remove();
}
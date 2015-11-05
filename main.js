function update_days() {
    var region = $('#region').val();
    var date = $('#date').val();
    if (region == '0') {
        $('#days').html('-');
        $('#couriers').html('<option>выберите регион</option>');
        return (false);
    }

    $('#days').html('-');
    $('#couriers').html('<option>выберите регион</option>');

    var url = 'get_free_couriers.php';

    $.get(
        url,
        "region=" + region + "&datefrom=" + date,
        function (result) {
            if (result.type == 'error') {
                $('#days').html('-');
                return (false);
            }
            else {
                $('#days').html(result.time);
                $('#arrival').html(result.arrival);
                var options = '<option value="0">выберите курьера</option>';
                $(result.names).each(function () {
                    options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('name') + '</option>';
                });
                $('#couriers').html(options);
                $('#couriers').attr('disabled', false);
            }
        },
        "json"
    );
}

function update_schedule() {
    $('#schedule').html('Загрузка...');

    var url = 'get_schedule.php';

    $.get(
        url,
        null,
        function (result) {
            if (result.type == 'error') {
                $('#schedule').html('Не удалось загрузить расписание');
                return (false);
            }
            else {
                var options = '<table class="sched">';
                options += '<tr><td><b>Курьер</b><td><b>Регион</b><td><b>Дата отправления</b><td><b>Дата прибытия</b>';
                $(result.couriers).each(function () {
                    options += '<tr><td>' + $(this).attr('courier') + '';
                    options += '<td>' + $(this).attr('name') + '';
                    options += '<td>' + $(this).attr('departure') + '';
                    options += '<td>' + $(this).attr('arrival') + '';
                });
                options += '</table>';
                $('#schedule').html(options);
            }
        },
        "json"
    );
}

function addtoschedule() {
    var region = $('#region').val();
    var date = $('#date').val();
    var cour = $('#couriers').val();
    if (region == '0')
        return (false);

    var url = 'get_free_couriers.php';

    $.get(
        url,
        'region=' + region + '&datefrom=' + date + '&action=add&courier=' + cour,
        function (result) {
            if (result.type == 'error') {
                return (false);
            }
            else {
                update_schedule();
                update_days();
            }

        },
        "json"
    );
}

$(document).ready(function () {
    $('#region').change(update_days);
    $('#date').keyup(update_days);
    $('#insert').click(addtoschedule);
    update_schedule();
});


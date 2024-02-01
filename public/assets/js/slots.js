$(document).ready(function() {

    $(document).on('click', '.deleteBut', function(event) {
        // Код, який ви хочете виконати при кліку на кнопку з класом deleteBut
        console.log("Клікнули на кнопку видалення");

        // Видалення рядка таблиці
        $(this).closest('tr').remove();

        // Зупинка подальшого вспливання події
        event.stopPropagation();

    });

    $('select[name="dynamicSelect"]').change(function() {
        console.log("DADSADAS");
        var selectedOption = $(this).val();
        var selectedRow = $(this).closest('tr'); // Знаходимо найближчий рядок з елементом dynamicSelect

        if (selectedOption == "months") { // Якщо обрано опцію "Range of month"
            // Замінюємо вхідні поля колонок "Start" і "End" на нові вибірки
            selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
            selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
        } else if (selectedOption == "customs") { // Якщо обрано опцію "Range of days"
            // Замінюємо вхідні поля колонок "Start" і "End" на нові input з класом "datetimes"
            selectedRow.find('.Start').find('input, select').replaceWith('<input name="start" type="text" class="datetimes form-control datetimes"/>');
            selectedRow.find('.End').find('input, select').replaceWith('<input   name="end"   type="text" class="datetimes form-control datetimes"/>');
        } else if(selectedOption=="days"){
            selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select>');
            selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select>');
        }
        else if(selectedOption=="allWeeks"){
            selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="monday" selected>Monday</option></select>');
            selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="sunday" selected>Sunday</option></select>');
        }

        $('.datetimes').each(function() {
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });
        });
    });



    let languages = {
        "en": "English",
        "fr": "France"
    };

    let select = document.createElement("select");
    select.id = "languageSelect";
    select.classList.add("form-control"); // Додає клас "select2"

    for (var langCode in languages) {
        if (languages.hasOwnProperty(langCode)) {
            var option = document.createElement("option");
            option.value = langCode;
            option.text = languages[langCode];
            select.appendChild(option);
        }
    }

    select.setAttribute("name", "language");

    console.log(select);

    $('#CreateBT').click(function() {
        var newRow = '<tr>' +
            '<td class="align-middle">1</td>' +
            '<td>' +
            '<select name="dynamicSelect" class="select2 form-control" aria-label="Default select example">' +
            '<option selected value="months">Range of month</option>' +
            '<option value="days">Range of days</option>' +
            '<option value="customs">Custom date Range</option>' +
            '<option value="allWeeks">All week</option>' +
            '</select>' +
            '</td>' +
            '<td>' +
            '<div>' +
            select.outerHTML  +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<div class="row Start">' +
            '<select name="start" class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<div class="row End">' +
            '<select name="end" class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td><input type="time" name="fromHour"class="form-control" value="10:05 AM" /></td>' +
            '<td><input type="time" name="toHour" class="form-control" value="10:05 AM" /></td>' +
            '<td>' +
            '<div>' +
            '<select class="select2 form-control" name="is_available" style="width: 100%;">' +
            '<option value="0">No</option>' +
            '<option value="1">Yes</option>' +
            '</select>' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<input type="number" name="quantity" class="form-control" required >' +
            '</div>' +
            '</td>' +
            '<td class="align-middle">' +
            '<button type="submit" class="bg-transparent border-0 deleteBut">' +
            '<i class="fas fa-trash text-danger"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';

        $('table tbody').append(newRow);

        $(document).on('click', '.deleteBut', function() {
            console.log("Клікнули на кнопку видалення");
            $(this).closest('tr').remove();

        });
        // Прикріплюємо обробник події після додавання нових полів
        $('select[name="dynamicSelect"]').change(function() {
            console.log("DADSADAS");
            var selectedOption = $(this).val();
            var selectedRow = $(this).closest('tr'); // Знаходимо найближчий рядок з елементом dynamicSelect

            if (selectedOption == "months") { // Якщо обрано опцію "Range of month"
                // Замінюємо вхідні поля колонок "Start" і "End" на нові вибірки
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
            } else if (selectedOption == "customs") { // Якщо обрано опцію "Range of days"
                // Замінюємо вхідні поля колонок "Start" і "End" на нові input з класом "datetimes"
                selectedRow.find('.Start').find('input, select').replaceWith('<input name="start" type="text" class="datetimes form-control datetimes"/>');
                selectedRow.find('.End').find('input, select').replaceWith('<input   name="end"   type="text" class="datetimes form-control datetimes"/>');
            } else if(selectedOption=="days"){
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select>');
            }
            else if(selectedOption=="allWeeks"){
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="monday" selected>Monday</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="sunday" selected>Sunday</option></select>');
            }

            $('.datetimes').each(function() {
                $(this).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'), 10)
                }, function(start, end, label) {
                    var years = moment().diff(start, 'years');
                });
            });
        });
    });




    $('#Save').click(function() {
        // Створення порожнього масиву для зберігання даних
        var rowsData = [];
        let isCanSend = true;
        // Прохід по кожному рядку таблиці
        $('tbody tr').each(function() {
            // Створення об'єкта для поточного рядка
            var rowData = {};

            // Отримання значень з кожного елементу <input> або <select> у поточному рядку
            $(this).find('input, select').each(function() {
                var name = $(this).attr('name'); // Отримання значення атрибуту 'name'
                var value = $(this).val(); // Отримання значення елементу
                if (value === "") {
                    $(this).addClass('customError');
                    isCanSend = false;
                } else {
                    $(this).removeClass('customError');
                }
                rowData[name] = value; // Запис значення до відповідного ключа у об'єкті rowData
            });

            // Додавання об'єкта з даними поточного рядка до масиву rowsData
            rowsData.push(rowData);
        });

        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        let calendarId = $('input[name="calendar_id"]').val();

        var dataToSend = {
            csrfToken: csrfToken,
            alldata: rowsData,
            calendar_id: calendarId
        };

        console.log(rowsData);
        console.log(csrfToken);
        if (isCanSend === true){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: '/slots/createOrUpdate',
                method: 'POST',
                data: dataToSend,
                success: function(response) {
                    console.log("dasdasdasdasda");
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});

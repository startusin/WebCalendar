$(document).ready(function() {



    function month(MyVariable, MyPeriod) {

        let months = [
            { value: "january", name: "January" },
            { value: "february", name: "February" },
            { value: "march", name: "March" },
            { value: "april", name: "April" },
            { value: "may", name: "May" },
            { value: "june", name: "June" },
            { value: "july", name: "July" },
            { value: "august", name: "August" },
            { value: "september", name: "September" },
            { value: "october", name: "October" },
            { value: "november", name: "November" },
            { value: "december", name: "December" }
        ];

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = MyPeriod; // Задаємо атрибут name

        for (let i = 0; i < months.length; i++) {
            let option = document.createElement('option');
            option.value = months[i].value;
            option.text = months[i].name;
            select.appendChild(option);
        }

        let options = select.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === MyVariable) {
                options[i].selected = true;
                console.log("dasdasdasdasdasd");
                break; // Ми знайшли співпадіння, тому можемо вийти з циклу
            }
        }
        return select;
    }


    function customTime(myVariable, MyPeriod) {
        var input = document.createElement('input');
        input.type = "text";
        input.name = MyPeriod; // Задаємо атрибут name
        input.className = "datetimes form-control datetimes";
        input.value = myVariable;

        return input;
    }


    function weeks(period) {
        let select = document.createElement('select');
        select.className = "newSelect form-control";

        if (period === "start") {
            let option = document.createElement('option');
            option.value = "monday";
            option.text = "Monday";
            option.selected = true;
            select.appendChild(option);
        } else if (period === "end") {
            let option = document.createElement('option');
            option.value = "sunday";
            option.text = "Sunday";
            option.selected = true;
            select.appendChild(option);
        }

        return select;
    }



    function days(MyVariable, MyPeriod) {
        let daysOfWeek = [
            { value: "monday", name: "Monday" },
            { value: "tuesday", name: "Tuesday" },
            { value: "wednesday", name: "Wednesday" },
            { value: "thursday", name: "Thursday" },
            { value: "friday", name: "Friday" },
            { value: "saturday", name: "Saturday" },
            { value: "sunday", name: "Sunday" }
        ];

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = MyPeriod;

        for (let i = 0; i < daysOfWeek.length; i++) {
            let option = document.createElement('option');
            option.value = daysOfWeek[i].value;
            option.text = daysOfWeek[i].name;
            if (daysOfWeek[i].value === MyVariable) {
                option.selected = true;
            }
            select.appendChild(option);
        }

        return select;
    }



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

    function CustomTypePeriod(MyVariable) {
        let selectHTML = '<select name="dynamicSelect" class="select2 form-control" aria-label="Default select example">';

        let options = [
            { value: 'months', text: 'Range of month' },
            { value: 'days', text: 'Range of days' },
            { value: 'customs', text: 'Custom date Range' },
            { value: 'allWeeks', text: 'All week' }
        ];

        options.forEach(option => {
            let selected = (option.value === MyVariable) ? 'selected' : '';
            selectHTML += '<option value="' + option.value + '" ' + selected + '>' + option.text + '</option>';
        });

        selectHTML += '</select>';

        return selectHTML;
    }


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

    function pickerFunction(picker, period, val) {
        let res;
        console.log("Picker"+val);
        switch (picker) {
            case "months":
                res = month(val, period);
                console.log(1);
                break
            case "days":
                res = days(val, period);
                break
            case "customs":
                res = customTime(val, period);
                break
            case "allWeeks":
                res = weeks(period);
                break
        }
        console.log(res);
        return res;
    }
    function ReturnReadyTr() {
        let wqw= CustomTypePeriod('months');
        let start = pickerFunction('months','start','march');
        let end = pickerFunction('months','end','march');

        console.log(start);
        console.log(end);
        console.log(wqw);
        let newRow = '<tr>' +
            '<td class="align-middle">1</td>' +
            '<td>' +
            wqw +
            '</td>' +
            '<td>' +
            '<div>' +
            select.outerHTML  +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<div class="row Start">' +
            start.outerHTML+
            '</div>' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<div class="row End">' +
             end.outerHTML+
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


        console.log("dasdasdasfjnsdlvkndflvfdvdkfnvkdjfn");
        console.log(newRow);


        $('table tbody').append(newRow);



        $(document).on('click', '.deleteBut', function() {
            console.log("Клікнули на кнопку видалення");
            $(this).closest('tr').remove();

        });
        $('select[name="dynamicSelect"]').change(function() {
            console.log("DADSADAS");
            var selectedOption = $(this).val();
            var selectedRow = $(this).closest('tr');

            if (selectedOption == "months") {
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
            } else if (selectedOption == "customs") {
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

    }


    let calendarId = $('input[name="calendar_id"]').val();
    console.log("CCCCCCCC"+calendarId);
    $.ajax({
        url: '/slots/allCustomSlots',
        method: 'GET',
        data: { calendar_id: calendarId },
        success: function(data) {

            console.log(data);
            ReturnReadyTr();
        },
        error: function(xhr, status, error) {

            console.error(xhr.responseText);
        }
    });


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

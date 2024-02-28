$(document).ready(function() {

    let allData = {};
    let MyProducts = {};
    let currentLanguage;
    function getAllData() {
        let last;
        $('tbody tr').each(function() {
            let lastValue;
            $(this).find('input[name="priority"]').each(function() {
                last = $(this).val();
            });
        });
    }

    function month(MyVariable, MyPeriod) {
        let months = [
            { value: "1", name: "January" },
            { value: "2", name: "February" },
            { value: "3", name: "March" },
            { value: "4", name: "April" },
            { value: "5", name: "May" },
            { value: "6", name: "June" },
            { value: "7", name: "July" },
            { value: "8", name: "August" },
            { value: "9", name: "September" },
            { value: "10", name: "October" },
            { value: "11", name: "November" },
            { value: "12", name: "December" }
        ];

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = MyPeriod; // Задаємо атрибут name

        for (let i = 0; i < months.length; i++) {
            let option = document.createElement('option');
            option.value = months[i].value;
            option.text = months[i].name;

            if (parseInt(MyVariable, 10) === (i + 1)) {
                option.setAttribute('selected','selected');
            }

            select.appendChild(option);
        }

        return select;
    }


    function customTime(myVariable, MyPeriod) {
        var input = document.createElement('input');
        input.type = "text";
        input.name = MyPeriod; // Задаємо атрибут name
        input.className = "form-control datetimes";
        input.value = myVariable;

        return input;
    }


    function weeks(period) {
        let select = document.createElement('select');
        select.className = "newSelect form-control";

        if (period === "start") {
            let option = document.createElement('option');
            option.value = "1";
            option.text = "Monday";
            option.selected = true;
            select.appendChild(option);
        } else if (period === "end") {
            let option = document.createElement('option');
            option.value = "7";
            option.text = "Sunday";
            option.selected = true;
            select.appendChild(option);
        }

        return select;
    }

    function languageSelector(selectedLanguage, languages) {
        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = "language";
        console.log("selectedLanguage");
        console.log(selectedLanguage);
        for (let lang in languages) {
            let option = document.createElement('option');
            option.value = lang;
            option.text = languages[lang];
            if (lang == selectedLanguage){
                option.setAttribute('selected','selected');
            }
            select.appendChild(option);
        }
        return select;
    }


    function productSelector(selectedProduct, lang, MyProducts) {

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = "product";

        for (let product in MyProducts) {
            let option = document.createElement('option');
            for (let key in MyProducts[product].title){
                if (lang==key) {
                    option.text = MyProducts[product].title[key];
                }
            }
            option.value = MyProducts[product].id;
            select.appendChild(option);
            console.log("PRODUCT " + product);

            if (selectedProduct === MyProducts[product].id) {
                console.log("SDSD");
                option.setAttribute('selected', 'selected');
            }
        }
        return select;
    }

    function days(MyVariable, MyPeriod) {
        let daysOfWeek = [
            { value: "1", name: "Monday" },
            { value: "2", name: "Tuesday" },
            { value: "3", name: "Wednesday" },
            { value: "4", name: "Thursday" },
            { value: "5", name: "Friday" },
            { value: "6", name: "Saturday" },
            { value: "7", name: "Sunday" }
        ];

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = MyPeriod;

        for (let i = 0; i < daysOfWeek.length; i++) {
            let option = document.createElement('option');
            option.value = daysOfWeek[i].value;
            option.text = daysOfWeek[i].name;
            if (daysOfWeek[i].value === MyVariable) {
                option.setAttribute('selected','selected');
            }
            select.appendChild(option);
        }


        return select;
    }


    function oneDaySelector(SelectedDay, MyPeriod) {
        let daysOfWeek = [
            {value: "1", name: "Monday"},
            {value: "2", name: "Tuesday"},
            {value: "3", name: "Wednesday"},
            {value: "4", name: "Thursday"},
            {value: "5", name: "Friday"},
            {value: "6", name: "Saturday"},
            {value: "7", name: "Sunday"}
        ];

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = MyPeriod;

        for (let i = 0; i < daysOfWeek.length; i++) {
            if (SelectedDay === daysOfWeek[i].name) {
                let option = document.createElement('option');
                option.value = daysOfWeek[i].value;
                option.text = daysOfWeek[i].name;

                select.appendChild(option);
            }
        }
        console.log(select);
        return select;
    }




    function operations(selectedOperation) {
        let MyOperations = [
            {value: "fixed", name: "Fixed"},
            {value: "add", name: "+"},
            {value: "divide", name: "/"},
            {value: "subtract", name: "-"},
            {value: "multiply", name: "*"},
        ];

        let select = document.createElement('select');
        select.className = "newSelect form-control";
        select.name = 'type';

        for (let i = 0; i < MyOperations.length; i++) {
            let option = document.createElement('option');
            option.value = MyOperations[i].value;
            option.text = MyOperations[i].name;
            console.log("Operaion");
            console.log(MyOperations[i].value);
            console.log(selectedOperation);
            if (MyOperations[i].value === selectedOperation) {
                console.log("YYYYYYYYYYYYYYYYYYYYYY");
                console.log(selectedOperation);
                console.log(MyOperations[i].value);

                console.log("YYYYYYYYYYYYYYYYYYYYYY");
                option.setAttribute('selected', 'selected');
            }
            select.appendChild(option);
        }
        return select;
    }

    $(document).on('click', '.datetimes', function(event) {

    });

    $(document).on('click', '.deleteBut', function(event) {
        console.log("Клікнули на кнопку видалення");
        $(this).closest('tr').remove();
        getAllData();
        event.stopPropagation();

    });

    $('select[name="dynamicSelect"]').change(function() {
        console.log("DADSADAS");
        var selectedOption = $(this).val();
        var selectedRow = $(this).closest('tr');

        if (selectedOption == "months") {
            selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
            selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
        }
        else if (selectedOption == "customs") {
            selectedRow.find('.Start').find('input, select').replaceWith('<input name="start" type="text" class="datetimes form-control datetimes"/>');
            selectedRow.find('.End').find('input, select').replaceWith('<input   name="end"   type="text" class="datetimes form-control datetimes"/>');
        }
        else if(selectedOption=="days"){
            selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select>');
            selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select>');
        }
        else if(selectedOption=="allWeeks"){
            selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1" selected>Monday</option></select>');
            selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="7" selected>Sunday</option></select>');
        }

        $('.datetimes').each(function() {
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                locale: {
                    format: 'MM-DD'
                },
                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });
        });
    });

    function CustomTypePeriod(MyVariable = {}) {
        let selectHTML = '<select name="dynamicSelect" class="select2 form-control" aria-label="Default select example">';

        let options = [
            { value: 'months', text: 'Range of month' },
            { value: 'days', text: 'Range of days' },
            { value: 'customs', text: 'Custom date Range' },
            { value: 'allWeeks', text: 'All week' },
            { value: 'Monday', text: 'Monday' },
            { value: 'Tuesday', text: 'Tuesday' },
            { value: 'Wednesday', text: 'Wednesday' },
            { value: 'Thursday', text: 'Thursday' },
            { value: 'Friday', text: 'Friday' },
            { value: 'Saturday', text: 'Saturday' },
            { value: 'Sunday', text: 'Sunday' }
        ];
        console.log(MyVariable);
        options.forEach(option => {
            let selected = (option.value === MyVariable.dynamicSelect) ? 'selected' : '';
            selectHTML += '<option value="' + option.value + '" ' + selected + '>' + option.text + '</option>';
        });

        selectHTML += '</select>';
        console.log(selectHTML);
        return selectHTML;
    }


    let languages = {
        "en": "English"
    };


    $.ajax({
        url: '/currentLanguage',
        async: false,
        method: 'GET',
        success: function(data) {
            currentLanguage = data;
            console.log("Current Language"+currentLanguage);
        },
        error: function(xhr, status, error) {

            console.error(xhr.responseText);
        }
    });
    $.ajax({
        url: '/languages',
        async: false,
        method: 'GET',
        success: function(data) {
            languages = data;
        },
        error: function(xhr, status, error) {

            console.error(xhr.responseText);
        }
    });

    $.ajax({
        url: '/product/getMyProducts',
        async: false,
        method: 'GET',
        success: function(data) {
            MyProducts = data;
            console.log(MyProducts);
        },
        error: function(xhr, status, error) {

            console.error(xhr.responseText);
        }
    });

    function pickerFunction(picker, period, val) {
        let res;

        switch (picker.dynamicSelect) {
            case "months":
                res = month(val, period);
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
            case "Friday":
                res = oneDaySelector("Friday",period);
                break;
            case "Monday":
                res = oneDaySelector("Monday",period);
                break;
            case "Thursday":
                res = oneDaySelector("Thursday",period);
                break;
            case "Tuesday":
                res = oneDaySelector("Tuesday",period);
                break;
            case "Wednesday":
                res = oneDaySelector("Wednesday",period);
                break;
            case "Saturday":
                res = oneDaySelector("Saturday",period);
                break;
            case "Sunday":
                res = oneDaySelector("Sunday",period);
                break;
        }
        console.log(res);
        return res;
    }

    function ReturnReadyTr(MyObj) {
        let wqw= CustomTypePeriod(MyObj.price);
        let start = pickerFunction(MyObj.price,'start', MyObj.price.start);
        let end = pickerFunction(MyObj.price,'end',MyObj.price.end);

        console.log("RETURNTREADYTR");
        console.log(MyObj);

        let newRow = '<tr data-start="'+MyObj.price.start+'" data-end="'+MyObj.price.end+'">' +
            '<td>' +
            wqw +
            '</td>' +
            '<td>' +
            '<div>' +
            languageSelector(MyObj.price.language, languages).outerHTML  +
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
            '<td><input type="time" name="fromHour"class="form-control" value="' + MyObj.price.fromHour + '" /></td>' +
            '<td><input type="time" name="toHour" class="form-control" value="' + MyObj.price.toHour + '" /></td>' +
            '<td>' +
            '<div>' +
            operations(MyObj.price.type).outerHTML +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<input value="'+ MyObj.price.value+'" type="number"  name="value" class="form-control" required >' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            productSelector(MyObj.product_id,currentLanguage,MyProducts).outerHTML +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<input value="'+ (MyObj?.price?.participants || 0)+'" type="number"  name="participants" class="form-control" required >' +
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
            $(this).closest('tr').remove();

        });
        $('select[name="dynamicSelect"]').change(function() {
            var selectedOption = $(this).val();
            var selectedRow = $(this).closest('tr');

            if (selectedOption == "months") {
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
            } else if (selectedOption == "customs") {
                selectedRow.find('.Start').find('input, select').replaceWith('<input name="start" type="text" class="datetimes form-control datetimes"/>');
                selectedRow.find('.End').find('input, select').replaceWith('<input   name="end"   type="text" class="datetimes form-control datetimes"/>');
            } else if(selectedOption=="days"){
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select>');
            }
            else if(selectedOption=="allWeeks"){
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1" selected>Monday</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="7" selected>Sunday</option></select>');
            }
            else if(selectedOption=="Monday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Monday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Monday", 'end'));
            }
            else if(selectedOption=="Tuesday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Tuesday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Tuesday", 'end'));
            }
            else if(selectedOption=="Wednesday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Wednesday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Wednesday", 'end'));
            }
            else if(selectedOption=="Thursday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Thursday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Thursday", 'end'));
            }
            else if(selectedOption=="Friday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Friday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Friday", 'end'));
            }
            else if(selectedOption=="Friday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Friday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Friday", 'end'));
            }
            else if(selectedOption=="Saturday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Saturday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Saturday", 'end'));
            }
            else if(selectedOption=="Sunday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Sunday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Sunday", 'end'));
            }


            $('.datetimes').each(function() {
                $(this).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    locale: {
                        format: 'MM-DD'
                    },
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
        url: '/price/allCustomPrice',
        method: 'GET',
        data: { calendar_id: calendarId },
        success: function(data) {
            data.forEach(function(obj) {
                console.log(obj);
                ReturnReadyTr(obj);

                $('input[name="start"].datetimes').each(function() {

                    let $tr = $(this).closest('tr');
                    let starttime = $tr.data('start'); // Отримуємо значення атрибута data-start
                    $(this).daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 1901,
                        startDate: starttime,
                        locale: {
                            format: 'MM-DD'
                        },
                        maxYear: parseInt(moment().format('YYYY'), 10)
                    }, function(start, end, label) {
                        var years = moment().diff(start, 'years');
                    });
                });
                $('input[name="end"].datetimes').each(function() {
                    let $tr = $(this).closest('tr');
                    let starttime = $tr.data('end');
                    $(this).daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 1901,
                        startDate: starttime,
                        locale: {
                            format: 'MM-DD'
                        },
                        maxYear: parseInt(moment().format('YYYY'), 10)
                    }, function(start, end, label) {
                        var years = moment().diff(start, 'years');
                    });
                });
            });

            getAllData();
        },
        error: function(xhr, status, error) {

            console.error(xhr.responseText);
        }
    });


    $('#CreateBT').click(function() {

        var newRow = '<tr>' +
            '<td>' +
            CustomTypePeriod() +
            '</td>' +
            '<td>' +
            '<div>' +
            languageSelector('en', languages).outerHTML  +
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
            operations("").outerHTML +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<input type="number" name="value" class="form-control" required >' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            productSelector("d",currentLanguage,MyProducts).outerHTML +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div>' +
            '<input type="number" name="participants" class="form-control" required value="0">' +
            '</div>' +
            '</td>' +
            '<td class="align-middle">' +
            '<button type="submit" class="bg-transparent border-0 deleteBut">' +
            '<i class="fas fa-trash text-danger"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';
        $('table tbody').append(newRow);

        getAllData();




        $(document).on('click', '.deleteBut', function() {
            console.log("Клікнули на кнопку видалення");
            $(this).closest('tr').remove();

        });
        $('select[name="dynamicSelect"]').change(function() {
            console.log("DADSADAS");
            var selectedOption = $(this).val();
            var selectedRow = $(this).closest('tr');

            if (selectedOption == "months") {
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
            } else if (selectedOption == "customs") { // Якщо обрано опцію "Range of days"
                selectedRow.find('.Start').find('input, select').replaceWith('<input name="start" type="text" class="datetimes form-control datetimes"/>');
                selectedRow.find('.End').find('input, select').replaceWith('<input   name="end"   type="text" class="datetimes form-control datetimes"/>');
            } else if(selectedOption=="days"){
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select>');
            }
            else if(selectedOption=="allWeeks"){
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="1" selected>Monday</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="7" selected>Sunday</option></select>');
            }
            else if(selectedOption=="Monday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Monday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Monday", 'end'));
            }
            else if(selectedOption=="Tuesday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Tuesday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Tuesday", 'end'));
            }
            else if(selectedOption=="Wednesday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Wednesday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Wednesday", 'end'));
            }
            else if(selectedOption=="Thursday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Thursday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Thursday", 'end'));
            }
            else if(selectedOption=="Friday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Friday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Friday", 'end'));
            }
            else if(selectedOption=="Friday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Friday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Friday", 'end'));
            }
            else if(selectedOption=="Saturday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Saturday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Saturday", 'end'));
            }
            else if(selectedOption=="Sunday"){
                selectedRow.find('.Start').find('input, select').replaceWith(oneDaySelector("Sunday", 'start'));
                selectedRow.find('.End').find('input, select').replaceWith(oneDaySelector("Sunday", 'end'));
            }

            $('.datetimes').each(function() {
                $(this).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    locale: {
                        format: 'MM-DD'
                    },
                    maxYear: parseInt(moment().format('YYYY'), 10)
                }, function(start, end, label) {
                    var years = moment().diff(start, 'years');
                });
            });
        });
    });




    $('#Save').click(function() {
        var rowsData = [];
        let isCanSend = true;

        $('tbody tr').each(function() {
            var rowData = {};

            $(this).find('input, select').each(function() {
                var name = $(this).attr('name');
                var value = $(this).val();
                if (value === "") {
                    $(this).addClass('customError');
                    isCanSend = false;
                } else {
                    $(this).removeClass('customError');
                }
                rowData[name] = value;
            });

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
                url: '/price/createOrUpdate',
                method: 'POST',
                data: dataToSend,
                success: function(response) {
                    alert("Saved!");
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});

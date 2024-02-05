$(document).ready(function() {

    let allData = {};

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
                option.setAttribute('selected','selected');
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
                locale: {
                    format: 'MM/DD'
                },
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
            let selected = (option.value === MyVariable.dynamicSelect) ? 'selected' : '';
            selectHTML += '<option value="' + option.value + '" ' + selected + '>' + option.text + '</option>';
        });

        selectHTML += '</select>';

        return selectHTML;
    }

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
        }
        console.log(res);
        return res;
    }

    function ReturnReadyTr(MyObj) {
        let wqw= CustomTypePeriod(MyObj);
        let start = pickerFunction(MyObj,'start', MyObj.start);
        let end = pickerFunction(MyObj,'end',MyObj.end);

        console.log("Picker"+MyObj);

        console.log('languages');
        console.log(languages);

        let newRow = '<tr data-start="'+MyObj.start+'" data-end="'+MyObj.end+'">' +
            '<td>' +
            wqw +
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
            '<td><input type="time" name="fromHour"class="form-control" value="' + MyObj.fromHour + '" /></td>' +
            '<td><input type="time" name="toHour" class="form-control" value="' + MyObj.toHour + '" /></td>' +
            '<td>' +
            '<div>' +
            '<input value="'+ MyObj.price+'" type="number" step="0.01"  name="price" class="form-control" required >' +
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
                    locale: {
                        format: 'MM/DD'
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
    // $.ajax({
    //     url: '/slots/allCustomSlots',
    //     method: 'GET',
    //     data: { calendar_id: calendarId },
    //     success: function(data) {
    //         data.forEach(function(obj) {
    //             ReturnReadyTr(obj.period_type);
    //
    //             $('input[name="start"].datetimes').each(function() {
    //
    //                 let $tr = $(this).closest('tr');
    //                 let starttime = $tr.data('start'); // Отримуємо значення атрибута data-start
    //                 $(this).daterangepicker({
    //                     singleDatePicker: true,
    //                     showDropdowns: true,
    //                     minYear: 1901,
    //                     startDate: starttime,
    //                     locale: {
    //                         format: 'MM/DD'
    //                     },
    //                     maxYear: parseInt(moment().format('YYYY'), 10)
    //                 }, function(start, end, label) {
    //                     var years = moment().diff(start, 'years');
    //                 });
    //             });
    //             $('input[name="end"].datetimes').each(function() {
    //                 let $tr = $(this).closest('tr');
    //                 let starttime = $tr.data('end');
    //                 $(this).daterangepicker({
    //                     singleDatePicker: true,
    //                     showDropdowns: true,
    //                     minYear: 1901,
    //                     startDate: starttime,
    //                     locale: {
    //                         format: 'MM/DD'
    //                     },
    //                     maxYear: parseInt(moment().format('YYYY'), 10)
    //                 }, function(start, end, label) {
    //                     var years = moment().diff(start, 'years');
    //                 });
    //             });
    //         });
    //
    //         getAllData();
    //     },
    //     error: function(xhr, status, error) {
    //
    //         console.error(xhr.responseText);
    //     }
    // });


    $('#CreateBT').click(function() {
        var newRow = '<tr>' +
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
            '<input type="number" name="price" step="0.01" class="form-control" required >' +
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
                selectedRow.find('.Start').find('input, select').replaceWith('<select name="start" class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
                selectedRow.find('.End').find('input, select').replaceWith('<select   name="end"   class="newSelect form-control "><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>');
            } else if (selectedOption == "customs") { // Якщо обрано опцію "Range of days"
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
                    locale: {
                        format: 'MM/DD'
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
        // if (isCanSend === true){
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken
        //         },
        //         url: '/slots/createOrUpdate',
        //         method: 'POST',
        //         data: dataToSend,
        //         success: function(response) {
        //             console.log("dasdasdasdasda");
        //         },
        //         error: function(error) {
        //             console.error('Error:', error);
        //         }
        //     });
        // }
    });
});

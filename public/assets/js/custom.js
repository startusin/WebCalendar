$(document).ready(function () {
    let array  = [];

    $(document).on('click', '.showUser', function () {
        let route = $(this).data('route');


        $.ajax({
            url: route,
            success: function (response) {
                $('#userEmail').text(response.email);
                $('#userFirstName').text(response.first_name);
                $('#userLastName').text(response.last_name);
                $('#userLanguages').text(response.languages);
            }
        })
    });


    $(document).on('click', '.showProduct', function () {
        let route = $(this).data('route');

        $.ajax({
            url: route,
            success: function (response) {
                $('#productTitle').text(response.title);
                $('#productShortDesc').text(response.short_description);
                $('#productDesc').text(response.description);
                $('#productPrice').text(response.price);
                $('#productMaxQty').text(response.max_qty);
            }
        })
    });


    $(document).on('click', '.showPromocode', function () {
        let route = $(this).data('route');

        $.ajax({
            url: route,
            success: function (response) {
                $('#promocodePromocode').text(response.promocode);
                $('#promocodePrice').text(response.price);
                $('#promocodeStartDate').text(moment(response.start_date).format('YYYY-MM-DD HH:mm:ss'));
                $('#promocodeEndDate').text(moment(response.end_date).format('YYYY-MM-DD HH:mm:ss'));
                $('#promocodeProduct').text(response.product_title.title);
            }
        })
    });


    $(document).on('click', '.showSlot', function () {
        let route = $(this).data('route');

        $.ajax({
            url: route,
            success: function (response) {
                $('#slotQuantity').text(response.attendee_qty);
                $('#slotLanguage').text(response.language);
                console.log(response.language);
                $('#slotStartDate').text(moment(response.start_date).format('YYYY-MM-DD HH:mm:ss'));
                $('#slotEndDate').text(moment(response.end_date).format('YYYY-MM-DD HH:mm:ss'));
            }
        })
    });

    $(document).on('click', '.event-time', function () {
        a = array.indexOf($(this).data('id'));
        console.log(a);
        if (array.indexOf($(this).data('id')) < 0) {
            array.push($(this).data('id'));
        } else {
            array.splice(array.indexOf($(this).data('id')), 1);
        }
        console.log(array);
    });
});

$(document).ready(function () {
    let array  = [];

    let htmlCard1 = '<div class="col-12">' +
        '<label for="exampleInputEmail1" class="form-label text-label">Numero de carte</label>' +
        '<input type="text" class="form-control" placeholder="1234 1234 1234 1234" aria-describedby="basic-addon1">' +
        '</div>' +
        '<div class="row mt-2">' +
        '<div class="col-6">' +
        '<label for="exampleInputEmail1" class="form-label text-label">Expiration</label>' +
        '<input type="text" class="form-control" placeholder="MM/YY" aria-describedby="basic-addon1">' +
        '</div>' +
        '<div class="col-6">' +
        '<label for="exampleInputEmail1" class="form-label text-label">CVC</label>' +
        '<input type="text" class="form-control" placeholder="CVC" aria-describedby="basic-addon1">' +
        '</div>' +
        '</div>';

    $('.generate-payments').html(htmlCard1);


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
        console.log($(this).parent());
        a = array.indexOf($(this).data('id'));
        console.log(a);
        if (array.indexOf($(this).data('id')) < 0) {
            array.push($(this).data('id'));
        } else {
            array.splice(array.indexOf($(this).data('id')), 1);
        }
        console.log(array);
    });




    $(document).on('click', '.card-item', function () {



        console.log(442);
        console.log($(this).data('id'));
        if ($(this).data('id') == 1) {
            $('.generate-payments').html(htmlCard1);
        }
    });
});

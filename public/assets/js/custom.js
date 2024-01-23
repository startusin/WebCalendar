$(document).ready(function () {
    var array  = {};
    let currentDate;
    let dataIds = {};
    function  EnabledOrDisabledButton()
    {
        let sumOfProduct = 0;
        let myDiv = document.getElementById('PurchaseButton');

        $('.up-card').each(function(index, element) {
            let productId = $(element).find('.left-icon').data('id');

            let currentValue = parseInt($(element).find('.count-of-product').text());
            if (currentValue > 0){
                dataIds[productId] = currentValue;
            }
            sumOfProduct+=currentValue;
        });

        if (Object.keys(array).length > 0 && sumOfProduct > 0){
            if (myDiv.classList.contains('disable_button')) {
                myDiv.classList.remove('disable_button');
            }
        }
        if (Object.keys(array).length <= 0 || sumOfProduct <= 0){
            if (!myDiv.classList.contains('disable_button')) {
                myDiv.classList.add('disable_button');
            }
        }
    }

    $(document).on('click', '.event-time', function () {

        let dateFromClick = $(this).text();
        let timestamp = $(this).data('id');
        let language = $(this).data('language');
        let startTime = $(this).data('start');
        let endTime = $(this).data('end');

        let itemObject = {
            dateFromClick: dateFromClick,
            timestamp: timestamp,
            language: language,
            startTime: startTime,
            endTime: endTime
        };
        if (!array[currentDate]) {
            array[currentDate] = {};
        }
        if (!array[currentDate]['objects']) {
            array[currentDate]['objects'] = [];
        }



            let indexOfElement = array[currentDate]['objects'].findIndex(item => item.timestamp === timestamp && item.language === language);
            if (indexOfElement<0){
                array[currentDate]['objects'].push(itemObject);
            } else {
                array[currentDate]['objects'].splice(indexOfElement,1);
            }
            if (array[currentDate]['objects'].length<=0){
                delete array[currentDate];
            }
            console.log("QQ="+indexOfElement);

        EnabledOrDisabledButton();
    });

    $(document).on('click', '.bootstrap-calendar-day', function () {
        currentDate = $(this).data('date');
    });

    let htmlCard1 = '<div class="col-12">' +
        '<label for="exampleInputEmail1" class="form-label text-label">Numero de carte</label>' +
        '<input type="text" required name="CardNumberInput" class="form-control" placeholder="1234 1234 1234 1234" aria-describedby="basic-addon1">' +
        '</div>' +
        '<div class="row mt-2">' +
        '<div class="col-6">' +
        '<label for="exampleInputEmail1" class="form-label text-label">Expiration</label>' +
        '<input type="text" required name="DateCardInput" class="form-control" placeholder="MM/YY" aria-describedby="basic-addon1">' +
        '</div>' +
        '<div class="col-6">' +
        '<label for="exampleInputEmail1" class="form-label text-label">CVC</label>' +
        '<input type="text" required name="CVCInput" class="form-control" placeholder="CVC" aria-describedby="basic-addon1">' +
        '</div>' +
        '</div>';



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






    $(document).on('click', '.card-item', function () {
        console.log(442);
        console.log($(this).data('id'));
        if ($(this).data('id') == 1) {
            $('.generate-payments').html(htmlCard1);
        }
    });




    $(document).on('click', '.reserve', function () {
        let currentUrl = window.location.href;

        let urlParts = currentUrl.split('/');

        let lastPart = urlParts[urlParts.length - 1];


        let queryString = $.param({ slots: array, productIdsQuantity: dataIds, calendarId: lastPart });
        console.log(queryString);
        window.location.href = '/purchase?' + queryString;
    });



    $("#form-data").validate({
        submitHandler: function(form) {

            let firstName = $('#First_NameInput').val();
            let lastName = $('#Last_NameInput').val();
            let companyName = $('#CompanyInput').val();
            let RegionName = $('#RegionSelect').val();
            let streetName = $('#StreetInput').val();
            let placeName = $('#PlaceInput').val();
            let postalCodeName = $('#PostalCode').val();
            let villaName = $('#floatingInput').val();
            let phoneName = $('#PhoneInput').val();
            let emailName = $('#EmailInput').val();
            let calendarId = $('#calendar_id').val();
            let slotId = $('#slots').val();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            let ProductQuantity = {}


            $('.accordion-item').each(function(index, element) {
                let productId = $(element).find('.prod-info').data('id');
                let productQuantity = $(element).find('.prod-info').data('quantity');
                let productPromo = $(element).find('.is-promocode').data('promo');
                console.log("id " +productId);
                if (productPromo === undefined) {
                    productPromo = null;
                }

                // Створюємо об'єкт для productId з вказанням productQuantity та productPromo

                ProductQuantity[productId] = {
                    productQuantity : productQuantity,
                    productPromo : productPromo
                };

            });
            console.log(ProductQuantity);

            var dataToSend = {
                calendarId: calendarId,
                slots: slotId,
                csrfToken: csrfToken,
                firstName: firstName,
                lastName: lastName,
                companyName: companyName,
                RegionName: RegionName,
                streetName: streetName,
                placeName: placeName,
                postalCodeName: postalCodeName,
                villaName: villaName,
                phoneName: phoneName,
                emailName: emailName,
                ProductQuantity: ProductQuantity
            };

            console.log(dataToSend);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: '/makeSlot',
                method: 'POST',
                data: dataToSend,
                success: function(response) {
                    console.log('Success:', response);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });




    $('.promocode-input').on('blur', function () {

        let htmlTrue = '<i class="fa-solid fa-check"></i>';
        let htmlFalse ='<i class="fa-solid fa-xmark"></i>';
        var enteredValue = $(this).val();
        var productId = $(this).data('product-id');

        var isPromocodeElement = $(this).closest('.row').find('.is-promocode');
        var $currentInput = $(this);
        console.log("Val"+enteredValue);
        console.log("Producg"+productId);

        let queryString = $.param({ promo: enteredValue, product: productId });

        $.ajax({
            url: '/checkPromocode',
            method: 'GET',
            data: queryString,
            success: function(response) {
                if (response && Object.keys(response).length > 0) {
                    isPromocodeElement.html(htmlTrue);
                    isPromocodeElement.attr('data-promo', response.id);
                    let productInf = $currentInput.closest('.accordion-item').find('.product-item-price');
                    let quantityObj = $currentInput.closest('.accordion-item').find('.prod-info');
                    let quantity = quantityObj.data('quantity');

                    productInf.html("<span>" +(Math.round((quantity * response.price) * 100) / 100).toFixed(2) + "$</span>");


                } else {
                    isPromocodeElement.html(htmlFalse);
                    isPromocodeElement.removeAttr('data-promo');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });

        // if (enteredValue == '1') {
        //     isPromocodeElement.html(htmlTrue);
        //     console.log("TRUE");
        // } else{
        //     console.log("false");
        //     isPromocodeElement.html(htmlFalse);
        // }
    });




    $(document).on('click', '.left-icon', function () {

        let productId = $(this).data('id');
        let maxQuantity = $(this).closest('.product-navigation').find('.count-of-product').data('max');
        let currentValue = $(this).closest('.product-navigation').find('.count-of-product');
        var newCount =  parseInt(currentValue.text()) + 1;
        if (newCount <= maxQuantity) {
            currentValue.text(newCount);
        }
        console.log(currentValue);
        UpdateTotalValue();
        EnabledOrDisabledButton();
    });

    $(document).on('click', '.right-icon', function () {
        let productId = $(this).data('id');
        let currentValue = $(this).closest('.product-navigation').find('.count-of-product');
        var newCount =  parseInt(currentValue.text()) - 1;
        if (newCount >= 0) {
            currentValue.text(newCount);
        }
        UpdateTotalValue();
        EnabledOrDisabledButton();

    });

    function UpdateTotalValue() {
        let sum = 0;
        $('.up-card').each(function(index, element) {
            let priceItem = $(element).find('.product-price').data('price');

            let currentValue = parseInt($(element).find('.count-of-product').text());
            sum+= priceItem*currentValue;
        });
        console.log($('.total-sum-purchase').text((Math.round(sum * 100) / 100).toFixed(2)+"$"));
    }
});

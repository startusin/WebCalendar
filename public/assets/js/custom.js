$(document).ready(function () {
    var array  = {};
    let currentDate;
    let dataIds = {};
    let productIds = [];

    let rememberDate = {};

    function setActive() {
        $('.bootstrap-calendar-day').each(function(index, element) {
            let selectDate = $(element).data('date');

            if (rememberDate.date === selectDate) {
                if (!$(element).hasClass('active')) {
                    $(element).addClass('active');
                }
            }
        });

        $('.event-time').each(function (index, element) {

            let selectTimeDate = $(element).data('id');
            let selectLanguage = $(element).data('language');

            if (currentDate === rememberDate.date && selectLanguage == rememberDate.language && selectTimeDate == rememberDate.time) {
                $(element).addClass('active');
            }
            if ($(element).hasClass('active')){
                selectTimeDate = $(element).data('id');
                console.log(selectTimeDate);
            }
        });

    }
    function AddAndRemoveDate() {
        let selectYearDate;
        $('.bootstrap-calendar-day').each(function(index, element) {
            if ($(element).hasClass('active')) {
                selectYearDate = $(element).data('date');
            }
        });

        let selectTimeDate;
        let selectLanguage;
        $('.event-time').each(function (index, element) {
            if ($(element).hasClass('active')){
                selectTimeDate = $(element).data('id');
                selectLanguage = $(element).data('language');
                console.log(selectTimeDate);
                console.log(selectLanguage);
            }
        });
        rememberDate = {};

        rememberDate = {
            date: selectYearDate,
            time: selectTimeDate,
            language: selectLanguage
        };

        console.log(rememberDate);
    }

    $(document).on('click', '.btn-prev-month', function () {
        $('.bootstrap-calendar-day').removeClass('active');

        setActive();
    });
    $(document).on('click', '.btn-next-month', function () {
        $('.bootstrap-calendar-day').removeClass('active');

        setActive();
    });
    // $('.bootstrap-calendar-day').each(function(index, element) {
    //     // Отримуємо значення атрибута data-date
    //     var currentDate = $(element).data('date');
    //
    //     // Перевіряємо, чи поточна дата співпадає з визначеною
    //     if (currentDate === '2024-01-15') {
    //         // Додаємо клас "active"
    //         $(element).addClass('active');
    //     }
    // });

    $('.up-card').each(function(index, element) {
        let productId = $(element).find('.left-icon').data('id');

        productIds.push(productId);
    });


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
        $('.event-time').removeClass('active');
        $(this).addClass('active');
        AddAndRemoveDate();
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

        var params = {
            startTime: startTime,
            endTime: endTime,
            productIds: productIds
        };

        $.ajax({
            url: '/checkprice',
            type: 'GET',
            data: params,
            success: function(response) {
                console.log(response);
                $('.up-card').each(function(index, element) {

                    let productElement = $(element).find('.product-price');
                    response.forEach(function (item){
                       if (item.id == productElement.data('id')) {
                           productElement.data("price", item.price);
                           if (item['priceProduct_id']){
                              productElement.attr("data-product-price-id", item['priceProduct_id']);
                           } else {
                               productElement.removeAttr('data-product-price-id');
                           }
                           productElement.text(item.price+"$");
                       }
                    });
                    UpdateTotalValue();
                });
            },
            error: function(error) {
                console.error('Помилка при відправленні запиту:', error);
            }
        });

    });


    $(document).on('click', '.bootstrap-calendar-day', function () {
        setActive();
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
        setActive();
        let currentUrl = window.location.href;

        let urlParts = currentUrl.split('/');

        let lastPart = urlParts[urlParts.length - 1];

        let productPriceId = [];
        $('.up-card').each(function(index, element) {

            let productElement = $(element).find('.product-price').data('product-price-id');
            if (productElement!=undefined) {
                productPriceId.push(productElement);
            }

        });


        let queryString = $.param({ slots: array, productIdsQuantity: dataIds, productPriceId: productPriceId, calendarId: lastPart });
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
                console.log("PROMP= "+productPromo);
                let productPriceId = $(element).find('.prod-info').data('product-price-id');
                console.log("id " +productId);
                if (productPriceId === undefined) {
                    productPriceId = null;
                }
                if (productPromo === undefined) {
                    productPromo = null;
                }

                // Створюємо об'єкт для productId з вказанням productQuantity та productPromo

                ProductQuantity[productId] = {
                    productQuantity : productQuantity,
                    productPromo : productPromo,
                    productPriceId : productPriceId
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

        let quantityObj = $currentInput.closest('.accordion-item').find('.prod-info');
        let quantity = quantityObj.data('quantity');
        let basePrice =  $currentInput.closest('.accordion-item').find('.prod-info').data('price');
        let productInf = $currentInput.closest('.accordion-item').find('.product-item-price');

        $.ajax({
            url: '/checkPromocode',
            method: 'GET',
            data: queryString,
            success: function(response) {
                if (response && Object.keys(response).length > 0) {
                    isPromocodeElement.html(htmlTrue);

                    isPromocodeElement.removeData('promo');
                    if (response.price > basePrice){
                        productInf.html("<span>" + (Math.round((quantity * basePrice) * 100) / 100).toFixed(2) + "$</span>");
                        console.log("Not Add");
                    }
                    else  {
                        console.log("ADDPROMO");
                        isPromocodeElement.data('promo', response.id);
                        productInf.html("<span>" + (Math.round((quantity * response.price) * 100) / 100).toFixed(2) + "$</span>");
                    }

                } else {
                    isPromocodeElement.html(htmlFalse);
                    isPromocodeElement.removeData('promo');

                    productInf.html("<span>" + (Math.round((quantity * basePrice) * 100) / 100).toFixed(2) + "$</span>");

                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });

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
            console.log(priceItem);
            let currentValue = parseInt($(element).find('.count-of-product').text());
            sum+= priceItem*currentValue;
        });
        console.log($('.total-sum-purchase').text((Math.round(sum * 100) / 100).toFixed(2)+"$"));
    }
});

$(document).ready(function () {
    var array  = {};
    let currentDate;
    let dataIds = {};
    let productIds = [];

    let rememberDate = {};

    $('.brunch-navigation .left-icon').click(function (e) {
        const target = e.currentTarget;
        const brunchPrice = $(target).closest('.brunch-navigation').find('.count-of-brunch');
        const currentValue = parseInt(brunchPrice.text(), 10);
        const quantity = parseInt($('.brunch.selected').data('quantity'), 10);

        if ($('.event-time.active').length <= 0) {
            return;
        }

        if (currentValue < quantity) {
            brunchPrice.text(currentValue + 1);
        }

        totalSumBrunch();
    });

    $('.brunch-navigation .right-icon').click(function (e) {
        const target = e.currentTarget;
        const brunchQty = $(target).closest('.brunch-navigation').find('.count-of-brunch');
        const currentValue = parseInt(brunchQty.text(), 10);

        if ($('.event-time.active').length <= 0) {
            return;
        }

        if (currentValue > 0) {
            brunchQty.text(currentValue - 1);
        }

        totalSumBrunch();
    });

    function totalSumBrunch() {
        const price = parseFloat($('.brunch.selected').data('price'));
        const brunchQty = parseInt($('.brunch-navigation').find('.count-of-brunch').text(), 10);

        $('.total-sum-purchase').text((Math.round((brunchQty * price) * 100) / 100).toFixed(2)+"$");

        if (brunchQty > 0) {
            $('#PurchaseButton').removeClass('disable_button');
        } else {
            $('#PurchaseButton').addClass('disable_button');
        }
    }

    function TotalSum() {
        let sum = 0;

        $('.prod-info').each(function(index, element) {
            let selectQuantity = $(element).data('quantity');
            let selectPrice = $(element).data('temp-price');
            console.log("selectQuantity1"+selectQuantity);
            console.log("selectPrice1"+selectPrice);
            if (selectPrice===undefined){
                selectPrice = $(element).data('price');
            }
            console.log("selectQuantity"+selectQuantity);
            console.log("selectPrice"+selectPrice);
            sum += selectQuantity * selectPrice;
        });
        $('.total-sum').text((Math.round((sum) * 100) / 100).toFixed(2)+"$");
    }

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
        console.log("SetActive rememberdate ");
        console.log(rememberDate);

        console.log("Current date " + currentDate);
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

        console.log("AddAndRemoveDate rememberdate ");
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

    $(document).on('click', '.bootstrap-calendar-day', function () {
        currentDate = $(this).data('date');
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
    });


    $('.product .up-card').each(function(index, element) {
        let productId = $(element).find('.product-navigation .left-icon').data('id');

        productIds.push(productId);
    });


    function  EnabledOrDisabledButton()
    {
        let sumOfProduct = 0;
        let myDiv = document.getElementById('PurchaseButton');

        $('.product .up-card').each(function(index, element) {
            let productId = $(element).find('.product-navigation .left-icon').data('id');

            let currentValue = parseInt($(element).find('.count-of-product').text(), 10);

            if (currentValue > 0) {
                dataIds[productId] = currentValue;
            } else {
                delete dataIds[productId];
            }

            sumOfProduct += currentValue;
        });

        if (sumOfProduct > 0){
            if (myDiv.classList.contains('disable_button')) {
                myDiv.classList.remove('disable_button');
            }
        }

        if (sumOfProduct <= 0){
            if (!myDiv.classList.contains('disable_button')) {
                myDiv.classList.add('disable_button');
            }
        }
    }



    $(document).on('click', '.event-time:not(.inactive)', function () {
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
        EnabledOrDisabledButton();

        var params = {
            startTime: startTime,
            endTime: endTime,
            productIds: productIds,
        };

        $('.products-area').addClass('d-none');

        $.ajax({
            url: '/checkprice',
            type: 'GET',
            data: params,
            success: function(response) {
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

                $('.products-area').removeClass('d-none');
                $('.button-order').removeClass('d-none');
            },
            error: function(error) {
                console.error('Помилка при відправленні запиту:', error);
            }
        });

        var brunchesParams = {
            startTime: startTime,
            calendarId: $('.main-container').data('calendar-id'),
        };

        $('.brunches-area').addClass('d-none');

        $.ajax({
            url: '/brunches',
            type: 'GET',
            data: brunchesParams,
            success: function(response) {
                $('.brunch-list').html('');

                let brunchHtml = '';
                let count = 0;

                response.forEach(function (item) {
                    count++;
                    const spacesLeft = (item.quantity - item.booked) <= 0 ? 0 : (item.quantity - item.booked);

                    brunchHtml +=
                        '<a class="brunch text-center ' + (spacesLeft <= 0 ? 'inactive' : '') + '" data-id="' + item.id + '" data-price="' + item.price + '"' +
                        '    data-quantity="' + spacesLeft + '">' +
                        '        <div class="icon">' +
                        '             <i class="fa-solid fa-mug-hot"></i>' +
                        '        </div>' +
                        '        <div class="time">' + item.time + '</div>' +
                        '        <div class="qty-inner">\n' +
                        '             <i class="fa-regular fa-user attendee-icon"></i>' +
                        '        <div class="qty-inner-text">' + spacesLeft + '</div>' +
                        '    </div>' +
                        '</a>';
                });

                $('.brunch-list').html(brunchHtml);

                if (count > 0) {
                    $('.brunches-area').removeClass('d-none');
                }

                $('.button-order').removeClass('d-none');
            },
            error: function(error) {
                console.error('Помилка при відправленні запиту:', error);
            }
        });
    });




    let htmlCard1 = '';



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
        if ($('.brunch.selected').length > 0) {
            const branchId = parseInt($('.brunch.selected').data('id'), 10);
            const quantity = parseInt($('.brunch.selected').data('quantity'), 10);

            const queryString = $.param({
                slots: array,
                type: 'branch',
                branchId: branchId,
                branchQty: quantity,
                calendarId: parseInt($('.main-container').data('calendar-id'), 10)
            });

            window.location.href = '/purchase?' + queryString;

            return;
        }


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


            if ($('.makesPurchase').data('type') === 'brunch') {
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
                    brunchId: $('.prod-info').data('brunch-id'),
                    type: 'brunch',
                    qty: $('.prod-info').data('qty'),
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/makeSlot',
                    method: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        window.location.replace("/payment/" + response.id + '?type=brunch');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });

                return;
            }

            let ProductQuantity = {}

            $('.products-items .accordion-item').each(function(index, element) {
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
                    window.location.replace("/payment/" + response.id);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });




    $('.promo-inner button').on('click', function (e) {
        e.preventDefault();

        const field = $(e.currentTarget).closest('.promo-inner').find('.promocode-input');

        field.removeClass('wrong');
        field.removeClass('correct');

        let htmlTrue = '<i class="fa-solid fa-check"></i>';
        let htmlFalse ='<i class="fa-solid fa-xmark"></i>';
        var enteredValue = $(field).val();
        var productId = $(field).data('product-id');

        var isPromocodeElement = $(this).closest('.row').find('.is-promocode');

        let queryString = $.param({ promo: enteredValue, product: productId });

        let quantityObj = field.closest('.accordion-item').find('.prod-info');
        let quantity = quantityObj.data('quantity');
        let basePrice =  field.closest('.accordion-item').find('.prod-info').data('price');
        let productInf = field.closest('.accordion-item').find('.product-item-price');

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
                        TotalSum();
                    }
                    else  {
                        quantityObj.attr('data-temp-price', response.price);
                        quantityObj.data('temp-price', response.price);

                        isPromocodeElement.data('promo', response.id);
                        productInf.html("<span>" + (Math.round((quantity * response.price) * 100) / 100).toFixed(2) + "$</span>");
                        TotalSum();
                    }

                } else {
                    isPromocodeElement.html(htmlFalse);
                    isPromocodeElement.removeData('promo');
                    quantityObj.removeAttr('data-temp-price');
                    quantityObj.removeData('temp-price');
                    productInf.html("<span>" + (Math.round((quantity * basePrice) * 100) / 100).toFixed(2) + "$</span>");
                    TotalSum();
                }

                field.addClass('correct');
            },
            error: function(error) {
                field.addClass('wrong');
            }
        });
    });




    $(document).on('click', '.product-navigation .left-icon', function () {
        const activeButton = $('.event-time.active');

        if (activeButton.length > 0) {
            let totalQty = 0;

            const qtyAvailable = $(activeButton).data('available');

            $('.products .product').each((index, element) => {
                const target = $(element);
                const count = parseInt($(target).find('.count-of-product').text(), 10);

                totalQty += count;
            });

            if (totalQty >= qtyAvailable) {
                return;
            }

            let currentValue = $(this).closest('.product-navigation').find('.count-of-product');
            var newCount =  parseInt(currentValue.text()) + 1;

            currentValue.text(newCount);

            UpdateTotalValue();
            EnabledOrDisabledButton();
        }
    });

    $(document).on('click', '.product-navigation .right-icon', function () {
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
        $('.product .up-card').each(function(index, element) {
            let priceItem = $(element).find('.product-price').data('price');
            let currentValue = parseInt($(element).find('.count-of-product').text());
            sum+= priceItem*currentValue;
        });
        $('.total-sum-purchase').text((Math.round(sum * 100) / 100).toFixed(2)+"$");
    }

    $('.brunch-list').on('click', '.brunch:not(.inactive)', function(e) {
        e.preventDefault();

        const target = e.currentTarget;

        if ($(target).hasClass('selected')) {
            $(target).removeClass('selected');

            $('.brunch-qty').addClass('d-none');
            $('.products').removeClass('d-none');

            $('.count-of-brunch').text('0');

            UpdateTotalValue();
            EnabledOrDisabledButton();

            return;
        }

        const price = $(target).data('price');

        $('.brunch-list .brunch').removeClass('selected');
        $('.brunch-qty').removeClass('d-none');
        $('.products').addClass('d-none');

        $('.brunch-price span').text(price);

        $(target).addClass('selected');
    });
});

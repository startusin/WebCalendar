$(document).ready(function () {
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    var array = {};
    var currentDate;
    let dataIds = {};
    let productIds = [];
    let CurrentLang;
    let rememberDate = {};
    let currentSlotOnView = {};
    let currentLanguage;
    console.log(getCookie('currentDate'));
    function getCookie(name) {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
        }
        return null;
    }



    //tempTime.format('D MMMM YYYY HH[h]mm');
    $('#SuccessDateId').text(getCookie('currentDate'));
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

    if ($('.BgImage img').attr('src') === '') {
        $('.BgImage').css('display', 'none');
    }
    if ($('.logoImage img').attr('src') === '') {
        $('.logoImage').css('display', 'none');
    }
    if ($('.bannerImage img').attr('src') === '') {
        $('.bannerImage').css('display', 'none');
    }

    $(document).ready(function() {
        $('#phone').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9+]/g,''));
        });
    });

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

        $('.total-sum-purchase').text((Math.round((brunchQty * price) * 100) / 100).toFixed(2)+"€");

        if (brunchQty > 0) {
            $('#PurchaseButton').removeClass('disable_button');
        } else {
            $('#PurchaseButton').addClass('disable_button');
        }
    }

    function TotalSum() {
        let sum = 0;
        let vat = 0;
        console.log('vat');
        console.log(vat);
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

        let totalSum = ((Math.round((sum) * 100) / 100) + ((Math.round((sum) * 100) / 100)*vat/100)).toFixed(2);

        $('.total-sum').text(totalSum + "€");

        return totalSum;
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

    $(document).on('change', '.Payments', function (){
        let currentStatus = $(this).val();
        let currentId = $(this).data('id');
        console.log(currentStatus);
        console.log(currentId);

        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(csrfToken);

        let dataToSend = {
            id: currentId,
            status: currentStatus
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: '/changeStatus',
            method: 'POST',
            data: dataToSend,
            success: function(response) {
                console.log("Good");
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });

    $(document).on('click', '.btn-prev-month', function () {
        $('.bootstrap-calendar-day').removeClass('active');

        setActive();
    });
    $(document).on('click', '.btn-next-month', function () {
        $('.bootstrap-calendar-day').removeClass('active');

        setActive();
    });

    $(document).on('click', '.bootstrap-calendar-day', function () {

        let element = document.querySelector('.js-events');

        element.scrollIntoView({ behavior: 'smooth', block: 'start' });

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
        CurrentLang = language;
        let itemObject = {
            dateFromClick: dateFromClick,
            timestamp: timestamp,
            language: language,
            startTime: startTime,
            endTime: endTime
        };

        array = {};

        if (!array[currentDate]) {
            array[currentDate] = {};
        }
        array[currentDate]['objects'] = [];
        array[currentDate]['objects'].push(itemObject);

        let tempTime = moment.utc(itemObject.startTime);

        if (currentLanguage==='fr') {
            moment.updateLocale('fr', {
                months: [
                    "janvier", "février", "mars", "avril", "mai", "juin",
                    "juillet", "août", "septembre", "octobre", "novembre", "décembre"
                ],
                weekdays: [
                    "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"
                ]
            });
        }

        let formattedStartTime = tempTime.locale('fr').format('D MMMM YYYY HH[h]mm');
        let formattedForSuccessPage = tempTime.locale('fr').format('dddd D MMMM YYYY HH[h]mm');

        document.cookie = "currentDate=" + String(formattedForSuccessPage) + "; expires=" + 3600 + "; path=/";

        $("#ViewCurrentSlot").text(formattedStartTime);

        console.log('currentSlotOnView');
        console.log(currentSlotOnView);
        // Мультивибір слотів
        // if (!array[currentDate]['objects']) {
        //     array[currentDate]['objects'] = [];
        // }
        //     let indexOfElement = array[currentDate]['objects'].findIndex(item => item.timestamp === timestamp && item.language === language);
        //     if (indexOfElement<0){
        //         array[currentDate]['objects'].push(itemObject);
        //     } else {
        //         array[currentDate]['objects'].splice(indexOfElement,1);
        //     }
        //     if (array[currentDate]['objects'].length<=0){
        //         delete array[currentDate];
        //     }
            console.log('array');
            console.log(array);
            console.log('currentDate');
            console.log(currentDate);
        EnabledOrDisabledButton();

        var params = {
            CurrentLang: CurrentLang,
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
                           console.log(item);
                           productElement.data("price", item.price);
                           if (item['priceProduct_id']){
                              productElement.attr("data-product-price-id", item['priceProduct_id']);
                           } else {
                               productElement.removeAttr('data-product-price-id');
                           }
                           console.log(item);
                           for (let key in item.price) {
                               if (key === language)
                               {
                                   console.log("Kety:"+key);
                                   console.log("Kety:"+item.price[key]);
                                   productElement.text(item.price[key]+"€");
                               }
                           }

                       }
                    });
                    UpdateTotalValue(CurrentLang);
                });

                $('.products-area').removeClass('d-none');
                $('.button-order').removeClass('d-none');

                let scrollToEl = $('.brunches');

                if (scrollToEl.length <= 0) {
                    scrollToEl = $('.products');
                }

                $('html').animate({ scrollTop: scrollToEl.offset().top });
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
                        '        <div class="qty-inner">\n' +
                        '             <div class="time">' + item.time + '</div>' +
                        '             <i class="fa-regular fa-user attendee-icon"></i>' +
                        '             <div class="qty-inner-text">' + spacesLeft + '</div>' +
                        '       </div>' +
                        '       <div class="icon">' +
                        '             <img class="table-not-active" src="/assets/images/table.svg" />' +
                        '             <img class="table-active" src="/assets/images/table-hover.svg" />' +
                        '       </div>' +
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


    function generateProduct(products, lang) {
        let totalWithVat = 0;

        var html = '<table class="w-100 table mt-4"><tr>' +
            '<th scope="col">Title</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">VAT</th><th scope="col">Total</th>' +
            '</tr>';

        products.forEach(function(item) {
            totalWithVat += (item.product.price[lang] * item.quantity);

            html += '<tr><td>' + (item.product.title[lang] || '-') + '</td><td>' + (item.product.price[lang] || '-') + '</td><td>' + item.quantity + '</td><td>' + ((item.product.price[lang] * item.quantity) / (parseFloat($('.modal-body').data('vat')))) + '</td><td>' + (item.product.price[lang] * item.quantity) + '</td></tr>';
        });

        html += '</table>';

        totalWithVat = totalWithVat.toFixed(2);

        let vat = (totalWithVat / parseFloat($('.modal-body').data('vat'))).toFixed(2);
        let totalNoVat = (totalWithVat - vat).toFixed(2);

        html += '<div style="text-align: right; margin-right: 5px;  margin-top: 30px; font-weight: bold;">' +
            '<div>Total Without VAT: ' + totalNoVat + '</div>' +
            '<div>VAT (' + vat + '%): ' + vat + '</div>' +
            '<div>Total (VAT Included): ' + totalWithVat + '</div>' +
        '</div>';



        document.getElementById('myproducts').innerHTML = html;
    }

    function generateComments(comments) {
        var html = '<table class="w-100 table mt-2"><tr>' +
            '<th scope="col">Comment</th><th scope="col">Date</th><th scope="col">Actions</th>' +
            '</tr>';

        comments.forEach(function(item) {
            const timestamp = new Date(item.created_at);
            const formattedDate = `${(timestamp.getDate()).toString().padStart(2, '0')}/${(timestamp.getMonth() + 1).toString().padStart(2, '0')}/${timestamp.getFullYear()} ${timestamp.getHours().toString().padStart(2, '0')}:${timestamp.getMinutes().toString().padStart(2, '0')}`;

            html += '<tr><td>' + item.comment + '</td><td>' + formattedDate + '</td><td><a class="remove-comment" data-id="' + item.id + '"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
        });

        html += '</table>';

        $('#order-comments').html(html);
    }



    $(document).on('click', '.showPurchase', function () {
        let route = $(this).data('route');

        $.ajax({
            url: route,
            success: function (response) {
                console.log(response.booking_products);
                generateProduct(response.booking_products,'en');
                generateComments(response.comments);
                console.log('response.booking.first_name');
                console.log(response.first_name);
                $('#FirstName').text(response.first_name);
                $('#LastName').text(response.last_name);
                $('#Phone').text(response.phone);
                $('#Place').text(response.place);
                $('#Street').text(response.street_name);

                $('#Email').text(response.email);
                console.log('response.slots[0].start_date');
                let dateTime = response.slots[0].start_date;
                console.log(dateTime);

                $('.post-comment').data('id', response.id);

                $('#SlotStarted').text(moment.utc(dateTime).format('DD/MM/YYYY HH:mm'));

                $('#SentMail').text(response.sent_email!=null?moment.utc(response.sent_email).format('DD/MM/YYYY HH:mm'):"Not Sent");


                let csrfToken = $('meta[name="csrf-token"]').attr('content');
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
                $('#promocodeStartDate').text(moment.utc(response.start_date).format('YYYY-MM-DD HH:mm:ss'));
                $('#promocodeEndDate').text(moment.utc(response.end_date).format('YYYY-MM-DD HH:mm:ss'));
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
                $('#slotStartDate').text(moment.utc(response.start_date).format('YYYY-MM-DD HH:mm:ss'));
                $('#slotEndDate').text(moment.utc(response.end_date).format('YYYY-MM-DD HH:mm:ss'));
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

    const directBooking = $('.main-container').data('direct-booking');

    $(document).on('click', '.reserve', function () {
        if ($('.brunch.selected').length > 0) {
            const branchId = parseInt($('.brunch.selected').data('id'), 10);
            const quantity = parseInt($('.count-of-brunch').text(), 10);
            console.log(quantity);
            const queryString = $.param({
                slots: array,
                type: 'branch',
                branchId: branchId,
                branchQty: quantity,
                calendarId: parseInt($('.main-container').data('calendar-id'), 10),
                'direct-booking': directBooking,
            });

            window.location.href = '/purchase?' + queryString;

            return;
        }


        setActive();
        let currentUrl = window.location.href;

        let urlParts = currentUrl.split('/');

        let lastPart = urlParts[urlParts.length - 1];
        let adminValue = $('input[name="admin"]').val()==""?"false":true;

        let productPriceId = [];
        $('.up-card').each(function(index, element) {

            let productElement = $(element).find('.product-price').data('product-price-id');

            if (productElement!=undefined) {
                productPriceId.push(productElement);
            }

        });


        let queryString = $.param({
            slots: array,
            productIdsQuantity: dataIds,
            productPriceId: productPriceId,
            calendarId: parseInt($('.main-container').data('calendar-id'), 10),
            'direct-booking': directBooking
        });
        console.log(queryString);
        window.location.href = '/purchase?' + queryString;
    });


    if ($("#form-data").length > 0) {
        $("#form-data").validate({
            submitHandler: function (form) {
                let firstName = $('#First_NameInput').val();
                let lastName = $('#Last_NameInput').val();
                let companyName = $('#CompanyInput').val();
                let RegionName = $('#RegionSelect').val();
                let streetName = $('#StreetInput').val();
                let placeName = $('#PlaceInput').val();
                let postalCodeName = $('#PostalCode').val();
                let villaName = $('#floatingInput').val();
                let phoneName = $('#phone').val();
                let inputObject = iti.getSelectedCountryData().dialCode;
                phoneName = `+${inputObject}${phoneName}`;
                let emailName = $('#EmailInput').val();
                let calendarId = $('#calendar_id').val();
                let adminValue = $('#adminValue').val();

                let slotId = $('#slots').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log('adminValue');
                console.log(adminValue);
                if (adminValue !== '1') {
                    if ($('.makesPurchase').data('type') === 'brunch') {
                        var dataToSend = {
                            calendarId: calendarId,
                            adminValue: adminValue,
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
                            success: function (response) {
                                window.location.replace("/payment/" + response.id + '?type=brunch');
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });

                        return;
                    }

                    let ProductQuantity = {}

                    $('.products-items .accordion-item').each(function (index, element) {
                        let productId = $(element).find('.prod-info').data('id');
                        let productQuantity = $(element).find('.prod-info').data('quantity');
                        let productPromo = $(element).find('.promocode-input.correct').data('promo');

                        console.log("correct= ");
                        console.log("PROMP= " + productPromo);

                        if (productPromo === undefined) {
                            productPromo = null;
                        }

                        ProductQuantity[productId] = {
                            productQuantity: productQuantity,
                            productPromo: productPromo
                        };

                    });

                    var dataToSend = {
                        calendarId: calendarId,
                        adminValue: adminValue,
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
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/payment/update-intent',
                        method: 'POST',
                        data: {
                            totalSum: TotalSum(),
                            intentId: $('.all-purchase').data('intent'),
                            meta: dataToSend,
                        },
                        success: function () {
                            $('#payment-form #submit').click();
                        }
                    });
                } else {
                    if ($('.makesPurchase').data('type') === 'brunch') {
                        var dataToSend = {
                            calendarId: calendarId,
                            adminValue: adminValue,
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
                            success: function (response) {
                                alert("Order successfully processed");
                                window.location.replace("/makeOrder");
                                parent.location.reload();
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });

                        return;
                    }

                    let ProductQuantity = {}

                    $('.products-items .accordion-item').each(function (index, element) {
                        let productId = $(element).find('.prod-info').data('id');
                        let productQuantity = $(element).find('.prod-info').data('quantity');
                        let productPromo = $(element).find('.promocode-input.correct').data('promo');

                        console.log("correct= ");
                        console.log("PROMP= " + productPromo);

                        if (productPromo === undefined) {
                            productPromo = null;
                        }

                        ProductQuantity[productId] = {
                            productQuantity: productQuantity,
                            productPromo: productPromo
                        };

                    });

                    var dataToSend = {
                        calendarId: calendarId,
                        adminValue: adminValue,
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
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/makeSlot',
                        method: 'POST',
                        data: dataToSend,
                        success: function () {
                            alert("Order successfully processed");
                            window.location.replace("/makeOrder");
                            parent.location.reload();
                        }
                    });
                }
            }
        });
    }




    $('.promo-inner button').on('click', function (e) {
        e.preventDefault();

        const field = $(e.currentTarget).closest('.promo-inner').find('.promocode-input');

        field.removeClass('wrong');
        field.removeClass('correct');

        var enteredValue = $(field).val();
        var productId = $(field).data('product-id');

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
                    field.removeData('promo');

                    if (response.price > basePrice){
                        productInf.html("<span>" + (Math.round((quantity * basePrice) * 100) / 100).toFixed(2) + "€</span>");
                        console.log("Not Add");
                        TotalSum();
                    }
                    else  {
                        quantityObj.attr('data-temp-price', response.price);
                        quantityObj.data('temp-price', response.price);

                        field.data('promo', response.id);
                        productInf.html("<span>" + (Math.round((quantity * response.price) * 100) / 100).toFixed(2) + "€</span>");
                        TotalSum();
                    }

                } else {
                    field.removeData('promo');
                    quantityObj.removeAttr('data-temp-price');
                    quantityObj.removeData('temp-price');
                    productInf.html("<span>" + (Math.round((quantity * basePrice) * 100) / 100).toFixed(2) + "€</span>");
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

            UpdateTotalValue(CurrentLang);
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
        UpdateTotalValue(CurrentLang);
        EnabledOrDisabledButton();

    });

    function UpdateTotalValue(CurrentLang) {
        let sum = 0;
        $('.product .up-card').each(function(index, element) {
            let priceItem = $(element).find('.product-price').data('price');
            let currentValue = parseInt($(element).find('.count-of-product').text());
            if (priceItem == undefined){
                console.log("EE");
                priceItem = 0;
            }
            console.log("Price "+priceItem[CurrentLang]);
            console.log("currentValue "+currentValue);

            sum+= priceItem[CurrentLang]*currentValue;
            console.log("sum "+sum)
        });
        $('.total-sum-purchase').text((Math.round(sum * 100) / 100).toFixed(2)+"€");
    }

    $('.brunch-list').on('click', '.brunch:not(.inactive)', function(e) {
        e.preventDefault();

        const target = e.currentTarget;

        if ($(target).hasClass('selected')) {
            $(target).removeClass('selected');

            $('.brunch-qty').addClass('d-none');
            $('.products').removeClass('d-none');

            $('.count-of-brunch').text('0');

            UpdateTotalValue(CurrentLang);
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

    $('.make-purchase').click((e) => {
        e.preventDefault();

        $('form#form-data').submit();
    });

    $('.payment-link-copy').on('click', function (e) {
        e.preventDefault();

        const href = $(e.currentTarget).attr('href');

        navigator.clipboard.writeText(window.location.origin + href)
            .then(() => {
                alert('Payment link was copied!');
            })
            .catch((err) => {
                console.error('Error copying payment link:', err);
            });
    });

    $('.order-history').delegate('.post-comment', 'click', function (e) {
        e.preventDefault();

        const id = $('.post-comment').data('id');
        const text = $('.new-comment-content').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: '/purchase/comment',
            data: {
                order_id: id,
                comment: text,
            },
            method: 'POST',
            success: function (response) {
                window.location.href = '/purchase/all';
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    $('.order-history').delegate('.remove-comment', 'click', function (e) {
        e.preventDefault();

        const id = $(e.currentTarget).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: '/purchase/comment/' + id,
            method: 'DELETE',
            success: function (response) {
                window.location.href = '/purchase/all';
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});

$(document).ready(function () {

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

    });

    $(document).on('click', '.right-icon', function () {
        let productId = $(this).data('id');
        let currentValue = $(this).closest('.product-navigation').find('.count-of-product');
        var newCount =  parseInt(currentValue.text()) - 1;
        if (newCount >= 0) {
            currentValue.text(newCount);
        }
        UpdateTotalValue();
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

$(document).ready(function () {



    $(document).on('click', '.left-icon', function () {
        console.log(442);
        console.log($(this).data('id'));
        if ($(this).data('id') == 1) {
            $('.generate-payments').html(htmlCard1);
        }
    });
});

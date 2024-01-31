$(document).ready(function() {
    $('#logo').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageUrl = e.target.result;
                $('.logoImage img').attr('src', imageUrl);
                $('.logoImage').css('display', 'block');

            }
            reader.readAsDataURL(file);
        }
    });

    $('#banner').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageUrl = e.target.result;
                $('.bannerImage img').attr('src', imageUrl);
                $('.bannerImage').css('display', 'block');

            }
            reader.readAsDataURL(file);
        }
    });
});

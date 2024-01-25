$(document).ready(function() {
    $('.custom-file-input').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageUrl = e.target.result;
                $('.myImage img').attr('src', imageUrl);
            }
            reader.readAsDataURL(file);
        }
    });
});

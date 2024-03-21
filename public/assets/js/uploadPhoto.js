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


    $('#bg_image').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageUrl = e.target.result;
                $('.BgImage img').attr('src', imageUrl);
                $('.BgImage').css('display', 'block');

            }
            reader.readAsDataURL(file);
        }
    });

    $('.delete-bg-image').click(function(event) {
        event.preventDefault();

        let $imageDiv = $(this).closest('.my-image');
        let image = $(this).data('image');
        let status = $(this).data('status');

        $imageDiv.find('img').attr('src', '');
        $imageDiv.css('display', 'none');

        let imageData = {
            image: image,
            status: status
        }
        $.ajax({
            url: '/deleteImage',
            type: 'GET',
            data: imageData,
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log('Error ' + countryName);
            }
        });
    });
});

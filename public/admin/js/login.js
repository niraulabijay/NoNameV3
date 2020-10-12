$('#login').submit(function (event) {
    event.preventDefault();
       var postData = {
            'email': $('input[name=email]').val(),
            'password': $('input[name=password]').val(),
            'rememberMe': $('input[name=rememberMe]').is(':checked'),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: '/login/check',
            data: postData,
            success: function (response) {
                window.location.href = response.redirect;
            },
            error: function (response) {
                console.log(response);
                $('.alert-danger').text(response.responseJSON.error);
                $('.alert-danger').show();
            }
        });
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            $('.style-photo').show();
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    readURL(this);
});
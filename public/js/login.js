/*===================================
=            Brand Login            =
===================================*/

$('#brand-login').on('submit', function(e) {
    e.preventDefault();
    var email = $('#input_brand_email').val();
    var password = $('#input_brand_password').val();
    $.ajax({
        type: "POST",
        url: 'http://localhost/20sections/api/v1/brand-login',
        data: {
            email:email, password:password
        },
        success: function(res) {
            if(res.error == 'Unauthorised'){
                $('.error_brand_login').html('Email hoặc mật khẩu không đúng');
            }else{
                window.location.href = 'http://localhost:8098/';
            }
        }
    });
});

/*=====  End of Brand Login  ======*/


/*=================================
=            Publisher            =
=================================*/

$('#publisher-login').on('submit', function(e) {
    e.preventDefault();
    var email = $('#input_client_email').val();
    var password = $('#input_client_password').val();
    $.ajax({
        type: "POST",
        url: 'http://localhost/20sections/api/v1/publisher-login',
        data: {
            email:email, password:password
        },
        success: function(res) {
            if(res.error == 'Unauthorised'){
                $('.error_client_login').html('Email hoặc mật khẩu không đúng');
            }else{
                window.location.href = 'http://localhost:8099/';
            }
            
        }
    });
});

/*=====  End of Publisher  ======*/


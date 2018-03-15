$('#publisher-register').on('submit', function(e) {
    e.preventDefault();
    var firstname = $('#input_client_firstName').val();
    var lastname = $('#input_client_lastName').val();
    var email = $('#input_client_email_signup').val();
    var phone = $('#input_client_phone_signup').val();
    var password = $('#input_client_password_signup').val();
    var c_password = $('#input_client_confirm_password_signup').val();
    $.ajax({
        type: "POST",
        url: 'http://localhost/20sections/api/v1/publisher-register',
        data: {
            firstname : firstname, lastname : lastname, email:email, phone : phone, password:password, c_password : c_password
        },
        success: function(res) {
            if(JSON.parse(res.success) == true){
                alert('Đăng ký tài khoản thành công. Vui lòng đăng nhập!')
            }
            window.location.href = 'http://localhost/20sections/';
        }
    });
});
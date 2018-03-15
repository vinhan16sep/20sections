var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
$('.btn-submit-register').click(function(){
    if($('#input_client_firstName').val() == ''){
        $('.error_firstName').html('Không được trống');
    }
    if($('#input_client_lastName').val() == ''){
        $('.error_lastName').html('Không được trống');
    }
    if($('#input_client_email_signup').val() == ''){
        $('.error_email').html('Không được trống');
    }
    if($('#input_client_phone_signup').val() == ''){
        $('.error_phone').html('Không được trống');
    }
    if($('#input_client_password_signup').val() == ''){
        $('.error_password').html('Không được trống');
    }
    if($('#input_client_confirm_password_signup').val() == ''){
        $('.error_confirm_password').html('Không được trống');
    }
    if (!filter.test($('#input_client_email_signup').val())) {
        $('.error_email').html('Định dạng email không đúng');
    }
    // if(Number.isInteger($('#input_client_phone_signup').val()) == false){
    //     $('.error_phone').html('Vui lòng nhập số');
    // }
    if($('#input_client_confirm_password_signup').val() != $('#input_client_password_signup').val()){
        $('.error_confirm_password').html('Xác nhận mật khẩu không đúng');
    }
});
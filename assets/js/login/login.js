var base_url = $('body').data('page-base');
var login_form = $('#login-form');

$(document).ready(function(){


  login_form.validate({
    rules:{
      lg_email_:{
        required: true,
        email: true
      },
      lg_password_:"required",
    },
    highlight: function (input) {
        $(input).closest('.inputBx').addClass('error');
    },
    unhighlight: function (input) {
        $(input).closest('.inputBx').removeClass('error');
    },
    errorPlacement: function (error, element) {
        $(element).parents('.inputBx').append(error);

    },
    submitHandler: function(form) {

        doLogin();
    }
  });

});

function doLogin(){
    var data = login_form.serialize();
    $('#alert_login').fadeOut('fast');
    $('#btn_submit').html('Tunggu...').attr('disabled', 'true');
    $.ajax({
        url: base_url+'auth/auth_login',
        type: 'POST',
        data: data
    })
    .done(function(data) {
        var parsed_data = JSON.parse(data);
        if(parsed_data.result){
            location.reload();
        }else{
            $('#alert_content').html('<b>Gagal Login!</b><br>'+parsed_data.msg);
            $('#alert_login').fadeIn('fast');
        }
    })
    .fail(function() {
        $('#alert_content').html('<b>Gagal Login!</b><br> terjadi kesalahan saat menghubungi server, periksa kembali koneksi anda!');
        $('#alert_login').fadeIn('fast');
    })
    .always(function() {
        $('#btn_submit').html('<i class="fa fa-send"></i> Log in').removeAttr('disabled');
    });

}

var form_profile = $('#form-change-profile');
var form_password = $('#form-change-password');
var validate_profile, validate_password;
var img = document.getElementById('img_cropper');
var cropper;
var cropBoxData;
var canvasData;


$(document).ready(function() {

    $('#image_upload').on('click touchstart' , function(){
        $(this).val('');
    });

    $("#image_upload").on('change', function(event) {
        $('#modal_form').modal({
            backdrop: 'static',
            keyboard: false
        });
        readURL(this);
    });

    $('#modal_form').on('shown.bs.modal', function () {
            cropper = new Cropper(img, {
                autoCropArea: 1,
                aspectRatio: 1  /1,
                ready: function () {
                    // Strict mode: set crop box data first
                    cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
            }
        });
    }).on('hidden.bs.modal', function () {
        cropBoxData = cropper.getCropBoxData();
        canvasData = cropper.getCanvasData();
        cropper.destroy();
    });

        $('#btn_upload_logo').click(function(event) {
            try {
                var user_code = $('[name="pr_user_code_"]').val();
                var cropcanvas = cropper.getCroppedCanvas({
                    maxWidth: 800,
                    maxHeight: 800,
                    imageSmoothingEnabled: false,
                });
                var croppng = cropcanvas.toDataURL("image/png");
                $.confirm({
                    title: 'Konfirmasi',
                    content: 'Upload Gambar?',
                    type: 'blue',
                    buttons: {
                        remove: {
                            text:"UPLOAD",
                            btnClass:"btn-primary",
                            action:function(){
                                $.alert({
                                    type:'orange',
                                    buttons: {
                                        close: {
                                            btnClass:"btn-primary"
                                        }
                                    },
                                    content: function(){
                                        var self = this;
                                        return $.ajax({
                                            url: base_url+'profile/save_image',
                                            type: 'POST',
                                            data: {
                                                imgdata: croppng,
                                                code:user_code
                                            }
                                        })
                                        .done(function(data) {

                                            var parsed = JSON.parse(data);
                                            var msg;
                                            if(parsed.result){
                                                msg = "Berhasil mengunggah gambar!";
                                                $('#modal_form').modal('toggle');
                                                cropper.reset();
                                                load_img();
                                            }else{
                                                msg = "Terjadi kesalahan saat mengunggah gambar! <br>"+parsed.msg;
                                            }

                                            self.setContent(msg);
                                            self.setTitle('Upload Gambar');


                                        })
                                        .fail(function() {
                                            self.setContent('Oops, terjadi kesalahan!');
                                        });
                                    }
                                });
                            }
                        },
                        cancel: function () {

                        },
                    }
                });
            } catch (e) {
                console.log(e);
            } finally {

            }
        });

    validate_profile = form_profile.validate({
        rules:{
            pr_email_:{
                required:true,
            },
            pr_fullname_:{
                required:true,
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form) {
            save_profile();
        }
    });

    validate_password = form_password.validate({
        rules:{
            pr_old_password_:{
                required:true,
            },
            pr_new_password_:{
                required:true,
            },
            pr_confirm_new_password_:{
                required:true,
                equalTo:"[name='pr_new_password_']"
            }

        },
        messages:{
            pr_confirm_new_password_:{
                equalTo:"Password baru tidak sama"
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form) {
            save_password();
        }
    });
});

function save_profile(){
    var form_data = form_profile.serialize();
    $('#btn_submit_profile').html('<i class="fas fa-sync-alt fa-spin"></i> Processing...').attr('disabled','true');
    $.ajax({
        url: base_url+'profile/change_profile',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            if(parsed.result==true){
                notif_msg = "Berhasil menyimpan data!";
                showNotification("bg-green", notif_msg, "top", "right", null, null);
                $('#profile-fullname').html($('[name="pr_fullname_"]').val());
                $('.profile-fullname').text($('[name="pr_fullname_"]').val());
                $('input').blur();
            }else{
                if(parsed.result=='exist'){
                    //notif_msg = "Gagal menyimpan data, Nama<b> sudah terpakai!</b>";
                    //$('#alert_msg').html(notif_msg);
                    //$('#alert_modal').fadeIn('fast');
                    //showNotification("alert-danger", notif_msg, "top", "right", null, null);
                }else{
                    notif_msg = "Oops! Gagal menyimpan data!";
                    showNotification("alert-danger", notif_msg, "top", "right", null, null);
                }
            }
        }else{
            notif_msg = "Oops! Gagal menyimpan data!";
            showNotification("alert-danger", notif_msg, "top", "right", null, null);
        }
    })
    .fail(function() {
        notif_msg = "Oops! Terjadi kesalahan saat megirim data";
        showNotification("alert-danger", notif_msg, "top", "right", null, null);
    })
    .always(function() {
        $('#btn_submit_profile').html('<i class="fas fa-check"></i> Submit').removeAttr('disabled');
    });
}

function save_password(){
    var form_data = form_password.serialize();
    $('#btn_submit_profile').html('<i class="fas fa-sync-alt fa-spin"></i> Processing...').attr('disabled','true');
    $.ajax({
        url: base_url+'profile/change_password',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            if(parsed.result==true){
                notif_msg = "Berhasil menyimpan data!";
                showNotification("bg-green", notif_msg, "top", "right", null, null);
                $('#profile-fullname').html($('[name="pr_fullname_"]').val());
                $(':password').val('');
                $('#form-change-password')[0].reset();
                setTimeout(function (){                  
                    window.location.replace(base_url+'auth/auth_logout');
                }, 2000);
            }else{
                if(parsed.result=='not_match'){
                    notif_msg = "Gagal menyimpan data, Password baru dan konfirmasi password baru tidak cocok";
                    showNotification("alert-danger", notif_msg, "top", "right", null, null);
                    // $('#alert_msg').html(notif_msg);
                    //$('#alert_modal').fadeIn('fast');
                }else if(parsed.result=='not_exist'){
                    notif_msg = "Gagal menyimpan data, Password lama tidak cocok";
                    showNotification("alert-danger", notif_msg, "top", "right", null, null);
                }else{
                    notif_msg = "Oops! Gagal menyimpan data!";
                    showNotification("alert-danger", notif_msg, "top", "right", null, null);
                }
            }
        }else{
            notif_msg = "Oops! Gagal menyimpan data!";
            showNotification("alert-danger", notif_msg, "top", "right", null, null);
        }
    })
    .fail(function() {
        notif_msg = "Oops! Terjadi kesalahan saat megirim data";
        showNotification("alert-danger", notif_msg, "top", "right", null, null);
    })
    .always(function() {
        $('#btn_submit_profile').html('<i class="fas fa-check"></i> Submit').removeAttr('disabled');
    });
}

function load_img(){
    $.ajax({
        url: base_url+'profile/get_profpic',
        type: 'post',
        data:{
            code_:$('[name="pr_user_code_"]').val()
        }
    })
    .done(function(response) {
        data = JSON.parse(response)
        if(data.image!=false){
            $('.profile-picture').attr('src', base_url+data.image['image'].replace('./',''));
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        // console.log("complete");
    });

}

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img_cropper').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

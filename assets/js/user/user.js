var grid;
var tbl = $('#table_for_data');
var page_form = $('#mp_form');
var page_form_edit = $('#mp_form_edit');
var validate_form;
var validate_form_edit;
var notif_msg;
var img = document.getElementById('img_cropper');
var cropper;
var cropBoxData;
var canvasData;

jQuery(document).ready(function($) {


    grid = tbl.DataTable({
        responsive: false,
        rowReorder: true,
        ajax:{
            url: base_url+"user/get_user",
        },
        columns:[
            {"data":null,"defaultContent":"","width":"5%","searchable":false,"orderable":false},
            {
                "data":"image",
                "defaultContent":'',
                "orderable":false,
                "width":"200px",
                "render":function(data){
                    if(!data){
                        return '<img src="'+base_url+'/assets/images/blank_pic.png" class="img" style="width:200px;height:200px;">';
                    }

                    return '<img src="'+data+'" class="img" style="width:200px;height:200px;">';
                }
            },
            {"data":"user_email"},
            {"data":"user_fullname","width":"35%"},
            {"data":"type","width":"13%"},
            {"data":"status"},
            {"data":null,"defaultContent":"","width":"8%"}
        ],
        columnDefs: [
            {
                "targets":5,
                "width":"5%",
                "render":function(data,type,row,meta){
                    var badge;
                    if(data==1){
                        badge = '<span class="badge bg-green">Active</span>';
                    }else{
                        badge = '<span class="badge bg-red">Disabled</span>';
                    }

                    return '<center>'+badge+'</center>';
                }
            },
            {
                "targets":6,
                "orderable":false,
                "searchable":false,
                "render":function(data,type,row,meta){
                    var opt = '';

                    opt += '<div class="btn-group">';
                    opt += '<button type="button" class="btn btn-xs btn-block bg-blue dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    opt += 'Options <span class="caret"></span>';
                    opt += '</button>';
                    opt += '<div class="dropdown-menu pull-right">';
                    opt += '<a href="javascript:void(0);" class="dropdown-item action_edit"><i class="fa fa-edit"></i> Edit</a>';
                    opt += '<a href="javascript:void(0);" class="dropdown-item action_remove"><i class="fa fa-trash"></i> Delete</a>';
                    opt += '</div>';
                    opt += '</div>';

                    return '<center>'+opt+'</center>';
                }
            }
        ],
        "order": [[ 1, 'asc' ]]
    });

    grid.on( 'order.dt search.dt', function () {
        grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#table_for_data tbody').on('click','.action_edit',function(){
        open_modal_edit("");
        $('#mp_form_edit [name="ua_email_"]').val(grid.row($(this).parents('tr')).data().user_email);
        $('#mp_form_edit [name="ua_fullname_"]').val(grid.row($(this).parents('tr')).data().user_fullname);
        $('#mp_form_edit [name="ua_user_type_"]').val(grid.row($(this).parents('tr')).data().id_user_type).change();

        var stat = grid.row($(this).parents('tr')).data().status;

        if(stat==1){
            $('#mp_form_edit [name="ua_status_"]').prop('checked',true);
        }else{
            $('#mp_form_edit [name="ua_status_"]').prop('checked',false);
        }

        $('[name="ua_code_"]').val(grid.row($(this).parents('tr')).data().id_user);
    });

    $('#table_for_data tbody').on('click','.action_remove',function(){
        remove_data(grid.row($(this).parents('tr')).data().id_user);
    });


    validate_form = page_form.validate({
        rules:{
            ua_email_:{
                required: true,
                email: true
            },
            ua_fullname_:"required",
            ua_password_:"required",
            ua_user_type_:"required",
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
            save_data();
        }
    });

    validate_form_edit = page_form_edit.validate({
        rules:{
            ua_email_:{
                required: true,
                email: true
            },
            ua_fullname_:"required",
            ua_password_:"required",
            ua_user_type_:"required",
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
            change_data();
        }
    });

    reloadTable();
    addForm();

    $('#table_for_data tbody').on('click touchstart', '.image_upload' , function(){
        $(this).val('');
    });

    $('#table_for_data tbody').on('change', '.image_upload', function(event) {
        $('#modal_form_img').trigger('shown.bs.modal');
        $('#modal_form_img').modal('show');
        readURL(this);
        $('[name="pr_user_code_"').val(grid.row($(this).parents('tr')).data().id_user)
    });

    $('#modal_form_img').on('shown.bs.modal', function () {
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
                                            $('#modal_form_img').modal('toggle');
                                            cropper.reset();
                                            grid.ajax.reload();
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
});

function reloadTable(){
    $('#reload_table').click(function(event) {
        grid.ajax.reload();
    });
}

function open_modal(title){
    $("#modal_label").html(title);
    $('#modal_form').modal({
        backdrop:'static',
        keyboard:false
    });
}

function open_modal_edit(){
    $("#modal_form_edit").modal({
        backdrop:'static',
        keyboard:false,
    })
}

function addForm(){
    $('#action_add').click(function(event) {
        $('[name="nv_code_"]').val("");
        open_modal("Navigasi Baru");
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
    $('#alert-modal').hide();
    $.ajax({
        url: base_url+'user/save_user',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form.get(0).reset();
            $('[name="ua_user_type_"]').val("0").change();
            $('#modal_form').modal('toggle');
            grid.ajax.reload();
        }else{
            if(parsed.result=='exist'){
                notif_msg = "Gagal menyimpan data, <b>email sudah terpakai!</b>";
                $('#alert_msg').html(notif_msg);
                $('#alert_modal').fadeIn('fast');
            }else{
                notif_msg = "Oops! Gagal menyimpan data!";
                showNotification("alert-danger", notif_msg, "top", "right", null, null);
            }
        }
    })
    .fail(function() {
        notif_msg = "Oops! Terjadi kesalahan saat megirim data";
        showNotification("alert-danger", notif_msg, "top", "right", null, null);
    })
    .always(function() {
        $('#btn_submit').html('SIMPAN').removeAttr('disabled');
        $('#modal_preloader').hide('fast');
    });
}

function change_data(){
    var form_data = page_form_edit.serialize();
    $('#btn_submit_edit').html('Processing...').attr('disabled','true');
    $('#modal_preloader_edit').show('fast');
    $.ajax({
        url: base_url+'user/change_user',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form_edit.get(0).reset();
            page_form_edit.find('[name="ua_user_type_"]').val("0").change();
            $('#modal_form_edit').modal('toggle');
            grid.ajax.reload();
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
        $('#btn_submit_edit').html('SIMPAN').removeAttr('disabled');
        $('#modal_preloader_edit').hide('fast');
    });
}


function remove_data(code){
    $.confirm({
        title: 'Konfirmasi',
        content: 'Hapus user?',
        type: 'red',
        buttons: {
            remove: {
                text:"HAPUS",
                btnClass:"btn-danger",
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
                                url: base_url+'user/remove_user',
                                type: 'POST',
                                data: {ua_code_: code}
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus User Account');
                                grid.ajax.reload();
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

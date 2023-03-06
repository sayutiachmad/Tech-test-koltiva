var grid;
var tbl = $('#table_for_data');
var page_form = $('#mp_form');
var validate_form;
var notif_msg;

jQuery(document).ready(function($) {



    grid = tbl.DataTable({
        responsive: false,
        rowReorder: true,
        ajax:{
            url: base_url+"user/get_user_type",
        },
        columns:[
            {"data":null,"defaultContent":"","width":"5%","searchable":false,"orderable":false},
            {"data":"type_name","width":"55%"},
            {"data":null,"defaultContent":"","width":"8%","orderable":false,"searchable":false}
        ],
        columnDefs: [
            {
                "targets":2,
                "render":function(data,type,row,meta){
                    var opt = '';

                    opt += '<div class="btn-group">';
                    opt += '<button type="button" class="btn btn-block btn-xs bg-blue dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    opt += 'Options <span class="caret"></span>';
                    opt += '</button>';
                    opt += '<div class="dropdown-menu float-right">';
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
        open_modal("Ubah User Type");
        $('[name="ut_name_"]').val(grid.row($(this).parents('tr')).data().type_name);

        $('[name="ut_code_"]').val(grid.row($(this).parents('tr')).data().id_user_type);
    });

    $('#table_for_data tbody').on('click','.action_remove',function(){
        remove_data(grid.row($(this).parents('tr')).data().id_user_type);
    });

    validate_form = page_form.validate({
        rules:{
            ut_name_:"required"
        },
        messages:{
            ut_name_:"Field ini harus diisi"
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

    reloadTable();
    addForm();
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

function addForm(){
    $('#action_add').click(function(event) {
        $('[name="ut_code_"]').val("");
        page_form[0].reset();
        open_modal("User Type Baru");
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
    $.ajax({
        url: base_url+'user/save_user_type',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form.get(0).reset();
            $('#modal_form').modal('toggle');
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
        $('#btn_submit').html('SIMPAN').removeAttr('disabled');
        $('#modal_preloader').hide('fast');
    });
}

function remove_data(code){
    $.confirm({
        title: 'Konfirmasi',
        content: 'Hapus User Type?',
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
                                url: base_url+'user/remove_user_type',
                                type: 'POST',
                                data: {ut_code_: code}
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus User Type');
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

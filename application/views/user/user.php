<style type="text/css">
    .inputfile:focus + label, .inputfile + label:hover{
        color: #000;
    }
</style>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-users"></i> Akun Pengguna </h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="javascript:;" class="btn btn-tool" id="reload_table"><i class="fa fa-sync"></i> Reload Data</a>
            </div>


            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable" id="table_for_data" style="width: 100%;">
                    <thead>
                        <tr class="bg-themes-default">
                            <th>#</th>
                            <th>Profile Picture</th>
                            <th>Email</th>
                            <th>User Full Name</th>
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="modal_label"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                
            </div>
            <form class="form-horizontal" id="mp_form" method="POST">
                <div class="modal-body">
                    <div class="row-clearfix">
                        <div id="alert_modal" class="alert bg-red alert-dismissible" role="alert" style="display: none;">
                            <span id="alert_msg"></span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="email_address_2">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="ua_email_" class="form-control" placeholder="Email" autocomplete="false">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="email_address_2">Full Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="ua_fullname_" class="form-control" placeholder="User Full Name" autocomplete="false">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="password_2">Password</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="ua_password_" class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="password_2">User Type</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="ua_user_type_" class="form-control" data-live-search="true">
                                        <option value="0" disabled selected>- Pilih User Type -</option>
                                        <?php foreach ($list_type as $key => $value) { ?>
                                            <option value="<?php echo $value[F_USER_TYPE_ID];?>"><?php echo $value[F_USER_TYPE_NAME];?></option>
                                       <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="ua_code_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect" id="btn_submit">SIMPAN</button>
                    <button type="button" class="btn btn-olive" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form_edit" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_label">Ubah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                    
            </div>
            <form class="form-horizontal" id="mp_form_edit" method="POST">
                <div class="modal-body">
                    <div class="row-clearfix">
                        <div id="alert_modal" class="alert bg-red alert-dismissible" role="alert" style="display: none;">
                            <span id="alert_msg"></span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="ua_email_" class="form-control" placeholder="Email" autocomplete="false" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="email_address_2">Full Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="ua_fullname_" class="form-control" placeholder="User Full Name" autocomplete="false">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="">User Type</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="ua_user_type_" class="form-control" data-live-search="true">
                                        <option value="0" disabled selected>- Pilih User Type -</option>
                                        <?php foreach ($list_type as $key => $value) { ?>
                                            <option value="<?php echo $value[F_USER_TYPE_ID];?>"><?php echo $value[F_USER_TYPE_NAME];?></option>
                                       <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="">Account Status</label>
                        </div>
                        <div class="col-12 col-md-9" style="padding-top:9px">
                            <div class="form-group">
                                <label class="switch">
                                    <input type="checkbox" name="ua_status_"><span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="ua_code_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_submit_edit">SIMPAN</button>
                    <button type="button" class="btn btn-olive font-bold" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal_form_img"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-upload"></i> Upload Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-sm-12">
                        <center><img id="img_cropper" style="height:400px;" ></center>
                        <input type="hidden" name="pr_user_code_">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-primary pull-right" id="btn_upload_logo"><i class="fas fa-upload"></i> Upload</a>
                <a href="javascript:;" class="btn btn-default pull-right" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</a>
            </div>
        </div>
    </div>
</div>
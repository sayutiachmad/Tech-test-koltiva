
<div class="row">
    <div class="col-md-3 col-12">
        <div class="card card-olive card-outline">
          <div class="card-body box-profile">

            <?php
              $img = base_url('assets/images/'.BLANK_PROFILE_PICTURE);
              if (@getimagesize(base_url(str_replace('./','',$sess_data[SESSION_USER_PROFILE_PICTURE])))) {
                $img = (base_url(str_replace('./','',$sess_data[SESSION_USER_PROFILE_PICTURE])));
              }
            ?>

            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="<?php echo $img;?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $sess_data[SESSION_USER_FULLNAME];?></h3>

            <p class="text-muted text-center"><?php echo $profile['type_name'];?></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <div class="caption">
                    <center>
                        <a href="javascript:;" id="show-change-avatar-input" class="btn btn-link"><i class="fas fa-camera"></i> Ubah Foto Profile</a>
                        <div class="blur"><input type="file" id="image_upload" class="inputfile" style="display: none;"></div>
                    </center>
                    <div class="caption-text">
                        
                    </div>
                  </div>
              </li>
            </ul>

          </div>
          <!-- /.card-body -->
        </div>
    </div>

    <div class="col-12 col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ubah Password</a></li>
                </ul>                
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <form id="form-change-profile" class="form-horizontal form-label-left" method="post">

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-12" for="first-name">Email <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-12">
                                <input type="text" required="required" class="form-control col-md-7 col-12" name="pr_email_" value="<?php echo $sess_data[SESSION_USER_EMAIL];?>" disabled>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-12" for="last-name">Full Name <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-12">
                                <input type="text" required="required" class="form-control col-md-7 col-12" name="pr_fullname_" value="<?php echo $sess_data[SESSION_USER_FULLNAME];?>">
                              </div>
                            </div>

                            <input type="hidden" name="pr_user_code_" value="<?php echo $sess_data[SESSION_USER_ID];?>">

                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success btn-submit"><i class="fas fa-check"></i> Submit</button>
                              </div>
                            </div>

                          </form>
                    </div>

                    <div class="tab-pane" id="password">
                        <form id="form-change-password" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-12" for="first-name">Old Password <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-12">
                                <input type="password" required="required" class="form-control col-md-7 col-12" name="pr_old_password_" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-12" for="last-name">New password <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-12">
                                <input type="password" required="required" class="form-control col-md-7 col-12" name="pr_new_password_">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-12" for="last-name">Confirm New password <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-12">
                                <input type="password" required="required" class="form-control col-md-7 col-12" name="pr_confirm_new_password_" >
                              </div>
                            </div>

                            <input type="hidden" name="pr_user_code_" value="<?php echo $sess_data[SESSION_USER_ID];?>">

                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
                              </div>
                            </div>

                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal_form"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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
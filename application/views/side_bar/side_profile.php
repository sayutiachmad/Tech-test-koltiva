<?php
  $img = base_url('assets/images/'.BLANK_PROFILE_PICTURE);
  if (@getimagesize(base_url(str_replace('./','',$sess_data[SESSION_USER_PROFILE_PICTURE])))) {
    $img = (base_url(str_replace('./','',$sess_data[SESSION_USER_PROFILE_PICTURE])));
  }
?>

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
	<div class="image">
	  <img src="<?php echo $img; ?>" class="img-circle elevation-2" alt="User Image">
	</div>
	<div class="info">
	  <a href="javascript:;" class="d-block"><?php echo $sess_data[SESSION_USER_FULLNAME];?></a>
	</div>
</div>
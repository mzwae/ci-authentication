<?php echo validation_errors(); ?>
<?php echo form_open('register/index', 'role="form" class="form-signin"'); ?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
<h2 class="form-sigin-heading text-center">Register...</h2>
<input type="text" class="form-control" name="usr_fname" placeholder="Type your first name here..." autofocus>
<input type="text" class="form-control" name="usr_lname" placeholder="Type your last name here...">
<input type="email" class="form-control" name="usr_email" placeholder="Type your email here...">
<?php echo form_submit('submit', 'Register', 'class="btn btn-lg btn-success btn-block"') ?>
  </div>
</div>
<?php echo form_close(); ?>

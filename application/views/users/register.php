<?php echo validation_errors(); ?>
<?php echo form_open('register/index', 'role="form" class="form-signin"'); ?>
<h2 class="form-sigin-heading">Register...</h2>
<input type="text" class="form-control" name="usr_fname" placeholder="Type your first name here..." autofocus>
<input type="text" class="form-control" name="usr_lname" placeholder="Type your last name here...">
<input type="email" class="form-control" name="usr_email" placeholder="Type your email here...">
<?php echo form_submit('submit', 'Register', 'class="btn btn-lg btn-primary btn-block"') ?>
<?php echo form_close(); ?>

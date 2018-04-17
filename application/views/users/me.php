<?php echo validation_errors(); ?>
<div class="page-header">
  <h1><?=$page_heading?></h1>
</div>
<p class="lead">Edit User Details</p>

<?php echo form_open('me/index', 'role="form" class="form"'); ?>
<div class="form-group">
  <?php echo form_error(usr_fname); ?>
  <label for="usr_fname">First Name</label>
  <?php echo form_input($usr_fname); ?>
</div>

<div class="form-group">
  <?php echo form_error(usr_lname); ?>
  <label for="usr_lname">Last Name</label>
  <?php echo form_input($usr_lname); ?>
</div>

<div class="form-group">
  <?php echo form_error(usr_uname); ?>
  <label for="usr_uname">Username</label>
  <?php echo form_input($usr_uname); ?>
</div>

<div class="form-group">
  <label for="usr_email">Email</label>
  <?php echo form_input($usr_email); ?>
</div>

<div class="form-group">
  <label for="usr_confirm_email">Confirm Email</label>
  <?php echo form_input($usr_confirm_email); ?>
</div>

<div class="form-group">
  <label for="usr_add1">Address 1</label>
  <?php echo form_input($usr_add1); ?>
</div>
<div class="form-group">
  <label for="usr_add2">Address 2</label>
  <?php echo form_input($usr_add2); ?>
</div>
<div class="form-group">
  <label for="usr_add3">Address 3</label>
  <?php echo form_input($usr_add3); ?>
</div>

<div class="form-group">
  <label for="usr_zip_pcode">Post Code</label>
  <?php echo form_input($usr_zip_pcode); ?>
</div>

<?php echo form_hidden($id); ?>


<div class="form-group">
  <button type="submit" class="btn btn-success">Submit</button> or <a href="users">Cancel</a>
</div>

<?php echo form_close(); ?>
</div>

 <a href="me/pwd_email/<?=$id?>">Reset Email</a>

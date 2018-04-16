<div class="page-header">
  <h1><?=$page_heading?></h1>
</div>
<p class="lead">Edit User Details</p>
<div class="span8">
  <?php echo form_open('users/eidt_user', 'role="form" class="form"'); ?>
  <div class="form-group">
    <?php echo form_error('usr_fname'); ?>
    <label for="usr_fname">First Name</label>
    <?php echo form_input('$usr_fname'); ?>
  </div>
  <div class="form-group">
    <?php echo form_error('usr_lname'); ?>
    <label for="usr_lname">Last Name</label>
    <?php echo form_input('$usr_lname'); ?>
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

  <div class="form-group">
    <label id="usr_access_level" for="usr_access_level">User Access Level</label>
    <?php echo form_dropdown('usr_access_level', $usr_access_level_options, $usr_access_level) ?>
  </div>

  <div class="form-group">
    <?php echo form_error('usr_is_active'); ?>
    <label for="usr_is_active">User is active?</label>
    <input type="radio" name="usr_is_active" <?php if($usr_is_active==1){echo 'checked';}?>>Active
    <input type="radio" name="usr_is_active" <?php if($usr_is_active==0){echo 'checked';}?>>Inactive
  </div>

  <?php echo form_hidden($id); ?>

  <div class="form-group">
    <button type="submit" class="btn btn-success">Submit</button> or <a href="users">Cancel</a>
  </div>

  <?php echo form_close(); ?>

  <a href="users/pwd_email/<?=$id['usr_id']?>">Send Password Reset Email</a>
  </div>

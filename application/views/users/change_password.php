<?php if (isset($login_fail)): ?>
  <div class="alert alert-danger">
    Whoops! Something went wrong - have another go!
  </div>
<?php endif; ?>
<?php echo validation_errors(); ?>
<?php echo form_open('me/change_password', 'class="form-signin" role="form"'); ?>
<h2 class="form-signin-heading">Reset Password...</h2>
<p class="lead">Enter your email in the box below and if your email is in the database we will send you a new password</p>
<table border="0">
  <tr>
    <td>Your email</td>
  </tr>
  <tr>
    <td><?php echo form_input($usr_new_pwd_1); ?></td>
  </tr>
  <tr>
    <td><?php echo form_input($usr_new_pwd_2); ?></td>
  </tr>
</table>
<button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
<br>
<?php echo form_close(); ?>
</div>

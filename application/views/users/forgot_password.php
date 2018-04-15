<?php if(isset($login_fail)) : ?>
  <div class="alert alert-danger">
    Whoops! Something went wrong - have another go!
  </div>
<?php endif; ?>

<?php echo validation_errors(); ?>
<?php echo form_open('password/forgot_password', 'class="form-signin" role="form"'); ?>
<h2 class="form-signin-heading">Reset Password...</h2>
<p class="lead">Enter your email in the box below and if your email is in the database we will send you a new password</p>

<input type="email" name="usr_email" class="form-control"  id="email" value="" maxlength="100" size="50" style="width:100%" placeholder="Type your email here...">

<br>

<button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
<br>
<?php echo form_close(); ?>
</div>

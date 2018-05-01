<?php if(isset($login_fail)) : ?>
  <div class="alert alert-danger">
    Whoops! Something went wrong - have another go!
  </div>
<?php endif; ?>
<?php echo validation_errors(); ?>
<?php echo form_open('signin/index', 'class="form-signin" role="form"'); ?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
  <h2 class="form-signin-heading text-center">Please sign in</h2>
  <input type="email" name="usr_email" class="form-control" placeholder="Type email here..." required autofocus>
  <input type="password" name="usr_password" class="form-control" placeholder="Type password here..." required>
  <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
  <br>
  <a href="password">Forgot your password?</a>
  </div>
</div>
<?php echo form_close(); ?>

<!DOCTYPE html>
<html>
<head>
<?php include("header.php"); ?>
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
			  <div class="modal-dialog">
          <div class="modal-content box-shadow-site">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Register </h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <form id="loginForm" method="POST" action="<?php echo base_url('/register'); ?>" novalidate="novalidate">
                              <div class="form-group">
                                  <label for="username" class="control-label">Email Id <span class="text-danger">*</span></label>
                                  <input type="email" class="form-control"  name="email_id" value="<?php echo set_value('email_id'); ?>" title="Please enter you email" placeholder="example@gmail.com">
                                  <?php echo form_error('email_id','<div class="text-danger">', '</div>'); ?>
                              </div>
							                <div class="form-group">
                                  <label for="username" class="control-label">Phone Number <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control"  name="phone_number" value="<?php echo set_value('phone_number'); ?>"  title="Mobile Number" placeholder="Enter your mobile number">
                                  <?php echo form_error('phone_number','<div class="text-danger">', '</div>'); ?>
                              </div>
							                <div class="form-group">
                                  <label for="username" class="control-label">Username <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control"  name="user_name" value="<?php echo set_value('user_name'); ?>" required="" title="Please enter you username" placeholder="Username">
                                  <?php echo form_error('user_name','<div class="text-danger">', '</div>'); ?>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
                                  <input type="password" class="form-control"  name="password" value="<?php echo set_value('password'); ?>" required="" >
                                  <?php echo form_error('password','<div class="text-danger">', '</div>'); ?>
                              </div>
							                <div class="form-group">
                                  <label for="password" class="control-label">Confirm Password <span class="text-danger">*</span></label>
                                  <input type="password" class="form-control"  name="confirm_password" value="<?php echo set_value('confirm_password'); ?>" title="Confirm your password">
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
            							  <div class="">
            							     <button type="submit" id="submit" name="submit" class="btn btn-success"  value="submit">Signup</button>
            							     <a href="<?php echo base_url('home/login'); ?>" type="submit" class="btn btn-warning  ">Login if you already Account</a>
            							  </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
        </div>
		    </div>
	  </div>
    <!-- <div id="sucessmsg">
    </div> -->
</div>
<?php include("footer.php"); ?>
</body>
</html>

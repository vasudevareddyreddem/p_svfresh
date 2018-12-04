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

              <h4 class="modal-title" id="myModalLabel">Login to SV Fresh</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12 col-md-6">
                    <?php if($this->session->flashdata('success')): ?>
                    <div class="alert_msg1 animated slideInUp bg-succ">
                        <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i> </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="alert_msg1 animated slideInUp bg-warn">
                        <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i> </div>
                    <?php endif; ?>
                      <div class="well">
                          <form id="loginForm" method="POST" action="<?php echo base_url('home/login'); ?>" novalidate="novalidate">
                              <div class="form-group">
                                  <label for="username" class="control-label">Phone number</label>
                                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo set_value('phone_number'); ?>" required="" placeholder="Enter phone number">
                                  <?php echo form_error('phone_number','<div class="text-danger">', '</div>'); ?>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('phone_number'); ?>" required="" placeholder="Enter password">
                                  <?php echo form_error('password','<div class="text-danger">', '</div>'); ?>
                                  <span class="help-block"></span>
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember" id="remember"> Remember login
                                  </label>

                              </div>
                              <button type="submit" class="btn btn-success btn-block">Login</button>

                          </form>
                      </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                      <p class="lead">Register now for <span class="text-success">FREE</span></p>
                      <ul class="list-unstyled register-free-points" style="line-height:28px">
                          <li><span class="fa fa-check text-success"></span> See all your orders</li>
                          <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                          <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                          <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                          <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>

                      </ul>
					  <div class="clearfix">&nbsp;</div>
                      <p><a href="<?php echo base_url('/register'); ?>" class="btn btn-info btn-block">Yes please, register now!</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>

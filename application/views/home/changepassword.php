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
              <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12">
                  <div class="well">
                    <?php if($this->session->flashdata('success')): ?>
                    <div class="alert_msg1 animated slideInUp bg-succ">
                        <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i> </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="alert_msg1 animated slideInUp bg-warn">
                        <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i> </div>
                    <?php endif; ?>
                    <form id="loginForm" method="POST" action="<?php echo base_url('/home/cpassword'); ?>" novalidate="novalidate">
                      <div class="form-group">
                        <label for="username" class="control-label">New Password</label>
                        <input type="password" class="form-control"  name="password" value="" placeholder="New Password">
                        <?php echo form_error('password','<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label for="username" class="control-label">Confirm Password</label>
                        <input type="password" class="form-control"  name="confirm_password" value="" required="" placeholder="Confirm Password">
                        <?php echo form_error('confirm_password','<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="">
                        <button type="submit" id="submit" name="submit" class="btn btn-success"  value="submit">Change password</button>
                        <a href="<?php echo base_url('home'); ?>" type="submit" class="btn btn-warning  ">Back to home</a>
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

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
              <h4 class="modal-title" id="myModalLabel">Profile</h4>
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
                    <form id="loginForm" method="POST" action="<?php echo base_url('/home/profile'); ?>" novalidate="novalidate">
                      <div class="form-group">
                        <label for="username" class="control-label">Email Id <span class="text-danger">*</span></label>
                        <input type="email" class="form-control"  name="email_id" value="<?php echo $user->email_id; ?>" title="Please enter you email" placeholder="example@gmail.com">
                        <?php echo form_error('email_id','<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label for="username" class="control-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="phone_number" value="<?php echo $user->phone_number; ?>"  title="Mobile Number" placeholder="Enter your mobile number">
                        <?php echo form_error('phone_number','<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label for="username" class="control-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="user_name" value="<?php echo $user->user_name; ?>" required="" title="Please enter you username" placeholder="Username">
                        <?php echo form_error('user_name','<div class="text-danger">', '</div>'); ?>
                      </div>
                      <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                      <div class="">
                        <button type="submit" id="submit" name="submit" class="btn btn-success"  value="submit">Update</button>
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

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
              <h4 class="modal-title" id="myModalLabel">Otp Verification </h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <form id="loginForm" method="POST" action="<?php echo base_url('register/verifyotp'); ?>" novalidate="novalidate">
                              <input type="hidden" id="id" name="id" value="<?php echo isset($id)?$id:''; ?>">
                             <div class="form-group">
								<label for="password" class="control-label">OTP <span class="text-danger">*</span></label>
								<input type="text" class="form-control"  name="otp" value="<?php echo set_value('otp'); ?>" required="" >
								<?php echo form_error('otp','<div class="text-danger">', '</div>'); ?>
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
								 <button type="submit" id="submit" name="submit" class="btn btn-success"  value="submit">Verify</button>
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
<script type="text/javascript">
      $(document).ready(function(){
          $('#apartment').on('change',function(){
            $('#block').html('<option value="">loading....</option>');
            var apartment_id = $(this).val();
            $.ajax({
              url:'<?php echo base_url('billing/get_blocks_by_apartment_id'); ?>',
              type:'POST',
              data:{'apartment_id':apartment_id},
              success:function(data){
                $('#block').html(data);
              }
            });
          });
      });
    </script>
</body>
</html>

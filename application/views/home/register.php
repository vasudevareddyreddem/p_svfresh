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
                                  <label for="username" class="control-label">First Name <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control"  name="first_name" value="<?php echo set_value('first_name'); ?>" title="Please enter you first name" placeholder="Enter First Name">
                                  <?php echo form_error('first_name','<div class="text-danger">', '</div>'); ?>
                              </div>
                              <div class="form-group">
                                  <label for="username" class="control-label">Last Name <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control"  name="last_name" value="<?php echo set_value('last_name'); ?>" title="Please enter you last name" placeholder="Enter Last Name">
                                  <?php echo form_error('last_name','<div class="text-danger">', '</div>'); ?>
                              </div>
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


							  <!-- apartment-->
							   <div class="form-group">
								  <label for="address" class="required">Apartment <span class="text-danger">*</span></label>
								  <select class="input form-control" name="appartment" id="apartment">
									<option value="">--Select Apartment--</option>
									<?php if(count($apartment) > 0) { ?>
									  <?php foreach($apartment as $a) { ?>
										<option value="<?php echo $a->apartment_id; ?>"><?php echo $a->apartment_name; ?></option>
									  <?php } ?>
									<?php } ?>
								  </select>
								  <?php echo form_error('appartment','<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group">
								  <label for="address" class="required">Block <span class="text-danger">*</span></label>
								  <select class="input form-control" name="block" id="block">
									<option value="">--Select Block--</option>
								  </select>
								  <?php echo form_error('block','<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group">
								  <label for="address" class="required">Flat/Door no <span class="text-danger">*</span></label>
								  <input type="text" class="input form-control" name="flat_door_no" id="address" value="<?php echo set_value('address'); ?>">
								  <?php echo form_error('flat_door_no','<div class="text-danger">', '</div>'); ?>
								</div>
							  <!-- apartment-->
               
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

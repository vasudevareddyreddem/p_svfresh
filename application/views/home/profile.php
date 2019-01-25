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
					    <!-- apartment-->
							   <div class="form-group">
								  <label for="address" class="required">Appartment <span class="text-danger">*</span></label>
								  <select class="input form-control" name="appartment" id="apartment">
									<option value="">--Select Appartment--</option>
									<?php if(count($apartment) > 0) { ?>
									  <?php foreach($apartment as $a){ ?>
										  <?php if($user->appartment == $a->apartment_id){ ?>
												<option selected value="<?php echo $a->apartment_id; ?>"><?php echo $a->apartment_name; ?></option>
										  <?php }else{ ?>
												<option value="<?php echo $a->apartment_id; ?>"><?php echo $a->apartment_name; ?></option>
										  <?php } ?>										
									  <?php } ?>
									<?php } ?>
								  </select>
								  <?php echo form_error('appartment','<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group">
								  <label for="address" class="required">Block <span class="text-danger">*</span></label>
								  <select class="input form-control" name="block" id="block">
								  <?php if(isset($blocks_list) && count($blocks_list)>0){ ?>
								  <option value="">--Select Block--</option>
									  <?php foreach($blocks_list as $lis){ ?>
										 		 <?php if($user->block == $lis['block_id']){ ?>
												<option selected value="<?php echo $lis['block_id']; ?>"><?php echo $lis['block_name']; ?></option>
										      <?php }else{ ?>
												<option value="<?php echo $lis['block_id']; ?>"><?php echo $lis['block_name']; ?></option>
										     <?php } ?>							
									  <?php } ?>
								  <?php } ?>
									
								  </select>
								  <?php echo form_error('block','<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group">
								  <label for="address" class="required">Flat/Door no <span class="text-danger">*</span></label>
								  <input type="text" class="input form-control" name="flat_door_no" id="address" value="<?php echo $user->flat_door_no; ?>">
								  <?php echo form_error('flat_door_no','<div class="text-danger">', '</div>'); ?>
								</div>
							  <!-- apartment-->
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

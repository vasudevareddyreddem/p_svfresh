<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Billing Information</h3>
		<h3 class="card py-4 px-4 " style="font-size:22px">Total Amount(Milk + Cart) = <?php echo isset($cart_total_amt)?$cart_total_amt:'0'; ?>(<?php echo isset($withmilk_total_amt['m_amt'])?$withmilk_total_amt['m_amt']:'0'; ?> + <?php echo isset($without_total_amt['c_amt'])?$without_total_amt['c_amt']:'0'; ?>)</h3>
        <?php if(count($billing) > 0){ ?>
          <div class="">
            <div class="row">

              <form action="<?php echo base_url('billing/old_delivery_address'); ?>" method="POST">
                <?php $i=1; foreach($billing as $b){ ?>
                  <div class="col-md-3">
                    <div class="box-shadow-site modal-body">
                      <input type="radio" name="billing_id" value="<?php echo $b->id; ?>" <?php echo ($i == 1) ? 'checked':''; ?>>
                      <p><?php echo $b->first_name.' '.$b->last_name; ?>, <?php echo $b->email_address; ?>,
                        <?php echo $b->mobile_number; ?>, <?php echo $b->apartment_name; ?>, <?php echo $b->block_name; ?>, <?php echo $b->flat_door_no; ?>.</p>
                        <a href="<?php echo base_url('billing/edit/'.$b->id); ?>" name="edit_billing" class="btn btn-success">Edit</a>
                        <a href="<?php echo base_url('billing/delete/'.$b->id); ?>" name="delete_billing" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                    <?php $i++; } ?>
                    <div class="clearfix">
                    </div>
                    <br>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-success">Procdeed For Payment</button>
                    </div>
                  </form>

                </div>
              </div>
            <?php } ?>
            <br>
            <form method="POST" action="<?php echo base_url('/billing'); ?>">
              <div class="container">
                <ul>
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="first_name" class="required">First Name <span class="text-danger">*</span></label>
                      <input type="text" class="input form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>">
                      <?php echo form_error('first_name','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                    <div class="col-sm-6">
                      <label for="last_name" class="required">Last Name <span class="text-danger">*</span></label>
                      <input type="text" name="last_name" class="input form-control" id="last_name" value="<?php echo set_value('last_name'); ?>">
                      <?php echo form_error('last_name','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                  </li><!--/ .row -->
				  <br>
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="email_address" class="required">Email Address <span class="text-danger">*</span></label>
                      <input type="text" class="input form-control" name="email_address" id="email_address" value="<?php echo set_value('email_address'); ?>">
                      <?php echo form_error('email_address','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                    <div class="col-sm-6">
                      <label for="mobile_number" class="required">Mobile Number <span class="text-danger">*</span></label>
                      <input class="input form-control" type="text" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number'); ?>">
                      <?php echo form_error('mobile_number','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                  </li><!--/ .row -->
				  <br>
                  <li class="row">
                    <div class="col-xs-4">
                      <label for="address" class="required">Appartment <span class="text-danger">*</span></label>
                      <select class="input form-control" name="appartment" id="apartment">
                        <option value="">--Select Appartment--</option>
                        <?php if(count($apartment) > 0) { ?>
                          <?php foreach($apartment as $a) { ?>
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
                    <div class="col-xs-4">
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
                    <div class="col-xs-4">
                      <label for="address" class="required">Flat/Door no <span class="text-danger">*</span></label>
                      <input type="text" class="input form-control" name="flat_door_no" id="address" value="<?php echo $user->flat_door_no; ?>">
                      <?php echo form_error('flat_door_no','<div class="text-danger">', '</div>'); ?>
                    </div>
                  </li><!-- / .row -->
                </ul>
              </div>
              <div class="clearfix">&nbsp;</div>
              <div class="pull-right mt-10">
                <button type="submit" name="" class="btn btn-success">Proceed For Payment </button>
              </div>
            </div>
          </form>
        </div>
      </div>
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

<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Billing Information</h3>
		    <h3 class="card py-4 px-4 " style="font-size:22px">
          Total Amount(Milk + Cart) = <?php echo isset($cart_total_amt)?$cart_total_amt:''; ?>(<?php echo isset($withmilk_total_amt['m_amt'])?$withmilk_total_amt['m_amt']:''; ?> + <?php echo isset($without_total_amt['c_amt'])?$without_total_amt['c_amt']:''; ?>)
        </h3>
        <br>
        <?php if(isset($user) && !empty($user)){ ?>
				<div class="row">
					<form action="<?php echo base_url('billing/index'); ?>" method="POST">
						  <div class="col-md-3">
							<div class="box-shadow-site modal-body">
								<p><b>Name : </b><?php echo (isset($user->first_name)) ? $user->first_name.' '.$user->last_name : ''; ?></p>
								<p><b>Email : </b><?php echo (isset($user->email_id)) ? $user->email_id : ''; ?></p>
								<p><b>Phone Number : </b><?php echo (isset($user->phone_number)) ? $user->phone_number : ''; ?></p>
								<p><b>Apartment : </b><?php echo (isset($user->appartment)) ? $user->appartment : ''; ?></p>
								<p><b>Block : </b><?php echo (isset($user->block)) ? $user->block : ''; ?></p>
								<p><b>Flat/Door No : </b><?php echo (isset($user->block)) ? $user->flat_door_no : ''; ?></p>
								<a href="<?php echo base_url('billing/edit'); ?>" class="btn btn-success">Edit</a>
							  </div>
							  <input type="hidden"
							</div>
							<div class="clearfix">
							</div>
							<br>
							<div class="col-md-12">
							  <button type="submit" name="submit" class="btn btn-success">Proceed To Payment</button>
							</div>
					  </form>
                </div>
            <?php } ?>
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

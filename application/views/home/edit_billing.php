<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Edit Billing Infomation</h3>
        <form method="POST" action="<?php echo base_url('billing/edit'); ?>">
          <div class="box-border">
            <ul>
              <li class="row">
                <div class="col-sm-6">
                  <label for="first_name" class="required">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="input form-control" name="first_name" id="first_name" value="<?php if (isset($user->first_name)) { echo $user->first_name; } ?>">
                  <?php echo form_error('first_name','<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="col-sm-6">
                  <label for="last_name" class="required">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="input form-control" name="last_name" id="last_name" value="<?php if (isset($user->last_name)) { echo $user->last_name; } ?>">
                  <?php echo form_error('last_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </li>
              <li class="row">
                <div class="col-sm-6">
                  <label for="email_id" class="required">Email Address <span class="text-danger">*</span></label>
                  <input type="text" class="input form-control" name="email_id" id="email_id" value="<?php if (isset($user->email_id)) { echo $user->email_id; } ?>" readonly>
                  <?php echo form_error('email_id','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="phone_number" class="required">Mobile Number <span class="text-danger">*</span></label>
                  <input class="input form-control" type="text" name="phone_number" id="phone_number" value="<?php if (isset($user->phone_number)) { echo $user->phone_number; } ?>" readonly>
                  <?php echo form_error('phone_number','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-xs-4">
                  <label for="address" class="required">Appartment <span class="text-danger">*</span></label>
                  <select class="input form-control" name="appartment" id="apartment" data-block="<?php echo (isset($user->block)) ? $user->block :''; ?>">
                    <option value="">--Select Appartment--</option>
                    <?php if(count($apartment) > 0) { ?>
                      <?php foreach($apartment as $a) { ?>
                        <option value="<?php echo $a->apartment_id; ?>" <?php echo (isset($user->appartment) && ($user->appartment == $a->apartment_id)) ? 'selected' : ''; ?>><?php echo $a->apartment_name; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <?php echo form_error('appartment','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-xs-4">
                  <label for="address" class="required">Block <span class="text-danger">*</span></label>
                  <select class="input form-control" name="block" id="block">
                    <option value="">--Select Block--</option>
                  </select>
                  <?php echo form_error('block','<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="col-xs-4">
                  <label for="address" class="required">Flat/Door no <span class="text-danger">*</span></label>
                  <input type="text" class="input form-control" name="flat_door_no" id="address" value="<?php echo (isset($user->flat_door_no)) ? $user->flat_door_no : ''; ?>">
                  <?php echo form_error('flat_door_no','<div class="text-danger">', '</div>'); ?>
                </div>
              </li><!-- / .row -->
            </ul>
          </div>
          <br>
          <input type="hidden" name="id" value="<?php if (isset($user->id)) { echo $user->id; } ?>">
          <button type="submit" name="" class="btn btn-success pull-right">Update</button>
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
          var block = $(this).data('block');
          $.ajax({
            url:'<?php echo base_url('billing/get_blocks_by_apartment_id'); ?>',
            type:'POST',
            data:{'apartment_id':apartment_id,'block':block},
            success:function(data){
              $('#block').html(data);
            }
          });
        }).trigger('change');
    });
  </script>
</body>
</html>

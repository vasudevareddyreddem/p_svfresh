<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Edit Billing Infomation</h3>
        <form method="POST">
          <div class="box-border">
            <ul>
              <li class="row">
                <div class="col-sm-6">
                  <label for="first_name" class="required">First Name</label>
                  <input type="text" class="input form-control" name="first_name" id="first_name" value="<?php if (isset($billing->first_name)) { echo $billing->first_name; } ?>">
                  <?php echo form_error('first_name','<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="col-sm-6">
                  <label for="last_name" class="required">Last Name</label>
                  <input type="text" name="last_name" class="input form-control" id="last_name" value="<?php if (isset($billing->last_name)) { echo $billing->last_name; } ?>">
                  <?php echo form_error('last_name','<div class="text-danger">', '</div>'); ?>
                </div>
              </li>
              <li class="row">
                <div class="col-sm-6">
                  <label for="email_address" class="required">Email Address</label>
                  <input type="text" class="input form-control" name="email_address" id="email_address" value="<?php if (isset($billing->email_address)) { echo $billing->email_address; } ?>">
                  <?php echo form_error('email_address','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="mobile_number" class="required">Mobile Number</label>
                  <input class="input form-control" type="text" name="mobile_number" id="mobile_number" value="<?php if (isset($billing->mobile_number)) { echo $billing->mobile_number; } ?>">
                  <?php echo form_error('mobile_number','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-xs-4">
                  <label for="address" class="required">Appartment</label>
                  <select class="input form-control" name="appartment">
                    <option value="">--Select Appartment--</option>
                    <option value="1" <?php echo (isset($billing->appartment) && ($billing->appartment == 1)) ? 'selected' : ''; ?>>1</option>
                  </select>
                  <?php echo form_error('appartment','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-xs-4">
                  <label for="address" class="required">Block</label>
                  <select class="input form-control" name="block">
                    <option value="">--Select Block--</option>
                    <option value="1" <?php echo (isset($billing->block) && ($billing->block == 1)) ? 'selected' : ''; ?>>A</option>
                  </select>
                  <?php echo form_error('block','<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="col-xs-4">
                  <label for="address" class="required">Flat/Door no</label>
                  <input type="text" class="input form-control" name="flat_door_no" id="address" value="<?php echo (isset($billing->flat_door_no)) ? $billing->flat_door_no : ''; ?>">
                  <?php echo form_error('flat_door_no','<div class="text-danger">', '</div>'); ?>
                </div>
              </li><!-- / .row -->
            </ul>
          </div>
          <br>
          <input type="hidden" name="id" value="<?php if (isset($billing->id)) { echo $billing->id; } ?>">
          <button type="submit" name="" class="btn btn-success pull-right">Update</button>
        </form>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>
</body>
</html>

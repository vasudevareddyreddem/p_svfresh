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
                  <label for="company_name">Company Name</label>
                  <input type="text" name="company_name" class="input form-control" id="company_name" value="<?php if (isset($billing->company_name)) { echo $billing->company_name; } ?>">
                  <?php echo form_error('company_name','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="email_address" class="required">Email Address</label>
                  <input type="text" class="input form-control" name="email_address" id="email_address" value="<?php if (isset($billing->email_address)) { echo $billing->email_address; } ?>">
                  <?php echo form_error('email_address','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-xs-12">
                  <label for="address" class="required">Address</label>
                  <input type="text" class="input form-control" name="address" id="address" value="<?php if (isset($billing->address)) { echo $billing->address; } ?>">
                  <?php echo form_error('address','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!-- / .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="city" class="required">City</label>
                  <input class="input form-control" type="text" name="city" id="city" value="<?php if (isset($billing->city)) { echo $billing->city; } ?>">
                  <?php echo form_error('city','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label class="required">State/Province</label>
                  <select class="input form-control" name="state">
                    <option value="">--Select State--</option>
                    <option value="Telangana" <?php if (isset($billing->state) && ($billing->state == "Telangana")) { echo 'selected'; } else { echo ''; } ?>>Telangana</option>
                  </select>
                  <?php echo form_error('state','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="postal_code" class="required">Zip/Postal Code</label>
                  <input class="input form-control" type="text" name="zip" id="postal_code" value="<?php if (isset($billing->zip)) { echo $billing->zip; } ?>">
                  <?php echo form_error('zip','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div  class="col-sm-6">
                  <label class="required">Country</label>
                  <select class="input form-control" name="country">
                    <option value="">--Select Country--</option>
                    <option value="India" <?php if (isset($billing->country) && ($billing->country == "India")) { echo 'selected'; } else { echo '';
                    } ?>>India</option>
                  </select>
                  <?php echo form_error('country','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="telephone" class="required">Telephone</label>
                  <input class="input form-control" type="text" name="telephone" id="telephone" value="<?php if (isset($billing->telephone)) { echo $billing->telephone; } ?>">
                  <?php echo form_error('telephone','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="fax">Fax</label>
                  <input class="input form-control" type="text" name="fax" id="fax" value="<?php if (isset($billing->fax)) { echo $billing->fax; } ?>">
                  <?php echo form_error('fax','<div class="text-danger">', '</div>'); ?>
                </div><!--/ [col] -->
              </li><!--/ .row -->
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

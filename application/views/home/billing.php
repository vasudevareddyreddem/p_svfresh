<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Billing Infomation</h3>
        <?php if(count($billing) > 0){ ?>
          <div class="">
            <div class="row">

              <form action="<?php echo base_url('billing/old_delivery_address'); ?>" method="POST">
                <?php $i=1; foreach($billing as $b){ ?>
                  <div class="col-md-3">
                    <div class="box-shadow-site modal-body">
                      <input type="radio" name="billing_id" value="<?php echo $b->id; ?>" <?php echo ($i == 1) ? 'checked':''; ?>>
                      <p><?php echo $b->first_name.' '.$b->last_name; ?>, <?php echo $b->company_name; ?>, <?php echo $b->email_address; ?>,
                        <?php echo $b->address; ?>,<?php echo $b->city; ?>,<?php echo $b->state; ?>,
                        <?php echo $b->country; ?>,<?php echo $b->telephone; ?> - <?php echo $b->fax; ?>.</p>
                        <a href="<?php echo base_url('billing/edit/'.$b->id); ?>" name="edit_billing" class="btn btn-success">Edit</a>
                        <a href="<?php echo base_url('billing/delete/'.$b->id); ?>" name="delete_billing" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                    <?php $i++; } ?>
                    <div class="clearfix">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Proceed For Payment</button>
                  </form>

                </div>
              </div>
            <?php } ?>
            <br>
            <form method="POST" action="<?php echo base_url('/billing'); ?>">
              <div class="box-border">
                <ul>
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="first_name" class="required">First Name</label>
                      <input type="text" class="input form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>">
                      <?php echo form_error('first_name','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                    <div class="col-sm-6">
                      <label for="last_name" class="required">Last Name</label>
                      <input type="text" name="last_name" class="input form-control" id="last_name" value="<?php echo set_value('last_name'); ?>">
                      <?php echo form_error('last_name','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                  </li><!--/ .row -->
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="company_name">Company Name</label>
                      <input type="text" name="company_name" class="input form-control" id="company_name" value="<?php echo set_value('company_name'); ?>">
                      <?php echo form_error('company_name','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                    <div class="col-sm-6">
                      <label for="email_address" class="required">Email Address</label>
                      <input type="text" class="input form-control" name="email_address" id="email_address" value="<?php echo set_value('email_address'); ?>">
                      <?php echo form_error('email_address','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                  </li><!--/ .row -->
                  <li class="row">
                    <div class="col-xs-12">

                      <label for="address" class="required">Address</label>
                      <input type="text" class="input form-control" name="address" id="address" value="<?php echo set_value('address'); ?>">
                      <?php echo form_error('address','<div class="text-danger">', '</div>'); ?>

                    </div><!--/ [col] -->

                  </li><!-- / .row -->

                  <li class="row">

                    <div class="col-sm-6">

                      <label for="city" class="required">City</label>
                      <input class="input form-control" type="text" name="city" id="city" value="<?php echo set_value('city'); ?>">
                      <?php echo form_error('city','<div class="text-danger">', '</div>'); ?>

                    </div><!--/ [col] -->

                    <div class="col-sm-6">
                      <label class="required">State</label>
                      <select class="input form-control" name="state">
                        <option value="">Select State</option>
                        <option value="Telangana" <?php echo (set_value('state') == "Telangana") ? 'selected':''; ?>>Telangana</option>
                      </select>
                      <?php echo form_error('state','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                  </li><!--/ .row -->

                  <li class="row">

                    <div class="col-sm-6">

                      <label for="postal_code" class="required">Zip/Postal Code</label>
                      <input class="input form-control" type="text" name="zip" id="postal_code" value="<?php echo set_value('zip'); ?>">
                      <?php echo form_error('zip','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->

                    <div  class="col-sm-6">
                      <label class="required">Country</label>
                      <select class="input form-control" name="country">
                        <option value="">Select Country</option>
                        <option value="India" <?php echo (set_value('country') == "India") ? 'selected':''; ?>>India</option>
                      </select>
                      <?php echo form_error('country','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->
                  </li><!--/ .row -->
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="telephone" class="required">Telephone</label>
                      <input class="input form-control" type="text" name="telephone" id="telephone" value="<?php echo set_value('telephone'); ?>">
                      <?php echo form_error('telephone','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->

                    <div class="col-sm-6">
                      <label for="fax">Fax</label>
                      <input class="input form-control" type="text" name="fax" id="fax" value="<?php echo set_value('fax'); ?>">
                      <?php echo form_error('fax','<div class="text-danger">', '</div>'); ?>
                    </div><!--/ [col] -->

                  </li>

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
  </body>
  </html>

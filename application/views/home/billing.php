<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Billing Infomation</h3>
        <?php if(count($billing) > 0){ ?>
          <?php foreach($billing as $b){ ?>
            <div>
              <div>
                <ul>
                  <form action="<?php echo base_url('billing/old_delivery_address'); ?>" method="POST">
                    <input type="radio" name="billing_address" value="<?php echo $b->id; ?>" checked>
                    <li><?php echo $b->first_name.' '.$b->last_name; ?></li>
                    <li><?php echo $b->company_name; ?></li>
                    <li><?php echo $b->email_address; ?></li>
                    <li><?php echo $b->address; ?></li>
                    <li><?php echo $b->city; ?></li>
                    <li><?php echo $b->state; ?></li>
                    <li><?php echo $b->country; ?></li>
                    <li><?php echo $b->zip; ?></li>
                    <li><?php echo $b->telephone; ?></li>
                    <li><?php echo $b->fax; ?></li>
                    <button type="submit" class="btn btn-success">Proceed For Payment</button>
                  </form>
                </ul>
              </div>
            </div>
          <?php } ?>
        <?php }else{ ?>
        <br>
        <form method="POST" action="<?php echo base_url('/billing'); ?>">
          <div class="box-border">
            <ul>
              <li class="row">
                <div class="col-sm-6">
                  <label for="first_name" class="required">First Name</label>
                  <input type="text" class="input form-control" name="first_name" id="first_name" value="">
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="last_name" class="required">Last Name</label>
                  <input type="text" name="last_name" class="input form-control" id="last_name" value="">
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="company_name">Company Name</label>
                  <input type="text" name="company_name" class="input form-control" id="company_name" value="">
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="email_address" class="required">Email Address</label>
                  <input type="text" class="input form-control" name="email_address" id="email_address" value="">
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-xs-12">

                  <label for="address" class="required">Address</label>
                  <input type="text" class="input form-control" name="address" id="address" value="">

                </div><!--/ [col] -->

              </li><!-- / .row -->

              <li class="row">

                <div class="col-sm-6">

                  <label for="city" class="required">City</label>
                  <input class="input form-control" type="text" name="city" id="city" value="">

                </div><!--/ [col] -->

                <div class="col-sm-6">
                  <label class="required">State</label>
                  <select class="input form-control" name="state">
                    <option value="">Select State</option>
                    <option value="Telangana">Telangana</option>
                    <!-- <option value="Kansas">Kansas</option> -->
                  </select>
                </div><!--/ [col] -->
              </li><!--/ .row -->

              <li class="row">

                <div class="col-sm-6">

                  <label for="postal_code" class="required">Zip/Postal Code</label>
                  <input class="input form-control" type="text" name="zip" id="postal_code" value="">
                </div><!--/ [col] -->

                <div  class="col-sm-6">
                  <label class="required">Country</label>
                  <select class="input form-control" name="country">
                    <option value="">Select Country</option>
                    <option value="India">India</option>
                    <!-- <option value="Austria">Austria</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Canada">Canada</option> -->
                  </select>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="telephone" class="required">Telephone</label>
                  <input class="input form-control" type="text" name="telephone" id="telephone" value="">
                </div><!--/ [col] -->

                <div class="col-sm-6">
                  <label for="fax">Fax</label>
                  <input class="input form-control" type="text" name="fax" id="fax" value="">
                </div><!--/ [col] -->

              </li>

            </ul>

          </div>
            <div class="pull-right">
              <button type="submit" name="" class="btn btn-success">Proceed For Payment </button>
            </div>
          </div>
        </form>
      <?php } ?>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <h3 class="checkout-sep pd-tb20 h2"> Billing Infomation</h3>
        <form method="POST" action="<?php echo base_url('/billing'); ?>">
          <div class="box-border">
            <ul>
              <li class="row">
                <div class="col-sm-6">
                  <label for="first_name" class="required">First Name</label>
                  <input type="text" class="input form-control" name="first_name" id="first_name" value="<?php if($billing->first_name){ echo $billing->first_name; } ?>">
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="last_name" class="required">Last Name</label>
                  <input type="text" name="last_name" class="input form-control" id="last_name" value="<?php if($billing->last_name){ echo $billing->last_name; } ?>">
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="company_name">Company Name</label>
                  <input type="text" name="company_name" class="input form-control" id="company_name" value="<?php if($billing->company_name){ echo $billing->company_name; } ?>">
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="email_address" class="required">Email Address</label>
                  <input type="text" class="input form-control" name="email_address" id="email_address" value="<?php if($billing->email_address){ echo $billing->email_address;} ?>">
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-xs-12">

                  <label for="address" class="required">Address</label>
                  <input type="text" class="input form-control" name="address" id="address" value="<?php if($billing->address){ echo $billing->address; } ?>">

                </div><!--/ [col] -->

              </li><!-- / .row -->

              <li class="row">

                <div class="col-sm-6">

                  <label for="city" class="required">City</label>
                  <input class="input form-control" type="text" name="city" id="city" value="<?php if($billing->city){ echo $billing->city; } ?>">

                </div><!--/ [col] -->

                <div class="col-sm-6">
                  <label class="required">State</label>
                  <select class="input form-control" name="state">
                    <option value="">Select State</option>
                    <option value="Telangana" <?php if(($billing->state) && ($billing->state) == 'Telangana'){ echo 'selected'; } ?>>Telangana</option>
                    <!-- <option value="Kansas">Kansas</option> -->
                  </select>
                </div><!--/ [col] -->
              </li><!--/ .row -->

              <li class="row">

                <div class="col-sm-6">

                  <label for="postal_code" class="required">Zip/Postal Code</label>
                  <input class="input form-control" type="text" name="zip" id="postal_code" value="<?php if($billing->zip){ echo $billing->zip; } ?>">
                </div><!--/ [col] -->

                <div  class="col-sm-6">
                  <label class="required">Country</label>
                  <select class="input form-control" name="country">
                    <option value="">Select Country</option>
                    <option value="India" <?php if(($billing->country) && ($billing->country) == 'India'){ echo 'selected'; } ?>>India</option>
                    <!-- <option value="Austria">Austria</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Canada">Canada</option> -->
                  </select>
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="telephone" class="required">Telephone</label>
                  <input class="input form-control" type="text" name="telephone" id="telephone" value="<?php if($billing->telephone){ echo $billing->telephone; } ?>">
                </div><!--/ [col] -->

                <div class="col-sm-6">
                  <label for="fax">Fax</label>
                  <input class="input form-control" type="text" name="fax" id="fax" value="<?php if($billing->fax){ echo $billing->fax; } ?>">
                </div><!--/ [col] -->

              </li>

            </ul>

          </div>
          <h3 class="checkout-sep pd-tb20 h2">Shipping Information</h3>
          <div class="box-border">
            <ul>
              <li class="row">
                <div class="col-sm-6">
                  <label for="first_name" class="required">First Name</label>
                  <input type="text" class="input form-control" name="" id="first_name">
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="last_name" class="required">Last Name</label>
                  <input type="text" name="" class="input form-control" id="last_name">
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-sm-6">
                  <label for="company_name">Company Name</label>
                  <input type="text" name="" class="input form-control" id="company_name">
                </div><!--/ [col] -->
                <div class="col-sm-6">
                  <label for="email_address" class="required">Email Address</label>
                  <input type="text" class="input form-control" name="" id="email_address">
                </div><!--/ [col] -->
              </li><!--/ .row -->
              <li class="row">
                <div class="col-xs-6">

                  <label for="address" class="required">Mobile number</label>
                  <input type="text" class="input form-control" name="" id="address">

                </div><!--/ [col] -->
                <div class="col-xs-6">

                  <label for="address" class="required">Address</label>
                  <input type="text" class="input form-control" name="" id="address">

                </div><!--/ [col] -->

              </li><!-- / .row -->

              <li class="row">

                <div class="col-sm-6">

                  <label for="city" class="required">City</label>
                  <input class="input form-control" type="text" name="" id="city">

                </div><!--/ [col] -->

                <div class="col-sm-6">
                  <label class="required">State/Province</label>
                  <select class="input form-control" name="">
                    <option value="Alabama">Alabama</option>
                    <option value="Illinois">Illinois</option>
                    <option value="Kansas">Kansas</option>
                  </select>
                </div><!--/ [col] -->
              </li><!--/ .row -->

              <li class="row">

                <div class="col-sm-6">

                  <label for="postal_code" class="required">Zip/Postal Code</label>
                  <input class="input form-control" type="text" name="" id="postal_code">
                </div><!--/ [col] -->

                <div  class="col-sm-6">
                  <label class="required">Country</label>
                  <select class="input form-control" name="">
                    <option value="USA">USA</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Canada">Canada</option>
                  </select>
                </div><!--/ [col] -->
              </li><!--/ .row -->


            </ul>
            <div class="clearfix">&nbsp;</div>
            <div class="pull-right">
              <button class="btn btn-success">Proceed For Payment </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>
</body>
</html>

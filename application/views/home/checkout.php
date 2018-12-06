<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>

  <div class="columns-container">
    <div class="container" id="columns">
      <!-- breadcrumb -->
      <div class="breadcrumb clearfix">
        <a class="home" href="#" title="Return to Home">Home</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">Checkout</span>
      </div>
      <!-- ./breadcrumb -->
      <!-- page heading-->

      <!-- ../page heading-->
      <div class="page-content checkout-page">

        <h3 class="checkout-sep">Checkout</h3>
        <div class="box-border 	">
          <div class="table-responsive	">
            <table class="table table-bordered  cart_summary">
              <thead>
                <tr>
                  <th class="cart_product">Product</th>
                  <th>Description</th>
                  <!-- <th>Avail.</th> -->
                  <th>Unit price</th>
                  <th style="width:200px;">Qty</th>
                  <th>Total</th>
                  <th  class="action">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td class="cart_product">
                    <a href="#"><img src="assets/data/waterimg1.jpg" alt="Product"></a>
                  </td>
                  <td class="cart_description">
                    <p class="product-name"><a href="#">Frederique Constant </a></p>
                    <small class="cart_ref">SKU : #123654999</small><br>
                    <small><a href="#">Color : Beige</a></small><br>
                    <small><a href="#">Size : S</a></small>
                  </td>
                  <td class="cart_avail"><span class="label label-success">In stock</span></td>
                  <td class="text-center"><span>₹ 61,19 </span></td>
                  <td class="qty">
                    <form class="form-class">
                      <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                      <input type="number" id="number" value="0" />
                      <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                    </form>
                  </td>
                  <td class="text-center">
                    <span>₹ 61,19</span>
                  </td>
                  <td class="text-center">
                    <a href=""> <i class="fa fa-trash-o"></i></a>
                  </td>
                </tr> -->
                <?php if (count($cart) > 0) { ?>
                  <?php foreach ($cart as $c) { ?>
                <tr>
                  <td class="cart_product">
                    <a href="<?php echo base_url('product/'.$c->product_id); ?>"><img src="<?php echo base_url('assets/uploads/product_pics/'.$c->product_img); ?>" alt="Product"></a>
                  </td>
                  <td class="cart_description">
                    <p class="product-name"><a href="#"><?php echo $c->product_name; ?></a></p>
                    <!-- <small class="cart_ref">SKU : #123654999</small><br>
                    <small><a href="#">Color : Beige</a></small><br>
                    <small><a href="#">Size : S</a></small> -->
                  </td>
                  <!-- <td class="cart_avail"><span class="label label-success">In stock</span></td> -->
                  <td class="text-center"><span>₹ <?php echo $c->net_price; ?></span></td>
                  <td class="qty">
                    <form class="form-class">
                      <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                      <input type="number" id="number" value="<?php echo $c->quantity; ?>" />
                      <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                    </form>
                  </td>
                  <td class="text-center">
                    <span>₹ <?php echo ($c->net_price * $c->quantity); ?></span>
                  </td>
                  <td class="text-center">
                    <a href=""> <i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2" rowspan="2"></td>
                  <td colspan="3">Total products (tax incl.)</td>
                  <td colspan="2">₹ 122.38</td>
                </tr>
                <tr>
                  <td colspan="3"><strong>Total</strong></td>
                  <td colspan="2"><strong>₹ 122.38 </strong></td>
                </tr>
              </tfoot>
            </table>
            <a href="billing.php" class="button pull-right">Place Order</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
</body>

</html>

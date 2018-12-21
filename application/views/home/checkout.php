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
                <?php if (count($cart) > 0) { ?>
                  <?php foreach ($cart as $c) { ?>
                <tr>
                  <td class="cart_product">
                    <a href="<?php echo base_url('product/'.$c->product_id); ?>">
                      <?php if (!empty($c->product_img) && file_exists('assets/uploads/product_pics/'.$c->product_img)) { ?>
                        <img src="<?php echo base_url('assets/uploads/product_pics/'.$c->product_img); ?>" alt="Product">
                      <?php } else { ?>
                        <img src="<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>" alt="Product">
                      <?php } ?>
                    </a>
                  </td>
                  <td class="cart_description">
                    <p class="product-name"><a href="#"><?php echo $c->product_name; ?></a></p>
                  </td>
                  <td class="text-center"><span>₹ <?php echo $c->net_price; ?></span></td>
                  <td class="qty">
                    <form class="form-class">
                      <div class="value-button decrease" id="decrease" value="Decrease Value">-</div>
                      <input type="number" class="number" id="number" value="<?php echo $c->quantity; ?>" data-id="<?php echo $c->id; ?>"/>
                      <div class="value-button increase" id="increase" value="Increase Value">+</div>
                    </form>
                  </td>
                  <td class="text-center">
                    <span>₹ <?php echo ($c->net_price * $c->quantity); ?></span>
                  </td>
                  <td class="text-center">
                    <a href="#" class="remove" data-id="<?php echo $c->id; ?>"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              <?php } ?>
            <?php }else{ ?>
              <tr>
                <td colspan="6" style="text-align:center">No items found in cart</td>
              </tr>
            <?php  } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2" rowspan="2"></td>
                  <td colspan="3">Total products (tax incl.)</td>
                  <td colspan="2">₹ <?php if($cart_total->total_cart){ echo $cart_total->total_cart; }else{ echo '0'; } ?></td>
                </tr>
                <tr>
                  <td colspan="3"><strong>Total</strong></td>
                  <td colspan="2"><strong>₹ <?php if($cart_total->total_cart){ echo $cart_total->total_cart; }else{ echo '0'; } ?></strong></td>
                </tr>
              </tfoot>
            </table>
            <?php if(count($cart) > 0){ ?>
              <a href="<?php echo base_url('/billing'); ?>" class="button pull-right back-home-btn">Place Order</a>
            <?php }else{ ?>
              <a href="<?php echo base_url('/home'); ?>" class="button pull-right back-home-btn">Back to Home</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.increase').click(function(){
        var value = parseInt($(this).closest('td.qty').find(".number").val(), 10);
        value = isNaN(value) ? 0 : value;
        value++;
        $(this).closest('td.qty').find(".number").val(value);
      });
      $('.decrease').click(function(){
        var value = parseInt($(this).closest('td.qty').find(".number").val(), 10);
        value = isNaN(value) ? 0 : value;
        value--;
        value = (value <= 0) ? 1 : value;
        $(this).closest('td.qty').find(".number").val(value);
      });
      $('.increase,.decrease').click(function(){
        var quantity = $(this).closest('td.qty').find(".number").val();
        var id = $(this).closest('td.qty').find(".number").data('id');
        $.ajax({
          url:'<?php echo base_url('checkout/update_quantity'); ?>',
          type:'POST',
          data:{'quantity':quantity,'id':id},
          dataType:'JSON',
          success:function(data){
            if(data.success){
              window.location.reload();
            }
          }
        });
      });

      $('.remove').click(function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
          url:'<?php echo base_url('checkout/delete_cart_item'); ?>',
          type:'POST',
          data:{'id':id},
          dataType:'JSON',
          success:function(data){
            if(data.success){
              window.location.reload();
            }
          }
        });
      });
    });
  </script>
</body>

</html>

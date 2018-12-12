<!DOCTYPE html>
<html>
<head>
<?php include("header.php"); ?>

<div class="">
  <div class="container" >

    <div class="page-content checkout-page">
      <h3 class="checkout-sep">Orders List</h3>
      <?php if (count($order) > 0) { ?>
        <?php foreach($order as $o){ ?>
      <div class="panel panel-default ">

        <div class="panel-heading bg-white">
          <span class="btn btn-success border-radius-none"><strong><?php echo $o->order_number; ?></strong></span>
          <span class="btn btn-warning border-radius-none pull-right"> <strong> <i class="fa fa-truck" style="font-size:20px;" aria-hidden="true"></i> Track</strong></span>

        </div>
        <div class="panel-body">
          <table class="table">

            <tbody>

                  <tr >
                    <td class="cart_product" style="border-top:0px solid #fff;">
                      <a href="#"><img style="width:auto;height:80px;" src="<?php echo base_url('assets/uploads/product_pics/'.$o->product_img); ?>" alt="Product"></a>
                    </td>
                    <td colspan="3" style="border-top:0px solid #fff;">
                      <h4 ><a href="#"><?php echo $o->product_name; ?></a></h4>
                    </td>
                    <td style="border-top:0px solid #fff;">
                      <h4 ><a href="#">₹ <?php echo $o->net_price; ?></a></h4>
                    </td>
                    <td style="border-top:0px solid #fff;">
                      <h4 ><a href="#">Delivered on Sat, Nov 3rd 2018</a></h4>
                    </td>
                    <td style="border-top:0px solid #fff;" >
                      <h4 class="pull-right"><a href="#"><span class="btn btn-danger btn-xs border-radius-none "> <strong>  Cancel Order</strong></span> </a></h4>
                    </td>
                  </tr>

            </tbody>

          </table>
        </div>
        <div class="panel-footer">
          <span ><strong>Ordered On <?php echo date('D, M jS Y',strtotime($o->created_date)); ?></strong></span>
          <span class="pull-right" > <strong>  Order Total ₹ <?php echo $o->net_price; ?></strong></span>
        </div>

      </div>
    <?php } ?>
  <?php }else{ ?>
    <div>
      <h4>No orders found.</h4>
    </div>
  <?php } ?>
      <!-- <div class="panel panel-default ">
        <div class="panel-heading bg-white">
          <span class="btn btn-success border-radius-none"><strong>OD113799154347687000</strong></span>
          <span class="btn btn-warning border-radius-none pull-right"> <strong> <i class="fa fa-truck" style="font-size:20px;" aria-hidden="true"></i> Track</strong></span>

        </div>
        <div class="panel-body">
          <table class="table   ">

            <tbody>
              <tr >
                <td class="cart_product" style="border-top:0px solid #fff;">
                  <a href="#"><img style="width:auto;height:80px;" src="assets/data/grocery-img5.jpg" alt="Product"></a>
                </td>
                <td colspan="3" style="border-top:0px solid #fff;">
                  <h4 ><a href="#">Wishper	 </a></h4>
                </td>
                <td style="border-top:0px solid #fff;">
                  <h4 ><a href="#">₹ 30 </a></h4>
                </td>
                <td style="border-top:0px solid #fff;">
                  <h4 ><a href="#">Delivered on Sat, Nov 3rd 2018</a></h4>
                </td>
                <td style="border-top:0px solid #fff;" >
                  <h4 class="pull-right"><a href="#"><span class="btn btn-success btn-xs border-radius-none "> <strong>  Delivered</strong></span> </a></h4>
                </td>



              </tr>

            </tbody>

          </table>
        </div>
        <div class="panel-footer">
          <span ><strong>Ordered On Fri, Nov 2nd 2018</strong></span>
          <span class="pull-right" > <strong>  Order Total ₹11,699</strong></span>
        </div>
      </div>
      <div class="panel panel-default ">
        <div class="panel-heading bg-white">
          <span class="btn btn-success border-radius-none"><strong>OD113799154347687000</strong></span>
          <span class="btn btn-warning border-radius-none pull-right"> <strong> <i class="fa fa-truck" style="font-size:20px;" aria-hidden="true"></i> Track</strong></span>

        </div>
        <div class="panel-body">
          <table class="table   ">

            <tbody>
              <tr >
                <td class="cart_product" style="border-top:0px solid #fff;">
                  <a href="#"><img style="width:auto;height:80px;" src="assets/data/grocery-img1.png" alt="Product"></a>
                </td>
                <td colspan="3" style="border-top:0px solid #fff;">
                  <h4 ><a href="#">Fortune Oil  </a></h4>
                </td>
                <td style="border-top:0px solid #fff;">
                  <h4 ><a href="#">₹ 350 </a></h4>
                </td>
                <td style="border-top:0px solid #fff;">
                  <h4 ><a href="#">Delivered on Sat, Nov 3rd 2018</a></h4>
                </td>
                <td style="border-top:0px solid #fff;" >
                  <h4 class="pull-right"><a href="#"><span class="btn btn-danger btn-xs border-radius-none "> <strong>  Cancel Order</strong></span> </a></h4>
                </td>



              </tr>

            </tbody>

          </table>
        </div>
        <div class="panel-footer">
          <span ><strong>Ordered On Fri, Nov 2nd 2018</strong></span>
          <span class="pull-right" > <strong>  Order Total ₹11,699</strong></span>
        </div>
      </div> -->

    </div>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>

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
                <a href="<?php echo  base_url('order/details/'.base64_encode($o->order_items_id)); ?>"><span class="btn btn-warning border-radius-none pull-right"> <strong> <i class="fa fa-truck" style="font-size:20px;" aria-hidden="true"></i> Track</strong></span></a>

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
                        <?php if($o->order_status == 0){ echo 'Pending'; }elseif ($o->order_status == 1) { echo 'Confirmed'; }?>
                      </td>
                      <td style="border-top:0px solid #fff;" >
                        <h4 class="pull-right"><a href="#" class="cancel_order" data-order_items_id = "<?php echo $o->order_items_id; ?>"><span class="btn btn-danger btn-xs border-radius-none "> <strong>  Cancel Order</strong></span> </a></h4>
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
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.cancel_order').click(function(){
        var order_items_id = $(this).data('order_items_id');
        alert(order_items_id);
        $.ajax({
          url:"<?php echo base_url('order/cancel_order'); ?>",
          type:"POST",
          data:{'order_items_id':order_items_id},
          dataType:'JSON',
          success:function(data){
            if(data.success) {
              $('#message').html('<div class="alert_msg1 animated slideInUp bg-succ">'+data.success+'<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
              setTimeout(function(){
                 window.location.reload();
              },2000);
            } else if (data.error) {
                $('#message').html('<div class="alert_msg1 animated slideInUp bg-del">'+data.error+'<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
                setTimeout(function(){
                   window.location.reload();
                },2000);
            }
          }
        });
      });
    });
  </script>
</body>
</html>

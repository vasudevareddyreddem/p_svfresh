<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker.css'); ?>">

  <div class="columns-container">
    <div class="container" id="columns">
      <!-- breadcrumb -->
      <div class="breadcrumb clearfix">
        <a class="home" href="<?php echo base_url(); ?>" title="Return to Home">Home</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">Milk Orders</span>
      </div>
      <!-- ./breadcrumb -->
      <!-- page heading-->

      <!-- ../page heading-->
      <div class="page-content checkout-page">
        <h3 class="checkout-sep">Milk Orders</h3>
        <form class="" action="<?php echo base_url('order/milk_orders'); ?>" method="post">
          <div class="row">
            <div class="col-md-3">
              <input type="text" class="form-control" id="datepicker" name="date" value="<?php if(isset($filter) && $filter['date'] != ''){ echo $filter['date']; } ?>" placeholder="Pick a date" readonly>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary" name="button">Filter</button>
              <?php if(isset($filter) && $filter['date'] != ''){ ?>
                <a href="<?php echo base_url('order/milk_orders'); ?>" class="btn btn-warning">Clear</a>
              <?php } ?>
            </div>
          </div>
        </form>
        <div class=""> &nbsp; </div>
        <div class="box-border">
          <div class="table-responsive">
            <table class="table table-bordered  cart_summary">
              <thead>
                <tr>
                  <th class="text-center">Product</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($calender_orders) > 0) { ?>
                  <?php foreach ($calender_orders as $co) { ?>
                <tr>
                  <td class="text-center">
                    <?php echo $co->product_name; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $co->date.'-'.$co->month.'-'.$co->year; ?>
                  </td>
                  <td class="text-center">
                    <?php echo ($co->quantity > 1) ? $co->quantity.' Packets' : $co->quantity.' Packet'; ?>
                  </td>
                  <td class="text-center">
                    <?php  echo ($co->price) ? '₹ '.$co->price : ''; ?>
                  </td>
                  <td class="text-center">
                    <?php  if ($co->delivery_status && $co->delivery_status == 1) { echo 'Delivered'; } else if ($co->delivery_status && $co->delivery_status == 2) { echo 'Pending'.' | '.'<a href="#" class="text-danger cancel_order" data-id='.$co->calender_id.'>Cancel</a>'; } else { echo 'Cancelled'; } ?>
                  </td>
                </tr>
              <?php } ?>
            <?php }else{ ?>
              <tr>
                <td colspan="5" style="text-align:center">No items found</td>
              </tr>
            <?php  } ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
              <a href="<?php echo base_url('/home'); ?>" class="button pull-right back-home-btn">Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
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

      $('.cancel_order').click(function(e){
        e.preventDefault();
        var calendar_id = $(this).data('id');
        $.ajax({
          url:'<?php echo base_url('Milkcalender/cancel_order'); ?>',
          type:'POST',
          data:{'calendar_id':calendar_id},
          dataType:'JSON',
          success:function(data){
            if(data.success){
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
      //datepicker
      $('#datepicker').datepicker({
          format: 'd/m/yyyy'
      });
    });
  </script>
</body>

</html>

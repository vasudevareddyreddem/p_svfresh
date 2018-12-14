<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>

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
        <div class="box-border 	">
          <div class="table-responsive	">
            <table class="table table-bordered  cart_summary">
              <thead>
                <tr>
                  <th class="text-center">Product</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Quantity</th>
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
                </tr>
              <?php } ?>
            <?php }else{ ?>
              <tr>
                <td colspan="3" style="text-align:center">No items found</td>
              </tr>
            <?php  } ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
              <a href="<?php echo base_url('/home'); ?>" class="button pull-right">Back to Home</a>
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

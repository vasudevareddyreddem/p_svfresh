<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">

<style>
.cart_summary input{
	border: 1px solid #ddd;
	padding:5px;
}
</style>


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
              <input type="text" class="form-control" id="datepicker" name="fromdate" value="<?php if(isset($filter) && $filter['fromdate'] != ''){ echo $filter['fromdate']; } ?>" placeholder="Pick a Form date" readonly>
            </div>
			<div class="col-md-3">
              <input type="text" class="form-control" id="todatepicker" name="todate" value="<?php if(isset($filter) && $filter['todate'] != ''){ echo $filter['todate']; } ?>" placeholder="Pick a To date" readonly>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary" name="button">Filter</button>
              <?php if(isset($filter) && $filter['fromdate'] != ''){ ?>
                <a href="<?php echo base_url('order/milk_orders'); ?>" class="btn btn-warning">Clear</a>
              <?php } ?>
            </div>
          </div>
        </form>
        <div class=""> &nbsp; </div>
        <div class="box-border">
          <div class="table-responsive">
            <table id="example" class="table table-bordered  cart_summary">
              <thead>
                <tr>
                  <th class="text-center">Product</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Quantity in packets</th>
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
                    <input type="text" name="order_qty" id="order_qty" onkeyup="update_qty(this.value,'<?php echo $co->calender_id; ?>');" value="<?php echo ($co->quantity > 1) ? $co->quantity: $co->quantity; ?>" >
                  </td>
                  <td class="text-center">
                    <?php  echo ($co->price) ? '₹ '.$co->price : ''; ?>
                  </td>
                  <td class="text-center">
                    <?php  if ($co->delivery_status && $co->delivery_status == 1) { echo 'Delivered'; } else if ($co->delivery_status && $co->delivery_status == 2) { echo 'Pending'.' | '.'<a href="#" class="text-danger cancel_order" data-id='.$co->calender_id.'>Cancel</a>'; } else { echo 'Cancelled'; } ?>
					<?php if($co->payment_status==0){ ?>
						<a href="javascript:void(0)" onclick="get_payment('<?php echo $co->calender_id; ?>','<?php echo $co->price; ?>');" class="btn btn-info" data-toggle="modal" data-target="#myModal">Pay</a>
					<?php } ?>
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
              <form class="" action="" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="datepicker1" name="p_f_t" placeholder="from date">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="todatepicker1" name="p_t_t" placeholder="to date">
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0);" onclick="get_payemt_val()" type="button" class="btn btn-info">Pay</a>
                    </div>
                </div>
              </form>
              <a href="<?php echo base_url('/home'); ?>" class="button pull-right back-home-btn">Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form method="POST" action="<?php echo base_url('order/adding_payment_method'); ?>" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payable Amount</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
                <input type="text" class="form-control" name="pay_amt" id="pay_amt" value="" placeholder="Amount" required>
                <input type="hidden" name="c_ids" id="c_ids" value="">
                <input type="hidden" name="all_c_ids" id="all_c_ids" value="">
              </div>
              <div class="form-group">
                <input type="file" class="form-control" name="image" required>
              </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <?php include("footer.php"); ?>
  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
   <script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
  function get_payment(c_id,amount){
	 $('#pay_amt').val(amount);
	 $('#c_ids').val(c_id);
	  
  }
  function get_payemt_val(){
	  if($('#datepicker1').val()=='' || $('#todatepicker1').val()==''){
		alert('Please select dates'); return false; 
	  }
	 jQuery.ajax({
			url: "<?php echo base_url('order/get_payments_inbetween_dates');?>",
			data: {
				f_date:$('#datepicker1').val(),
				t_date:$('#todatepicker1').val(),
			},
			dataType: 'json',
			type: 'POST',
			success: function (data) {
					if(data.msg==1){
						 $('#myModal').modal('show')
						 $('#pay_amt').val(data.amt);
						 $('#all_c_ids').val(data.c_ids);
					}else{
						$('#pay_amt').val('');
						 $('#all_c_ids').val('');
					    $('#message').html('<div class="alert_msg1 animated slideInUp bg-del">Techincal proble occured. Please try again<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
					}
			}
   	}); 
  }
 $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
  function update_qty(qty,id){
	 jQuery.ajax({
			url: "<?php echo base_url('order/update_qty');?>",
			data: {
				c_id: id,
				c_qty: qty,
			},
			dataType: 'json',
			type: 'POST',
			success: function (data) {
					if(data.msg==1){
						 $('#message').html('<div class="alert_msg1 animated slideInUp bg-succ">Quantity Successfully updated<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
					}else{
					    $('#message').html('<div class="alert_msg1 animated slideInUp bg-del">Techincal proble occured. Please try again<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
					}
			}
   	});
}
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
          format: 'd-m-yyyy',
		  autoclose: true
      });
	   $('#todatepicker').datepicker({
          format: 'd-m-yyyy',
		  autoclose: true
      });
	  $('#datepicker1').datepicker({
          format: 'd-m-yyyy',
		  autoclose: true
      });
	   $('#todatepicker1').datepicker({
          format: 'd-m-yyyy',
		  autoclose: true
      });
    });
  </script>
</body>

</html>

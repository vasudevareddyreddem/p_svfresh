<!DOCTYPE html>
<html>
<head>
	<?php include("header.php"); ?>
	<style>
	th{
		text-align:center;
		background:#f5f5f5;
	}
	.form-control {
		padding:1px !important;
		text-align:center !important;
	}

	td { width: 20%; }
</style>
<div style="background:#f5f5f5;" >
	<div class="columns-container count-bac-img" >
		<div class="container-fluid" id="columns">
			<div class="row py-3">
				<div class="col-md-12 col-xs-12 ">
					<div class="card bg-white">
						<div class="card-header  py-4 px-4 text-white" style="background:#57bb14;">
							<div class="row">
								<div class="col-md-7">
									<strong class="h3"><span><?php if (isset($product_name->product_name)) { echo ucwords($product_name->product_name); } ?></span></strong>
								</div>
								<div class="col-md-2">
									<select class="form-control" id="months">
										<?php for ($i = 1; $i <= 12; $i++) { ?>
											<option value="<?php echo date('n',mktime(0,0,0,$i,1)); ?>" <?php echo (date('n',strtotime('+1day')) == date('n',mktime(0,0,0,$i,date("j",strtotime('+1day'))))) ? 'selected' : ''; ?>><?php echo date('F',mktime(0,0,0,$i,1)); ?></option>
										<?php } ?>
									</select>
									<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
								</div>
								<div class="col-md-2">
									<select class="form-control" id="frequency">
										<option value="1">Daily</option>
										<option value="2">Weekend</option>
										<option value="3">Alternate</option>
									</select>
								</div>
								<div class="col-md-1">
									<input type="text" class="form-control" id="quantity" name="" value="" placeholder="Qty">
								</div>
							</div>
						</div>
						<div class="card-body py-4 px-4">
							<form method="POST" action="<?php echo base_url('Milkcalender/insert_calender'); ?>">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="h4">Date</th>
												<th class="h4">Packets</th>
												<th class="h4">Date</th>
												<th class="h4">Packets</th>
												<th class="h4">Date</th>
												<th class="h4">Packets</th>
												<th class="h4">Date</th>
												<th class="h4">Packets</th>
												<th class="h4">Date</th>
												<th class="h4">Packets</th>
											</tr>
										</thead>
										<tbody id="calender_template">
										</tbody>
									</table>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-primary btn-sm">Click here for Booking </button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
<script>

$(document).ready(function(){
	$('#months').change(get_calender).trigger('change');
	$('#frequency').change(get_calender).trigger('change');
	//quantity
	$('#quantity').on('keyup',function(){
		$('.input-number').val($(this).val());
	});
});

function get_calender() {
	var month = $('#months').val();
	var frequency = $('#frequency').val();
	var product_id = $('#product_id').val();
	$.ajax({
		url:'<?php echo base_url('Milkcalender/month_calender'); ?>',
		type:'POST',
		data:{'month':month,'product_id':product_id,'frequency':frequency},
		dataType:'JSON',
		success:function(data){
			$('#calender_template').empty();
			$('#calender_template').html(data.calender_template);
		}
	});
}

</script>
</body>
</html>

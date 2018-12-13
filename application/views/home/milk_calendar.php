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
							<div class="col-md-9">
								<strong class="h3">March (<span>Heritage Milk</span>)</strong>
							</div>
							<div class="col-md-3">
								<select class="form-control months">
									<?php for ($i = 0; $i < 12; $i++) { ?>
										<option value="<?php echo date('n',mktime(0,0,0,$i,1)); ?>"><?php echo date('F',mktime(0,0,0,$i,1)); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="card-body py-4 px-4">
						<form>
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
								  <tbody>
										<tr id="calender_template"></tr>
									<!-- <tr>
									  <th class="h4">6</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[6]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[6]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[6]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">7</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[7]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[7]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[7]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">8</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[8]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[8]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[8]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">9</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[9]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[9]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[9]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									  <th class="h4">10</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[10]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[10]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[10]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									</tr>
									<tr>
									  <th class="h4">11</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[11]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[11]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[11]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">12</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[12]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[12]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[12]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">13</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[13]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[13]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[13]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">14</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[14]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[14]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[14]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									  <th class="h4">15</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[15]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[15]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[15]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									</tr>
									<tr>
									  <th class="h4">16</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[16]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[16]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[16]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">17</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[17]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[17]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[17]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">18</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[18]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[18]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[18]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">19</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[19]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[19]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[19]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									  <th class="h4">20</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[20]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[20]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[20]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									</tr>
									<tr>
									  <th class="h4">21</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[21]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[21]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[21]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">22</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[22]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[22]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[22]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">23</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[23]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[23]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[23]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">24</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[24]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[24]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[24]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									  <th class="h4">25</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[25]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[25]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[25]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									</tr>
									<tr>
									  <th class="h4">26</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[26]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[26]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[26]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">27</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[27]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[27]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[27]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">28</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[28]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[28]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[28]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>

									  <th class="h4">29</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[29]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[29]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[29]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									  <th class="h4">30</th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[30]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[30]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[30]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									</tr> -->

								  </tbody>
								</table>
							</div>
							<div class="text-center">
								<button class="btn btn-primary btn-sm">Click here for Booking </button>
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

$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
		$(document).ready(function(){
			$('.months').on('change',function(){
				var month = $(this).val();
				$.ajax({
					url:'<?php echo base_url('Milkcalender/month_calender'); ?>',
					type:'POST',
					data:{'month':month},
					dataType:'JSON',
					success:function(data){
						$('#calender_template').html(data.calender_template);
					}
				});
			});
		});
</script>
</body>
</html>

<?php echo count($days); if(count($days) > 0){ ?>
  <?php foreach($days as $list) {

//echo '<pre>';print_r($list);exit;
  ?>
    
    <tr>
									  <?php if(isset($list[0]) && $list[0]!=''){ ?>
									  <th class="h4"><?php echo isset($list[0])?$list[0]:''; ?></th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[1]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[1]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[1]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									 <?php } ?>
									  <?php if(isset($list[1]) && $list[1]!=''){ ?>
									  <th class="h4"><?php echo  isset($list[1])?$list[1]:''; ?></th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[2]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									 <?php } ?>
									  <?php if(isset($list[2]) && $list[2]!=''){ ?>
									  <th class="h4"><?php echo isset($list[2])?$list[2]:''; ?></th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[3]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[3]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[3]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									 <?php } ?>
									  <?php if(isset($list[3]) && $list[3]!=''){ ?>
									  <th class="h4"><?php echo isset($list[3])?$list[3]:''; ?></th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[4]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[4]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[4]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									  <?php } ?>
									  <?php if(isset($list[4]) && $list[4]!=''){ ?>
									  <th class="h4"><?php echo isset($list[4])?$list[4]:''; ?></th>
									  <td >
										<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[5]">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quant[5]" class="form-control input-number" value="0" min="0" max="100">
										  <span class="input-group-btn">
											  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[5]">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									  </div>
									  </td>
									<?php } ?>
									</tr>

  <?php } ?>
<?php } ?>


<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Product</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Products List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Name</th>
                                            <th>Sub-Category Name</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Actual Price</th>
                                            <th>Discount Price</th>
                                            <th>Net Price</th>
                                            <th>Created At</th>
											<th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($status==1){
										$count=1;
										foreach($product_list as $product):?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $product->product_name;?></td>
                                            <td><?php echo $product->cat_name;?></td>
                                            <td><?php echo $product->subcat_name;?></td>
                                            <td><?php echo $product->quantity;?></td>
                                            <td><?php echo $product->actual_price;?></td>
                                            <td><?php echo $product->discount_price;?></td>
                                            <td><?php echo $product->net_price;?></td>
                                            <td><?php echo $product->created_at;?></td>
											<td><?php if($product->status==1){?>
										        <div class="badge badge-success"><a href="<?php 
												echo base_url('product/inactive_product/').base64_encode($product->product_id);?>">Active</a></div>
											<?php }else{?>
											<div class="badge badge-danger"><a href="<?php 
										echo base_url('product/active_product/').base64_encode($product->product_id);?>">InActive</a></div>
											<?php }?></td>
                                            <td>
                                                <a href="<?php 
												echo base_url('product/edit_product/').base64_encode($product->product_id);
												?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" data-original-title="Edit"><i class="ion ion-edit"></i></a>
                                                <a href="<?php 
												echo base_url('product/delete_product/').base64_encode($product->product_id);
												?>"class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="ion ion-trash-b"></i></a>
                                            </td>
                                        </tr>
									<?php endforeach;}?>
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


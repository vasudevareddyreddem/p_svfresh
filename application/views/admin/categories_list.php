

<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Category</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Categories List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Category Name</th>
											 <th>Category Image</th>
											  <th>Category Small Image</th>
											  <th>Category Left Header Image</th>
											   <th>Category Right Header Image</th>
											    <th>Category Discount Image</th>
											  <th>Created At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php  if($cstatus==1){
										         $count=1;
										          foreach($cat_list as $cat):?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $cat->cat_name; ?></td>
                                            <td><?php if($cat->cat_img==''){echo 'NO Image';}else{ ?><img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto">
											<?php }?>
											</td>
											<td><?php if($cat->cat_small_img==''){echo 'NO Image';}else{ ?><img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_small_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto">
											<?php }?>
											</td>
											 <td>
											 <?php if($cat->cat_lh_img==''){echo 'NO Image';}else{ ?><img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_lh_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto">
												<?php }?>
											</td>
											 <td>
											 <?php if($cat->cat_rh_img==''){echo 'NO Image';}else{ ?><img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_rh_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto">
												<?php }?>
											</td>
											 <td>
											 <?php if($cat->cat_dis_img==''){echo 'NO Image';}else{ ?><img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_dis_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto">
												<?php }?>
											</td>
                                            <td><?php echo $cat->created_at; ?></td>
											<td>
											<?php if($cat->status==1){?>
										        <div class="badge badge-success"><a href="<?php 
												echo base_url('category/inactive_category/').base64_encode($cat->cat_id);?>">Active</a></div>
											<?php }else{?>
											<div class="badge badge-danger"><a href="<?php 
												echo base_url('category/active_category/').base64_encode($cat->cat_id);?>">InActive</a></div>
											<?php }?>
											
                                            </td>
                                            <td>
                                                <a href="<?php 
												echo base_url('category/edit_category/').base64_encode($cat->cat_id);?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" data-original-title="Edit"><i class="ion ion-edit"></i></a>
                                                <a href="<?php 
												echo base_url('category/delete_category/').base64_encode($cat->cat_id);?>" class="btn btn-danger btn-action confirmation" data-toggle="tooltip" data-original-title="Delete"><i class="ion ion-trash-b "></i></a>
                                            </td>
                                        </tr>
										<?php $count++;
									endforeach;}?>
                                       
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
<script type="text/javascript">
$(document).ready(function(){
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
});
</script>


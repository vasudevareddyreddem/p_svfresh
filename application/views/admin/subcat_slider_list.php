
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Sub Category</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sub-Categories  Slider Images List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                          
                                            <th>Sub-Category Name</th>
											<th>Sub-Category Slider Image</th>
                                           
                                            <th>Created At</th>
                                         
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($slider_status==1){
										$count=1;
										foreach($slider_list as $subcat):?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                         
                                            <td><?php echo $subcat->subcat_name;?></td>
											<td>
											<img alt="image" 
											src="<?php echo base_url('assets/uploads/sub_category_pics/').$subcat->image_path; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto">
											
											</td>
                                        
                                            <td><?php 
											if($subcat->created_at!=''){
												
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $subcat->created_at);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');
											echo $newDateString ;
											}?></td>
                                           
                                            <td>
                                                <a href="<?php echo base_url('category/edit_subcat_slider/').base64_encode($subcat->id); ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" data-original-title="Edit"><i class="ion ion-edit"></i></a>
                                                <a href="<?php echo base_url('category/delete_subcat_slider/').base64_encode($subcat->id); ?>" class="btn btn-danger btn-action confirmation" data-toggle="tooltip" data-original-title="Delete"><i class="ion ion-trash-b "></i></a>
                                            </td>
                                        </tr>
									<?php $count++; endforeach;}?>
                                        
                                      
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
        return confirm('Are you sure of deleting Subcategory Slider?');
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>


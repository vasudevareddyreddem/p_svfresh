
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Slider </div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Slider List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Slider Name</th>
                                          
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($status==1){
										$count=1;
										foreach($slider_list as $slider):?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $slider->slider_name;?></td>
                                            <td><?php	if($slider->created_at!=''){
												
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $slider->created_at);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');
											echo $newDateString ;
											}
											?></td>
                                            <td>
											<?php if($slider->status==1){?>
										        <div class="badge badge-success"><a  class='text-white' href="<?php
												echo base_url('slider/inactive_slider/').base64_encode($slider->slider_id);?>">Active</a></div>
											<?php }if($slider->status==2){?>
											<div class="badge badge-danger"><a  class='text-white' href="<?php
												echo base_url('slider/active_slider/').base64_encode($slider->slider_id);?>">InActive</a></div>
											<?php }?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('slider/edit_slider/').base64_encode($slider->slider_id); ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" data-original-title="Edit"><i class="ion ion-edit"></i></a>
                                                <a href="<?php echo base_url('slider/delete_slider/').base64_encode($slider->slider_id); ?>" class="btn btn-danger btn-action confirmation" data-toggle="tooltip" data-original-title="Delete"><i class="ion ion-trash-b  "></i></a>
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
        return confirm('Are you sure of deleting Slider?');
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>



<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Apartment</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Apartment List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Apartment Name</th>

                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  if($status==1){
                                        $count=1;
                                        foreach($list as $li):?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $li->apartment_name; ?></td>


                                                <td><?php
                                                    if($li->created_date!=''){

                                                        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $li->created_date);
                                                        $newDateString = $myDateTime->format('d-m-Y H:i:s');
                                                        echo $newDateString ;
                                                    } ?></td>
                                                <td>
                                                    <?php if($li->status==1){?>
                                                        <div class="badge badge-success"><a class='text-white' href="<?php
                                                            echo base_url('apartment/inactive_apartment/').base64_encode($li->apartment_id);?>">Active</a></div>
                                                    <?php }else{?>
                                                        <div class="badge badge-danger"><a  class='text-white' href="<?php
                                                            echo base_url('apartment/active_apartment/').base64_encode($li->apartment_id);?>">InActive</a></div>
                                                    <?php }?>

                                                </td>
                                                <td>
                                                    <a href="<?php
                                                    echo base_url('apartment/edit_apartment/').base64_encode($li->apartment_id);?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" data-original-title="Edit"><i class="ion ion-edit"></i></a>
                                                    <a href="<?php
                                                    echo base_url('apartment/delete_apartment/').base64_encode($li->apartment_id);?>" class="btn btn-danger btn-action confirmation" data-toggle="tooltip" data-original-title="Delete"><i class="ion ion-trash-b "></i></a>
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
            return confirm('Are you sure of deleting category?');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>



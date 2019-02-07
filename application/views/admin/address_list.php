

<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Users</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Address List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Mobile Number</th>
                                        <th>Billing Address</th>
                                        <th>Created Date</th>


                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  if($status==1){
                                        $count=1;
                                        foreach($alist as $li):?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $li->user_name; ?></td>
                                                <td><?php echo $li->email_id; ?></td>
                                                <td><?php echo $li->phone_number; ?></td>
                                                <td>
                                                  Apartment Name: <?php echo $li->apartment_name; ?>
                                                  <br>Block:<?php echo $li->block_name;?>
                                             <br>Flat No:<?php echo $li->flat_door_no;?><br>
                                            
                                                </td>


                                                <td><?php
                                                    if($li->created_date!=''){

                                                        $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $li->created_date);
                                                        $newDateString = $myDateTime->format('d-m-Y H:i:s');
                                                        echo $newDateString ;
                                                    } ?></td>

                                                <td>
                                                    <a href="<?php
                                                    echo base_url('user/edit_address/').base64_encode($li->id);?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" data-original-title="Edit"><i class="ion ion-edit"></i></a>
                                                    <a href="<?php
                                                    echo base_url('user/delete_address/').base64_encode($li->id);?>" class="btn btn-danger btn-action confirmation" data-toggle="tooltip" data-original-title="Delete"><i class="ion ion-trash-b "></i></a>
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
            return confirm('Are you sure of deleting Address?');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>



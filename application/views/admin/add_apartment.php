

<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Apartment</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Apartment</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_apartment" action="<?php echo base_url('apartment/save_apartment');?>"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Apartment Name</label>
                                            <input id="name" type="text" class="form-control" name="apartment_name">
                                        </div>

<div>  <label>Uncheck the box for adding Bank Account Number</label><input   id='net' class="form-control" type='checkbox'   value='checkbank' name='checkbank' checked></div>
             <div  id='addmain'>
                   <div id='bacc'>
                  <!-- <div  id='bankcheck'>  <label>Check the box for adding Bank Account Number</label><input type='checkbox' disabled></div> -->
                     <div class="form-group">
                        <label>Add Account Number</label>
                        <input id="acc" type="text" class="form-control" name="acc" disabled>
                    </div>
                    <div class="form-group">
                       <label>Add Account Name</label>
                       <input id="accname" type="text" class="form-control" name="accname" disabled>
                   </div>
                    <div class="form-group">
                        <label>Add IFSC Code</label>
                        <input id="ifsc" type="text" class="form-control" name="ifsc" disabled>
                    </div>
                   </div>
                   <!-- <div id='upi'> -->
                     <!-- <div  id='upicheck'>  <label>check the box for adding UPI Number</label><input type='checkbox' disabled></div> -->
                     <div class="form-group">
                         <label>Add UPI Code</label>
                         <input id="upi" type="text" class="form-control" name="upi" disabled>
                     </div>
                   <!-- </div> -->
                   </div>

                                        <button type="submit" class="btn btn-primary">
                                            Add
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('#add_apartment').bootstrapValidator({

            fields: {
                apartment_name: {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        },
                        regexp: {
                            regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
                            message:'Question wont allow <> [] = % '
                        }
                    }
                },
                acc: {
                    validators: {

                      regexp: {
                          regexp: /^[0-9]+$/,
                          message: 'Account Number have only numbers'
                      }
                    }
                },



            }
        })

    });

</script>
<script>
$('#net').click(function(){


  if (this.checked) {

      $('#acc').attr('disabled', 'disabled');
        $('#accname').attr('disabled', 'disabled');
        $('#ifsc').attr('disabled', 'disabled');
          $('#upi').attr('disabled', 'disabled');


  } else {


      $('#acc').removeAttr('disabled');
        $('#ifsc').removeAttr('disabled');
    $('#accname').removeAttr('disabled');
            $('#upi').removeAttr('disabled');

  }


});
</script>

<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <div class="modal-dialog">
          <div class="modal-content box-shadow-site">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Payments Type</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="container">
                  <form action="<?php echo base_url('paymentstype'); ?>" method="POST">
                      <input type="radio" name="payment_type" value="1">Cash on delivery
                      <br>
                      <input type="radio" name="payment_type" value="2">Swipe on delivery
                      <br>
                      <input type="radio" name="payment_type" value="3">Pay Online
                      <br>
                      <?php echo form_error('payment_type','<div class="text-danger">', '</div>'); ?>
                      <button type="submit" class="btn btn-success" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div id="sucessmsg">
  </div> -->
</div>
<?php include("footer.php"); ?>
</body>
</html>

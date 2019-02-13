<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="icon" href="<?php base_url('assets/images/fav.png'); ?>" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/font-awesome/css/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/select2/css/select2.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/jquery.bxslider/jquery.bxslider.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/owl.carousel/owl.carousel.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/jquery-ui/jquery-ui.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/u-style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sweetalert.min.css'); ?>">
    <title>SV Fresh | <?php echo $pageTitle; ?></title>
  </head>
  <body class="home">
    <div class="columns-container">
      <div class="container" id="columns">
        <div class="row">
          <div class="modal-dialog">
            <div class="modal-content box-shadow-site">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Forgot password</h4>
                <a href="<?php echo base_url('home'); ?>">Back to home</a>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <?php if($this->session->flashdata('success')): ?>
                      <div class="alert_msg1 animated slideInUp bg-succ">
                        <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i> </div>
                      <?php endif; ?>
                      <?php if($this->session->flashdata('error')): ?>
                        <div class="alert_msg1 animated slideInUp bg-warn">
                          <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i> </div>
                        <?php endif; ?>
                        <div class="well">
                          <form id="" method="POST" action="<?php echo base_url('home/fpassword'); ?>" novalidate="novalidate">
                            <div class="form-group">
                              <label for="phone_number" class="control-label">Phone number <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo set_value('phone_number'); ?>" placeholder="Enter phone number">
                              <?php echo form_error('phone_number','<div class="text-danger">', '</div>'); ?>
                              <span class="help-block"></span>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                          </form>
                        </div>
                      </div>
                      <!-- <div class="col-xs-12 col-md-6">
                        <p class="lead">Register now for <span class="text-success">FREE</span></p>
                        <ul class="list-unstyled register-free-points" style="line-height:28px">
                          <li><span class="fa fa-check text-success"></span> See all your orders</li>
                          <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                          <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                          <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                          <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>

                        </ul>
                        <div class="clearfix">&nbsp;</div>
                        <p><a href="<?php echo base_url('/register'); ?>" class="btn btn-info btn-block">Yes please, register now!</a></p>
                      </div> -->
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery/jquery-1.11.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/select2/js/select2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.bxslider/jquery.bxslider.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.countdown/jquery.countdown.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.elevatezoom.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/fancyBox/jquery.fancybox.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.actual.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/theme-script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>
<script type="text/javascript">

</script>
</body>
</html>

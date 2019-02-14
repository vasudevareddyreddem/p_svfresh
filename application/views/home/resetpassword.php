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
                <h4 class="modal-title" id="myModalLabel">Reset password <a href="<?php echo base_url('home'); ?>" class="pull-right btn btn-xs btn-primary">Back to home</a></h4>
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
                          <form id="" method="POST" action="<?php echo base_url('home/rpassword'); ?>" novalidate="novalidate">
                            <div class="form-group">
                              <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Enter Password">
                              <?php echo form_error('password','<div class="text-danger">', '</div>'); ?>
                              <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                              <label for="confirm_password" class="control-label">Confirm Password <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>" placeholder="Enter Confirm Password">
                              <?php echo form_error('confirm_password','<div class="text-danger">', '</div>'); ?>
                              <span class="help-block"></span>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $this->session->userdata('userid'); ?>">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                          </form>
                        </div>
                      </div>
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

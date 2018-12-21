<!DOCTYPE html>
<html>
<head>
<?php include("header.php"); ?>
<div class="columns-container">
  <div class="container" id="columns">
    <div class="row">
      <div class=" col-xs-12 col-sm-12" id="center_column">
		<div class="col-md-12">
			<h2 class="page-heading">
			  <span class="page-heading-title"><?php echo ucwords($category->cat_name); ?></span>
			</h2>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="col-md-12">
			<?php if (count($sub_categories) > 0) { ?>
                <?php foreach ($sub_categories as $sc) { ?>
                  <div class=" col-md-3 sub-list-view">
                    <a href="<?php echo base_url('products/'.$sc->subcat_id); ?>">
					<div class="">
						<?php echo $sc->subcat_name; ?>
					</div></a>
                  </div>
                <?php } ?>
				  <?php }else{ ?>
                <div><h2>No sub categories found<h2></div>
              <?php } ?>
		</div>
		
       <!-- <ul class=" dropdown-menu-large row">
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Sub Category</li>
              <?php if (count($sub_categories) > 0) { ?>
                <?php foreach ($sub_categories as $sc) { ?>
                  <li class=" group_header">
                    <a href="<?php echo base_url('products/'.$sc->subcat_id); ?>"><?php echo $sc->subcat_name; ?></a>
                  </li>
                <?php } ?>
              <?php }else{ ?>
                <li><h2>No sub categories found<h2></li>
              <?php } ?>
              
            </ul>
          </li>
          
        </ul>-->
      </li>
    </ul>
  </div>
  <!-- ./ Center colunm -->
</div>
<!-- ./row-->
</div>
</div>
<div class="clerfix">&nbsp;</div>
<div class="clerfix">&nbsp;</div>
<?php include("footer.php"); ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<?php include("header.php"); ?>
<div class="columns-container">
  <div class="container" id="columns">
    <div class="row">
      <div class=" col-xs-12 col-sm-12" id="center_column">
        <h2 class="page-heading">
          <span class="page-heading-title"><?php echo ucwords($category->cat_name); ?></span>
        </h2>
        <ul class=" dropdown-menu-large row">
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
              <!-- <li class="">
                <a href="#">Frozen Corn</a>
              </li>
              <li class="">
                <a href="#">Greenpeas</a>
              </li>
              <li class="">
                <a href="#">Green Gram</a>
              </li> -->
            </ul>
          </li>
          <!-- <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Sub Category</li>
              <li class=" group_header">
                <a href="#">Pulses</a>
              </li>
              <li class="">
                <a href="#">Frozen Corn</a>
              </li>
              <li class="">
                <a href="#">Greenpeas</a>
              </li>
              <li class="">
                <a href="#">Green Gram</a>
              </li>
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Sub Category</li>
              <li class=" group_header">
                <a href="#">Pulses</a>
              </li>
              <li class="">
                <a href="#">Frozen Corn</a>
              </li>
              <li class="">
                <a href="#">Greenpeas</a>
              </li>
              <li class="">
                <a href="#">Green Gram</a>
              </li>
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Sub Category</li>
              <li class=" group_header">
                <a href="#">Pulses</a>
              </li>
              <li class="">
                <a href="#">Frozen Corn</a>
              </li>
              <li class="">
                <a href="#">Greenpeas</a>
              </li>
              <li class="">
                <a href="#">Green Gram</a>
              </li>
            </ul>
          </li> -->
        </ul>
      </li>
    </ul>
  </div>
  <!-- ./ Center colunm -->
</div>
<!-- ./row-->
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>

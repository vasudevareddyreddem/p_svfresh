<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <div class=" col-xs-12 col-sm-12" id="center_column">
          <h2 class="page-heading">
            <span class="page-heading-title"><?php echo ucwords($category->cat_name); ?></span>
          </h2>
        </div>
      </div>
      <div class="row py-3">
        <?php if (count($sub_categories) > 0) { ?>
          <?php foreach ($sub_categories as $sc) { ?>
            <a href="<?php echo base_url('products/'.$sc->subcat_id); ?>">
              <div class="col-xs-6 col-md-2 ">
                <div class="category-bg" style="margin:0 auto;" >
                  <?php if (!empty($sc->subcat_img) && file_exists('assets/uploads/sub_category_pics/'.$sc->subcat_img)) { ?>
                    <img class="img-resonsive" src="<?php echo base_url('assets/uploads/sub_category_pics/'.$sc->subcat_img); ?>" alt="<?php echo $sc->subcat_name; ?>"/>
                  <?php } else { ?>
                    <img src="<?php echo base_url('assets/uploads/category_pics/no-image.png'); ?>" alt="no image">
                  <?php } ?>
                </div>
                <div class="text-center font-cat"><?php echo $sc->subcat_name; ?></div>
              </div>
            </a>
          <?php } ?>
        <?php } else { ?>
          <div><h2>No sub categories found<h2></div>
        <?php } ?>
        </div>
      </div>
    </div>
    <?php include("footer.php"); ?>
  </body>
  </html>

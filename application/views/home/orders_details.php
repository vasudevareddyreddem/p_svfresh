<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>

  <div class="">
    <div class="container" >

     <div class="page-content checkout-page col-md-6 col-md-offset-3">
        <h3 class="checkout-sep">Rateing</h3>
                              <div class="panel panel-default ">

              <div class="panel-heading bg-white">
                <span class="btn btn-success border-radius-none"><strong>SV0201812128</strong></span>

              </div>
              <div class="panel-body">
			  <div class="col-md-4">
				<img class="img-responsive" src="http://localhost/p_svfresh/assets/uploads/product_pics/fruits-img3.png" alt="Product">
			  </div>
			  <div class="col-md-8">
				<h3>gauva</h3>
				<h4 class="py-2">₹ 44</h4>
				<h4 class="py-2">Delivered on Sat, Nov 3rd 2018</h4>



			  </div>
                
              </div>
              <div class="panel-footer">
                  <div class="row lead text-center">
						<div style="color:#fd4f00" id="stars" class="starrr"></div>
						You gave a rating of <span id="count">0</span> star(s)
					</div>
              </div>

            </div>
        </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
  <script type="text/javascript">
		// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
    $('#count').html(value);
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
    $('#count-existing').html(value);
  });
});
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.cancel_order').click(function(){
        var order_items_id = $(this).data('order_items_id');
        alert(order_items_id);
        $.ajax({
          url:"<?php echo base_url('order/cancel_order'); ?>",
          type:"POST",
          data:{'order_items_id':order_items_id},
          dataType:'JSON',
          success:function(data){
            if(data.success) {
              $('#message').html('<div class="alert_msg1 animated slideInUp bg-succ">'+data.success+'<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
              setTimeout(function(){
                 window.location.reload();
              },2000);
            } else if (data.error) {
                $('#message').html('<div class="alert_msg1 animated slideInUp bg-del">'+data.error+'<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
                setTimeout(function(){
                   window.location.reload();
                },2000);
            }
          }
        });
      });
    });
  </script>
</body>
</html>
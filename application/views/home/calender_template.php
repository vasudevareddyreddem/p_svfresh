<?php if(count($days) > 0){ ?>
  <?php foreach($days as $list) { ?>
    <tr>
      <?php if(isset($list[0]) && $list[0]!=''){ ?>
        <th class="h4"><?php echo isset($list[0]) ? $list[0] : ''; ?></th>
        <td >
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo isset($list[0]) ? $list[0] : ''; ?>]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
            </span>
            <input type="hidden" name="product_id[<?php echo isset($list[0]) ? $list[0] : ''; ?>]" value="<?php echo $product_id; ?>">
            <input type="hidden" name="user_id[<?php echo isset($list[0]) ? $list[0] : ''; ?>]" value="<?php echo $user_id; ?>">
            <input type="hidden" name="year[<?php echo isset($list[0]) ? $list[0] : ''; ?>]" value="<?php echo $year; ?>">
            <input type="hidden" name="month[<?php echo isset($list[0]) ? $list[0] : ''; ?>]" value="<?php echo $month; ?>">
            <input type="hidden" name="date[<?php echo isset($list[0]) ? $list[0] : ''; ?>]" value="<?php echo isset($list[0]) ? $list[0] : ''; ?>">
            <input type="text" name="quant[<?php echo isset($list[0]) ? $list[0] : ''; ?>]" class="form-control input-number" value="0" min="0" max="100">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?php echo isset($list[0]) ? $list[0] : ''; ?>]">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
        </td>
      <?php } ?>
      <?php if(isset($list[1]) && $list[1]!=''){ ?>
        <th class="h4"><?php echo  isset($list[1]) ? $list[1] : ''; ?></th>
        <td >
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo isset($list[1]) ? $list[1] : ''; ?>]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
            </span>
            <input type="hidden" name="product_id[<?php echo isset($list[1]) ? $list[1] : ''; ?>]" value="<?php echo $product_id; ?>">
            <input type="hidden" name="user_id[<?php echo isset($list[1]) ? $list[1] : ''; ?>]" value="<?php echo $user_id; ?>">
            <input type="hidden" name="year[<?php echo isset($list[1]) ? $list[1] : ''; ?>]" value="<?php echo $year; ?>">
            <input type="hidden" name="month[<?php echo isset($list[1]) ? $list[1] : ''; ?>]" value="<?php echo $month; ?>">
            <input type="hidden" name="date[<?php echo isset($list[1]) ? $list[1] : ''; ?>]" value="<?php echo isset($list[1]) ? $list[1] : ''; ?>">
            <input type="text" name="quant[<?php echo isset($list[1]) ? $list[1] : ''; ?>]" class="form-control input-number" value="0" min="0" max="100">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?php echo isset($list[1]) ? $list[1] : ''; ?>]">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
        </td>
      <?php } ?>
      <?php if(isset($list[2]) && $list[2]!=''){ ?>
        <th class="h4"><?php echo isset($list[2]) ? $list[2] : ''; ?></th>
        <td >
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo isset($list[2]) ? $list[2] : ''; ?>]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
            </span>
            <input type="hidden" name="product_id[<?php echo isset($list[2]) ? $list[2] : ''; ?>]" value="<?php echo $product_id; ?>">
            <input type="hidden" name="user_id[<?php echo isset($list[2]) ? $list[2] : ''; ?>]" value="<?php echo $user_id; ?>">
            <input type="hidden" name="year[<?php echo isset($list[2]) ? $list[2] : ''; ?>]" value="<?php echo $year; ?>">
            <input type="hidden" name="month[<?php echo isset($list[2]) ? $list[2] : ''; ?>]" value="<?php echo $month; ?>">
            <input type="hidden" name="date[<?php echo isset($list[2]) ? $list[2] : ''; ?>]" value="<?php echo isset($list[2]) ? $list[2] : ''; ?>">
            <input type="text" name="quant[<?php echo isset($list[2]) ? $list[2] : ''; ?>]" class="form-control input-number" value="0" min="0" max="100">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?php echo isset($list[2]) ? $list[2] : ''; ?>]">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
        </td>
      <?php } ?>
      <?php if(isset($list[3]) && $list[3]!=''){ ?>
        <th class="h4"><?php echo isset($list[3]) ? $list[3] : ''; ?></th>
        <td >
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo isset($list[3]) ? $list[3] : ''; ?>]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
            </span>
            <input type="hidden" name="product_id[<?php echo isset($list[3]) ? $list[3] : ''; ?>]" value="<?php echo $product_id; ?>">
            <input type="hidden" name="user_id[<?php echo isset($list[3]) ? $list[3] : ''; ?>]" value="<?php echo $user_id; ?>">
            <input type="hidden" name="year[<?php echo isset($list[3]) ? $list[3] : ''; ?>]" value="<?php echo $year; ?>">
            <input type="hidden" name="month[<?php echo isset($list[3]) ? $list[3] : ''; ?>]" value="<?php echo $month; ?>">
            <input type="hidden" name="date[<?php echo isset($list[3]) ? $list[3] : ''; ?>]" value="<?php echo isset($list[3]) ? $list[3] : ''; ?>">
            <input type="text" name="quant[<?php echo isset($list[3]) ? $list[3] : ''; ?>]" class="form-control input-number" value="0" min="0" max="100">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?php echo isset($list[3]) ? $list[3] : ''; ?>]">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
        </td>
      <?php } ?>
      <?php if(isset($list[4]) && $list[4]!=''){ ?>
        <th class="h4"><?php echo isset($list[4]) ? $list[4] : ''; ?></th>
        <td >
          <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?php echo isset($list[4]) ? $list[4] : ''; ?>]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
            </span>
            <input type="hidden" name="product_id[<?php echo isset($list[4]) ? $list[4] : ''; ?>]" value="<?php echo $product_id; ?>">
            <input type="hidden" name="user_id[<?php echo isset($list[4]) ? $list[4] : ''; ?>]" value="<?php echo $user_id; ?>">
            <input type="hidden" name="year[<?php echo isset($list[4]) ? $list[4] : ''; ?>]" value="<?php echo $year; ?>">
            <input type="hidden" name="month[<?php echo isset($list[4]) ? $list[4] : ''; ?>]" value="<?php echo $month; ?>">
            <input type="hidden" name="date[<?php echo isset($list[4]) ? $list[4] : ''; ?>]" value="<?php echo isset($list[4]) ? $list[4] : ''; ?>">
            <input type="text" name="quant[<?php echo isset($list[4]) ? $list[4] : ''; ?>]" class="form-control input-number" value="0" min="0" max="100">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?php echo isset($list[4]) ? $list[4] : ''; ?>]">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </span>
          </div>
        </td>
      <?php } ?>
    </tr>
  <?php } ?>
<?php } ?>
<script>

$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
</script>

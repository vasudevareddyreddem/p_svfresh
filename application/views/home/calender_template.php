<?php echo count($days); if(count($days) > 0){ ?>
  <?php for ($i=0; $i < count($days); $i++) { ?>
    
      <th class="h4">1</th>
      <td >
        <div class="input-group">
          <span class="input-group-btn">
            <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[1]">
              <span class="glyphicon glyphicon-minus"></span>
            </button>
          </span>
          <input type="text" name="quant[1]" class="form-control input-number" value="0" min="0" max="100">
          <span class="input-group-btn">
            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[1]">
              <span class="glyphicon glyphicon-plus"></span>
            </button>
          </span>
        </div>
      </td>

  <?php } ?>
<?php } ?>

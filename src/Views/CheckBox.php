<div class="px-2 pb-1">
    <div class="form-check pl-4 pb-1">
        <input class="form-check-input checkall" type="checkbox" id="checkall_<?= $field ?>"/>
        <label class="form-check-label font-weight-normal checklabel" for="checkall_<?= $field ?>"> Check all</label></div>

        <hr class="dropdown-divider">

<?php foreach ($filteroptions as $key => $value) : ?> 

<?php $ischecked = isset($values[$field][$key]) ? $values[$field][$key]=="1" : false ?>

<?php $checked = $ischecked ? " checked" : ""; ?>

    <div class="<?= $filtervar ?>_options">
        <div class="form-check pl-4 pb-1">
          <input class="form-check-input" type="checkbox" <?= $checked ?> value="1" 
          name="<?= $filtervar?>[<?= $field ?>][<?= $key ?>]" 
          id="<?= $field ?>_<?= $key ?>_id">
          <label class="form-check-label font-weight-normal" for="<?= $field ?>_<?= $key ?>_id">
            <?= $value ?>
          </label>
        </div>
    </div>

<?php endforeach ?>

</div>

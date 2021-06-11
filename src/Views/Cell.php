<<?= $tag ?> class="<?= $cellclasses ?>" <?= $colspan ?>>
<?php ($sortable ? '<a class="text-reset" href="'.$href.'">' : ''); ?>
<?= $html ?>
<?php ($sortable ? ' '.$direction.'</a>' : ''); ?>
</<?= $tag ?>>

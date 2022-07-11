<?php
  $tlClasses = array();
  $tlClasses[0] = 'order-sm-1';
  $tlClasses[1] = 'order-sm-2';
?>

<div class="row tl-entry" timeline-date="<?=$data->tl_date()->toDate('d.m.Y')?>">

  <div class="col-xs-12 col-sm-6 order-1 d-flex tl-image <?=$tlClasses[($data->num() + 1) % 2]?>">
    <?php snippet('molecules/polaroid', ['image' => $data->tl_image()->toFile()]); ?>
  </div>
  <div class="col-xs-12 col-sm-6 order-2 ps-6 tl-text <?=$tlClasses[$data->num() % 2]?>">
    <h3><?= $data->headline() ?></h3>
    <?= kt($data->description()) ?>
  </div>

</div>
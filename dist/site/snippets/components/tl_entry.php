<?php
  $tl_date = !empty($data->tl_date()) ? $data->tl_date() : '';
  if (strpos("$tl_date", '.') === 0) {
    if ("$tl_date" === '.') {
      $tl_date = date_create()->format('Y');
    } elseif ("$tl_date" === '..') {
      $tl_date = date_create()->format('m.Y');
    } elseif ("$tl_date" === '...') {
      $tl_date = date_create()->format('d.m.Y');
    }
  }
  $tlClasses = array();
  $tlClasses[0] = 'order-sm-1';
  $tlClasses[1] = 'order-sm-2';
?>

<div class="row tl-entry" timeline-date="<?=$data->tl_date()?>">

  <?php if (!empty($tl_date)): ?>
    <div class="tl-date">
      <div class="tl-date-wrapper">
        <span><?=$tl_date?></span>
      </div>
    </div>
  <?php endif; ?>

  <div class="col-xs-12 col-sm-6 order-1 tl-image <?=$tlClasses[($data->num() + 1) % 2]?>">
    <?php snippet('molecules/polaroid', ['image' => $data->tl_image()->toFile()]); ?>
  </div>
  <div class="col-xs-12 col-sm-6 order-2 tl-text <?=$tlClasses[$data->num() % 2]?>">
    <h3><?= $data->headline() ?></h3>
    <?= kt($data->description()) ?>
  </div>

</div>
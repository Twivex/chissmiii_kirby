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

  $titleDirectionClass= $data->title_text_direction()->directionClass();

  $isTextEntry = !$data->tl_text()->isEmpty();
  $tlTextDirectionClass = $data->tl_text_text_direction()->directionClass();

  $descriptionDirectionClass = $data->description_text_direction()->directionClass();
  $descriptionOrderClass = $isTextEntry ? 'order-1' : 'order-2';

  $tlClasses = ['order-lg-1', 'order-lg-2'];
  if ($data->alternating()->toBool()) {
    $tlEntryClassModifier = 'alternating';
    $tlClassOne = $tlClasses[$data->num() % 2];
    $tlClassTwo = $tlClasses[($data->num() + 1) % 2];
  } else {
    $tlEntryClassModifier = 'strict';
    $tlClassOne = $isTextEntry ? $tlClasses[1] : $tlClasses[0];
    $tlClassTwo = $isTextEntry ? $tlClasses[0] : $tlClasses[1];
  }

?>

<div class="row tl-entry tl-entry--<?=$tlEntryClassModifier?>" timeline-date="<?=$data->tl_date()?>">

  <?php if (!empty($tl_date)): ?>
    <div class="tl-date">
      <div class="tl-date-wrapper">
        <span><?=$tl_date?></span>
      </div>
    </div>
  <?php endif; ?>

  <?php if($isTextEntry): ?>
    <div class="col-xs-12 col-lg-6 tl-text order-2 <?=$tlClassOne?> <?=$tlTextDirectionClass?>">
      <?=kt($data->tl_text())?>
    </div>
  <?php else: ?>
    <div class="col-xs-12 col-lg-6 order-1 tl-image <?=$tlClassOne?>">
      <?php snippet('molecules/polaroid', [
        'image' => $data->tl_image()->toFile(),
        'size' => '300',
        'alt' => $data->title()
      ]); ?>
    </div>
  <?php endif; ?>
  <div class="col-xs-12 col-lg-6 tl-description <?=$descriptionOrderClass?> <?=$tlClassTwo?> <?=$descriptionDirectionClass?>">
    <?php if ($data->show_title()->toBool()): ?>
      <h3 class="<?=$titleDirectionClass?>"><?= $data->title() ?></h3>
    <?php endif; ?>
    <?php if (!$data->description()->isEmpty()) {
      echo kt($data->description());
    } ?>
  </div>

</div>
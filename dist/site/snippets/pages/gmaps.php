<?php
  $directionClass = '';
  $classBase = 'text-direction-';
  if (!empty($direction = $data->direction()->value())) {
    if ($direction === 'left') {
      $directionClass = 'text-start';
    } elseif ($direction === 'right') {
      $directionClass = 'text-end';
    } elseif ($direction === 'center') {
      $directionClass = 'text-center';
    } elseif ($direction === 'block') {
      $directionClass = 'text-align-justify';
    }
  }
  $col_nums = substr($data->col_nums(), 0, strpos($data->col_nums(), '/'));
?>
<section class="py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-<?=$col_nums?> <?=$directionClass?>">
      <?php if(!empty($data->headline())): ?>
        <h2 class="mb-3"><?=$data->headline()?></h2>
      <?php endif; ?>
      <iframe
        style="border:0"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer"
        tabindex="0"
        aria-hidden="false"
        frameborder="0"
        width="100%"
        height="550px"
        src="<?=$data->gmaps_link()?>"
      ></iframe>
      <?php
        \Kirby\Cms\Html::iframe($data->gmaps_link(), [
          'style' => 'border:0',
          'loading' => 'lazy',
          'referrerpolicy' => 'no-referrer',
          'allowfullscreen'
        ]);
      ?>
    </div>
  </div>
</section>
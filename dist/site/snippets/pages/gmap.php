<?php
  $show_title = $show_title ?? $data->show_title()->toBool();
  $col_nums = substr($data->col_nums(), 0, strpos($data->col_nums(), '/'));
?>
<section class="py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-<?=$col_nums?>">
      <?php if ($show_title): ?>
        <h2 class="mb-3 <?=$data->title_text_direction()->directionClass()?>"><?=$data->title()?></h2>
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
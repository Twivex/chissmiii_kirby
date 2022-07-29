<?php
  $isTopLevel = $data->parents()->count() === 0;
  $headingLevel = $isTopLevel ? 'h1' : 'h2';
  $show_title = $isTopLevel ? true : $data->show_title()->toBool();
  $titleDirectionClass = $data->title_text_direction()->directionClass();
  $colsCount = $data->cols_count()->optionKey();
  $colsCountClass = $colsCount ? "col-lg-$colsCount" : '';
?>

<?php if ($show_title): ?>
  <div class="row justify-content-center">
    <div class="col-12 <?=$colsCountClass?>">
      <<?=$headingLevel?> class="<?=$titleDirectionClass?>"><?=$data->title()?></<?=$headingLevel?>>
    </div>
  </div>
<?php endif; ?>

<section class="py-4">
  <div class="row justify-content-center mb-4">
    <div class="col-12 <?=$colsCountClass?>">
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
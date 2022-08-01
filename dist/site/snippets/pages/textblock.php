<?php
  $textDirectionClass = $data->text_direction()->directionClass();
  $colsCount = $data->cols_count()->optionKey();
  $colsCountClass = $colsCount ? "col-lg-$colsCount" : '';
?>
<section class="py-4">
  <div class="row justify-content-center">
    <div class="col-12 <?= $colsCountClass ?> <?= $textDirectionClass ?>">
      <?=kt($data->text())?>
    </div>
  </div>
</section>
<?php
  $textDirectionClass = $data->text_direction()->directionClass();
  $col_nums = substr($data->col_nums(), 0, strpos($data->col_nums(), '/'));
?>
<section class="py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-<?=$col_nums?> <?=$textDirectionClass?>">
      <?=kt($data->text())?>
    </div>
  </div>
</section>
<?php
  $textDirectionClass = $data->text_direction()->directionClass();
  $col_num = $data->col_num()->optionKey();
?>
<section class="py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-<?=$col_num?> <?=$textDirectionClass?>">
      <?=kt($data->text())?>
    </div>
  </div>
</section>
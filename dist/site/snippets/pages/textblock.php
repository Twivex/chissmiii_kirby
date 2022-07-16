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
<div class="row justify-content-center">
  <div class="col-12 col-sm-<?=$col_nums?> <?=$directionClass?>">
    <?=kt($data->text())?>
  </div>
</div>
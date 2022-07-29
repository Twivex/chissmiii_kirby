<?php
  $colsCountClass = $colsCount ? "col-lg-$colsCount" : '';
?>
<div class="row justify-content-center">
  <div class="col-12 <?=$colsCountClass?>">
    <h5><?=$data->name()?> – <small class="text-muted"><?=$data->created_at()->toDate('d.m.y H:i')?></small></h5>
    <p class="text"><?=$data->message()?></p>
  </div>
</div>
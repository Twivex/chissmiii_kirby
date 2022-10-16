<?php
  $hL = $data->headingLevel();
  $hTag = "<h$hL";
  if (!empty($hC = $data->headingTextDirectionClass())) {
    $hTag .= " class=\"$hC\"";
  }
  $hTag .= ">";
  $hTagClose = "</h$hL>";
?>

<?php if ($data->showTitle()): ?>
  <div class="row justify-content-center">
    <div class="col-12 <?= $data->columnsClass() ?>">
      <?= $hTag ?>
        <?= $data->title() ?>
      <?= $hTagClose ?>
    </div>
  </div>
<?php endif; ?>
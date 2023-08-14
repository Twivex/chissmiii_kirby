<?php
  $hL = $data->headingLevel();
  $hTag = "<h$hL";
  if (!empty($hC = $data->headingTextDirectionClass())) {
    $hTag .= " class=\"$hC\"";
  }
  $hTag .= ">";
  $hTagClose = "</h$hL>";
  $title = $data->title();
  if (isset($showParentTitle) && $showParentTitle) {
    $title = $data->parent()->title() . ' – ' . $title;
  }
  $showStickyHeader = !$page->isTopLevel();
?>

<?php if ($showStickyHeader): ?>
  <div class="sticky-header">
    <div class="sticky-header-body">
      <?php snippet('atoms/fab', [
        'iconName' => 'arrow_back',
        'url' => $data->parent()->url(),
        'iconSize' => 'large',
        'additionalClasses' => ['position-absolute', 'btn-nav'],
        'title' => 'Zurück'
      ]) ?>
    </div>
  </div>
<?php endif; ?>

<?php if ($data->showTitle()): ?>
  <div class="section-headline row">
    <div class="col-12 <?= $data->columnsClass() ?>">
      <?= $hTag ?>
        <?= $title ?>
      <?= $hTagClose ?>
    </div>
  </div>
<?php endif; ?>

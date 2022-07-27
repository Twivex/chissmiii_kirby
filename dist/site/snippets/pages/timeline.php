<?php
  $show_title = $show_title ?? $data->show_title()->toBool();
?>
<section class="py-4 timeline">
  <?php if ($show_title): ?>
    <h2 class="<?=$data->title_text_direction()->directionClass()?>"><?=$data->title()?></h2>
  <?php endif; ?>
  <?php foreach ($data->children() as $entry) {
    snippet('pages/tl_entry', [
      'data' => $entry,
      'alternating' => $data->alternating_entries()->toBool()
    ]);
  }?>
</section>
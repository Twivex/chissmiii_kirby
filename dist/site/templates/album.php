<?php snippet('globals/header') ?>

<?php foreach ($page->album_images()->toBlocks() as $block): ?>
  <section>
    <?php snippet('blocks/' . $block->type(), [
      'block' => $block,
      'showIndicators' => $page->show_indicators()->toBool(),
      'showControls' => $page->show_controls()->toBool(),
    ]) ?>
  </section>
<?php endforeach ?>

<?php snippet('globals/footer') ?>
<?php snippet('globals/header') ?>

<?php foreach ($page->galleries()->toBlocks() as $block): ?>
  <section>
    <?php snippet('blocks/' . $block->type(), [
      'block' => $block,
      'showIndicators' => true,
      'showControls' => true
    ]) ?>
  </section>
<?php endforeach ?>

<?php snippet('globals/footer') ?>
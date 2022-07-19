<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <?php if ($page->show_title()->toBool()): ?>
    <h1 class="<?=$page->title_text_direction()->directionClass()?>"><?=$page->title()?></h1>
  <?php endif; ?>
  <?php
    $page = $page->update([
      'show_title' => false
    ]);
    snippet($page->blueprint()->name(), ['data' => $page]);
  ?>
</main>

<?php snippet('globals/footer') ?>
<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">

  <?php if ($page->show_title()->toBool() === true): ?>
    <h1 class="text-center"><?=$page->title()?></h1>
  <?php endif; ?>

  <?php foreach($page->children() as $child) {
    snippet($child->blueprint()->name(), ['data' => $child]);
  } ?>

</main>

<?php snippet('globals/footer') ?>
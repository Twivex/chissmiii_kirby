<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <?= snippet($page->blueprint()->name(), ['data' => $page]) ?>
</main>

<?php snippet('globals/footer') ?>
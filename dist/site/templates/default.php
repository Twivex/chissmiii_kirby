<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <h1 class="text-center"><?=$page->title()?></h1>
  <?php
    $page = $page->update([
      'show_title' => false
    ]);
    snippet($page->blueprint()->name(), [ 'data' => $page]);
  ?>
</main>

<?php snippet('globals/footer') ?>
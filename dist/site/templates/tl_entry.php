<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <section class="py-4 timeline">
    <?= snippet('components/' . $page->template()->name(), ['data' => $page]) ?>
  </section>
</main>

<?php snippet('globals/footer') ?>
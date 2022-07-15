<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <section>
    <div class="row text-center">
      <?php snippet('components/' . $page->template()->name(), [ 'data' => $page ]); ?>
    </div>
  </section>
</main>

<?php snippet('globals/footer') ?>
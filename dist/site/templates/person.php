<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <section class="py-4">
    <div class="row">
      <div class="col-12 col-sm-6">
        <?php
          snippet($page->blueprint()->name(), [ 'data' => $page ]);
        ?>
      </div>
    </div>
  </section>
</main>

<?php snippet('globals/footer') ?>
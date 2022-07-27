<?php snippet('globals/header') ?>

<section class="py-4">
  <div class="row">
    <div class="col-12 col-sm-6">
      <?php
        snippet($page->blueprint()->name(), [ 'data' => $page ]);
      ?>
    </div>
  </div>
</section>

<?php snippet('globals/footer') ?>
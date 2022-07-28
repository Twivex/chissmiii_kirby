<?php snippet('globals/header') ?>

<section class="py-4 timeline">
  <?= snippet($page->blueprint()->name(), ['data' => $page]) ?>
</section>

<?php snippet('globals/footer') ?>
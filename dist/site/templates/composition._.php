<?php snippet('globals/header') ?>

<?php snippet('atoms/section-heading', [ 'data' => $page ]); ?>

<?php foreach($children as $child) {
  snippet($child->blueprint()->name(), [ 'data' => $child ]);
} ?>

<?php snippet('globals/footer') ?>
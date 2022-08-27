<?php snippet('globals/header') ?>

<?php
  snippet($page->blueprint()->name(), [ 'data' => $page ]);
?>

<?php snippet('globals/footer') ?>
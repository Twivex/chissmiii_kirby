<?php snippet('globals/header') ?>

<h1 class="<?=$page->title_text_direction()->directionClass()?>"><?=$page->title()?></h1>

<?php
  snippet($page->blueprint()->name(), [
    'show_title' => false,
    'data' => $page
  ]);
?>

<?php snippet('globals/footer') ?>
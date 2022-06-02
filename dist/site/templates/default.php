<?php
  if($page->secured()->toBool() === true && !$kirby->user()) go('/')
?>
<?php snippet('globals/header') ?>

<main id="main" class="container">

<h1><?= $page->title()->escape() ?></h1>

</main>
<?php snippet('globals/footer') ?>
<?php
  if($page->secured()->toBool() === true && !$kirby->user()) go('/')
?>
<?php snippet('header') ?>

<h1><?= $page->title()->escape() ?></h1>

<?php snippet('footer') ?>
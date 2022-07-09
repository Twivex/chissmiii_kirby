<?php
  if ($page->secured()->toBool() === true && !$kirby->user()) go('/')
?>

<html>
  <head>
    <meta charset="utf-8">
    <title><?=$page->title()?> | <?=$site->title()?></title>
    <meta name="title=" content="<?=$page->title()?> | <?=$site->title()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/resources/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sacramento">
  </head>
  <body>
    <header>
      <?php snippet('globals/nav') ?>
    </header>

<?php
  if ($page->secured()->toBool() === true && !$kirby->user()) go('/');

  $appIcons = $site->files()->filterBy('tag', 'app_icon');
  $appIconExists = $appIcons->count() > 0;
  if ($appIconExists) {
    $appIcon = $appIcons->first();
  }

  $appLaunchScreens = $site->files()->filterBy('tag', 'app_launch_screen');
  $appLaunchScreenExists = $appLaunchScreens->count() > 0;
  if ($appLaunchScreenExists) {
    $appLaunchScreen = $appLaunchScreens->first();
  }
?>

<html lang="de">
  <head>
    <meta charset="utf-8">
    <title><?= $page->title()?> | <?=$site->title() ?></title>
    <meta name="title=" content="<?= $page->title()?> | <?=$site->title() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/resources/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sacramento">
    <?php if ($appIconExists): ?>
      <link rel="apple-touch-icon" href="<?= $appIcon->url() ?>">
    <?php endif; ?>
    <meta name="apple-mobile-web-app-title" content="ChissMiii">
    <?php if ($appIconExists): ?>
      <link rel="apple-touch-startup-image" href="<?= $appLaunchScreen->url() ?>">
    <?php endif; ?>
    <meta name="apple-mobile-web-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fbb8ab">
  </head>
  <body>
    <?php snippet('globals/nav') ?>
    <?php snippet('globals/bg-img') ?>
    <main id="main" class="container my-sm-4 px-sm-4 py-4">
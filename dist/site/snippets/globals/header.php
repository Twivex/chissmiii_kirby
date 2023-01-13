<?php
  if ($page->secured()->toBool() === true && !$kirby->user()) go('/');

  $appIcon = $site->app_icon()->toFile();
  $appLaunchScreen = $site->app_launch_screen()->toFile();

  $favicon = $site->favicon()->toFile();
  if ($page->favicon()->isNotEmpty()) {
    $favicon = $page->favicon()->toFile();
  }
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <title><?= $page->title()?> | <?=$site->title() ?></title>
    <meta name="title=" content="<?= $page->title()?> | <?=$site->title() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
      $stylesPath = option('resource_paths')['css'] . 'style.css';
      $stylesMod = md5('T' . filemtime($stylesPath));
    ?>
    <?= css("$stylesPath?mod=$stylesMod") ?>

    <?= css(option('resource_paths')['ms_css'] . 'rounded.css') ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sacramento">

    <?php
      if ($page->settings_enabled()->toBool() === true) {
        // use page variables, if possible
        snippet('globals/css-variables', [ 'data' => $page ]);
      }
      else {
        // default: use site variables
        snippet('globals/css-variables', [ 'data' => $site ]);
      }
    ?>

    <?php if ($appIcon): ?>
      <link rel="apple-touch-icon" href="<?= $appIcon->mediaUrl() ?>">
    <?php endif; ?>
    <meta name="apple-mobile-web-app-title" content="ChissMiii">
    <?php if ($appLaunchScreen): ?>
      <link rel="apple-touch-startup-image" href="<?= $appLaunchScreen->mediaUrl() ?>">
    <?php endif; ?>
    <meta name="apple-mobile-web-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fbb8ab">

    <?php if ($favicon): ?>
      <link rel="apple-touch-icon" sizes="180x180" href="<?= $favicon->resize(180)->url() ?>">
      <link rel="shortcut icon" type="image/png" sizes="32x32" href="<?= $favicon->resize(32)->url() ?>">
      <link rel="shortcut icon" type="image/png" sizes="16x16" href="<?= $favicon->resize(16)->url() ?>">
    <?php endif; ?>
  </head>
  <body>
    <?php snippet('globals/nav') ?>
    <main id="main" class="container my-sm-4 px-sm-4 py-4">
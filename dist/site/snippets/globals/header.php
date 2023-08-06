<!DOCTYPE html>
<html lang="<?= $kirby->language() ?>">
  <head>
    <meta charset="UTF-8">
    <title><?= $page->title() ?> | <?= $site->title() ?></title>
    <meta name="title" content="<?= $page->title() ?> | <?= $site->title() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <?= css(option('resource_paths')['ms_css'] . 'rounded.css') ?>
    <?= css(option('resource_paths')['mm_masonry_css'] . 'mm-masonry.css') ?>

    <?php
      $stylesPath = option('resource_paths')['css'] . 'style.css';
      $stylesMod = md5('T' . filemtime($stylesPath));
      echo css("$stylesPath?mod=$stylesMod");
    ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sacramento">

    <?php
      if ($page->settings_enabled()->toBool() === true) {
        $source = $page;
      } elseif ($page->parents()->count() > 0 && $page->parent()->settings_enabled()->toBool() === true) {
        $source = $page->parent();
      } else {
        $source = $site;
      }

      snippet('globals/css-variables', compact('source'));

      $appIcon = $site->app_icon();
      $appLaunchScreen = $site->app_launch_screen();

      $favicon = $source->favicon();
    ?>

    <?php if ($appIcon->isNotEmpty() && ($appIconFile = $appIcon->toFile())->exists()): ?>
      <link rel="apple-touch-icon" sizes="180x180" href="<?= $appIconFile->resize(180)->url() ?>">
    <?php endif; ?>

    <meta name="apple-mobile-web-app-title" content="ChissMiii">
    <?php if ($appLaunchScreen->isNotEmpty() && ($appLaunchScreenFile = $appLaunchScreen->toFile())->exists()): ?>
      <link rel="apple-touch-startup-image" href="<?= $appLaunchScreenFile->url() ?>">
    <?php endif; ?>

    <meta name="apple-mobile-web-capable" content="yes">
    <?php if ($source->color_bs_light()->isNotEmpty()): ?>
      <meta
        name="apple-mobile-web-app-status-bar-style"
        content="<?= $source->color_bs_light()->toColor('hex') ?>"
      >
    <?php endif; ?>

    <?php if ($favicon->isNotEmpty() && ($faviconFile = $favicon->toFile())->exists()): ?>
      <link
        rel="shortcut icon"
        type="image/png"
        sizes="32x32"
        href="<?= $faviconFile->resize(32)->url() ?>"
      >
      <link
        rel="shortcut icon"
        type="image/png"
        sizes="16x16"
        href="<?= $faviconFile->resize(16)->url() ?>"
      >
    <?php endif; ?>

    <link rel="manifest" href="/resources/manifest.json">
  </head>
  <body>
    <?php snippet('globals/nav') ?>
    <main id="main" class="py-sm-4">
      <div class="content-wrapper">
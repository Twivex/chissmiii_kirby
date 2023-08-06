<!DOCTYPE html>
<html lang="<?= $kirby->language() ?>">
  <head>
    <meta charset="UTF-8">
    <title><?= $page->title() ?> | <?= $site->title() ?></title>
    <meta name="title" content="<?= $page->title() ?> | <?= $site->title() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= css(option('resource_paths')['ms_css'] . 'rounded.css') ?>
    <?= css(option('resource_paths')['mm_masonry_css'] . 'mm-masonry.css') ?>

    <?php
      $stylesPath = option('resource_paths')['css'] . 'style.css';
      $stylesMod = md5('T' . filemtime($stylesPath));
      echo css("$stylesPath?mod=$stylesMod");
    ?>

    <?php
      // retrieve all js files from js resource path
      $fontsBasepathh = option('resource_paths')['fonts'];
      $fontFiles = scandir($fontsBasepathh);
      $fontFiles = array_filter($fontFiles, function($file) {
        return strpos($file, '.ttf') === strlen($file) - 4;
      });
    ?>
    <?php foreach($fontFiles as $fontFile): ?>
      <link rel="preload" href="<?= $fontsBasepathh ?>/<?= $fontFile ?>" as="font" type="font/ttf" crossorigin>
    <?php endforeach; ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sacramento">

    <?php if (file_exists($kirby->root('index') . '/content/manifest.json')): ?>
      <link rel="manifest" href="/resources/manifest.webmanifest">
    <?php endif; ?>

    <?php
      if ($page->settings_enabled()->toBool() === true) {
        $source = $page;
      } elseif ($page->parents()->count() > 0 && $page->parent()->settings_enabled()->toBool() === true) {
        $source = $page->parent();
      } else {
        $source = $site;
      }

      snippet('globals/css-variables', compact('source'));

      $favicon = $source->favicon();
    ?>

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

    <style>
      link[rel="manifest"] {
        --pwacompat-splash-font: 24px 'The Seasons';
      }
    </style>

  </head>
  <body>
    <?php snippet('globals/nav') ?>
    <main id="main" class="py-sm-4">
      <div class="content-wrapper">
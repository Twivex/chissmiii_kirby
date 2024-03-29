<?php
return [
  'routes' => require_once 'routes.php',
  'home' => 'home',
  'debug'  => !isset($_SERVER['HTTP_X_FORWARDED_PROTO']),
  'url' => isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://chissmiii.home-webserver.de' : 'localhost:' . $_SERVER['SERVER_PORT'],
  'panel' => [
    'language' => 'de'
  ],
  'auth' => [
    'methods' => ['password', 'password-reset']
  ],
  'languages' => true,
  'languages_json_path' => 'resources/languages/',
  'resource_paths' => [
    'js' => 'resources/js/',
    'css' => 'resources/css/',
    'fonts' => 'resources/assets/fonts/',
    'ms_css' => 'resources/lib/material-symbols/',
    'mm_masonry_css' => 'resources/lib/mm-masonry/css/',
    'languages' => 'resources/languages/',
    'pwacompat' => 'resources/lib/pwacompat/',
  ],
  'cloud_path' => $_ENV['CLOUD_PATH'] ?? '/cloud',
  'thumbnail_path' => $_ENV['THUMBNAIL_PATH'] ?? '/cloud/.thumbnails',
  'thumbnail_width' => 600,
  'thumbnail_height' => 900,
];
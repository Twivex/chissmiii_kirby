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
    'languages' => 'resources/languages/',
  ],
];
<?php
return [
  'routes' => require_once 'routes.php',
  'home' => 'home',
  'debug'  => true,
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
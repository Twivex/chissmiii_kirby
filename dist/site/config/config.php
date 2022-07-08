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
  ]
];
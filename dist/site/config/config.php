<?php
return [
  'routes' => require_once 'routes.php',
  'home' => 'events',
  'debug'  => true,
  'panel' => [
    'language' => 'de'
  ],
  'auth' => [
    'methods' => ['password', 'password-reset']
  ]
];
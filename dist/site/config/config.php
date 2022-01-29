<?php
return [
  'routes' => require_once 'routes.php',
  'debug'  => true,
  'panel' => [
    'language' => 'de'
  ],
  'auth' => [
    'methods' => ['password', 'password-reset']
  ]
];
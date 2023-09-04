<?php

use Kirby\Http\Header;

return [
  [
    'pattern' => 'logout',
    'action'  => function() {

      if ($user = kirby()->user()) {
        $user->logout();
      }

      go('/');

    }
  ],
  [
    'pattern' => '(:alpha)/download/(:all)',
    'action'  => function($lang, $target) {
      $kirby = kirby();
      $response = kirby()->controller(
        'download',
        compact(
          'kirby',
          'target'
        )
      );

      return $response;
    }
  ],
  [
    'pattern' => '(:alpha)/upload/(:all)',
    'method' => 'POST',
    'action' => function($lang, $target) {
      $kirby = kirby();
      $response = kirby()->controller(
        'upload',
        compact(
          'kirby',
          'target'
        )
      );

      return $response;
    }
  ],
  [
    'pattern' => 'pwologin/(:all)',
    'method' => 'POST',
    'action' => function($uri) {
      $kirby = kirby();
      $response = kirby()->controller(
        'pwologin',
        compact(
          'kirby',
          'uri'
        )
      );

      return $response;
    }
  ],
  [
    'pattern' => 'thumbnail/(:all)',
    'method' => 'GET',
    'action' => function ($file) {
      $kirby = kirby();
      $file = urldecode($file);

      if (empty($file) || !file_exists($file)) {
        Header::status(404);
        return;
      }

      $width = get('width');
      if (!empty($width) && is_numeric($width)) {
        $width = intval($width);
        $width = $width > 0 ? $width : null;
      } else {
        $width = null;
      }

      $height = get('height');
      if (!empty($height) && is_numeric($height)) {
        $height = intval($height);
        $height = $height > 0 ? $height : null;
      } else {
        $height = null;
      }

      $response = kirby()->controller(
        'thumbnail',
        compact(
          'file',
          'width',
          'height'
        )
      );

      return $response;
    }
],
];
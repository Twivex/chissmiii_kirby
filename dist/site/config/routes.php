<?php

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
    'pattern' => 'thumbnail',
    'method' => 'GET',
    'action' => function () {
      $kirby = kirby();
      $file = get('file');

      if (empty($file) || !file_exists($file)) {
        Header::status(404);
        go('error');
      }

      $controller = 'video_thumbnail';

      // differ between image and video
      if (in_array(mime_content_type($file), ['image/jpeg', 'image/png', 'image/gif'])) {
        $controller = 'thumbnail';
      }
      $response = kirby()->controller(
        $controller,
        compact(
          'kirby',
          'file'
        )
      );

      return $response;
    }
],
];
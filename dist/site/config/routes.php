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
];
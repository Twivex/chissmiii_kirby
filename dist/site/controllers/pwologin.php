<?php

return function ($kirby, $uri) {

  // handle the form submission
  if ($kirby->request()->is('POST')) {

    // try to log the user in with the provided credentials
    try {
      $kirby->auth()->login(get('email'), get('password'));
      $page = $kirby->site()->find($uri);
      $success = true;
    } catch (Exception $e) {
      $error = t('password-invalid-hint');
    }

  }

  return [
    'success' => isset($success) ? $success : false,
    'error' => isset($error) ? $error : false,
  ];

};
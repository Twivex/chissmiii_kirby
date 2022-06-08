<?php

return function ($kirby, $page) {
  if ($kirby->request()->is('POST')) {

    // check the honeypot and exit if is has been filled in
    if(empty(get('website')) === false) {
      go($page->url());
      exit;
    }

    $data = [
      'name'    => get('name'),
      'message' => get('message'),
    ];

    $rules = [
      'name'  => ['required'],
      'message' => ['required'],
    ];

    $messages = [
      'name'  => 'Name is required',
      'message' => 'Message is required',
    ];

    // some of the data is invalid
    if ($invalid = invalid($data, $rules, $messages)) {
      $alert = $invalid;

    } else {

      // authenticate as almighty
      $kirby->impersonate('kirby');

      try {
        // store entry as subpage of the current page
        $gbEntry = $page->createChild([
          'slug'     => str::slug($data['name'] . microtime()),
          'draft' => false,
          'template' => 'gb_entry',
          'content'  => $data
        ])
        ->changeStatus('listed');

        $html = page($gbEntry->uri())->render();
      } catch (Exception $e) {
        $alert = ['Your request failed: ' . $e->getMessage()];
      }
    }

    // return data
    return [
      'error' => $alert ?? null,
      'data' => $data ?? null,
      'html'  => $html ?? false,
    ];
  }
};
<?php

return function ($kirby, $page) {
  if ($kirby->request()->is('POST')) {

    // check the honeypot and exit if is has been filled in
    if (empty(get('website')) === false) {
      go($page->url());
      exit;
    }

    $data = [
      'song_artist' => get('song_artist'),
      'song_title'  => get('song_title'),
    ];

    $rules = [
      'song_artist' => ['required'],
      'song_title'  => ['required'],
    ];

    $messages = [
      'song_artist'  => '"Interpret" ist ein Pflichtfeld.',
      'song_title' => '"Titel" ist ein Pflichtfeld',
    ];

    // some of the data is invalid
    if ($invalid = invalid($data, $rules, $messages)) {
      $alert = $invalid;
    } else {


      $slug = strtolower(str::slug($data['song_artist'] . '_' . $data['song_title']));
      $entryId = $page->id() . '/' . $slug;

      if ($kirby->page($entryId) !== null) {
        $alert = 'Liedwunsch existiert bereits.';
      } else {
        // authenticate as almighty
        $kirby->impersonate('kirby');

        try {
          // store entry as subpage of the current page
          $swEntry = $page->createChild([
            'slug'     => $slug,
            'draft' => false,
            'template' => 'songwish.entry',
            'content'  => $data
          ]);

          // TODO update JS -> use different name from "guestbook"

          $swEntry->changeStatus('listed');

          $html = snippet(
            'pages/songwish.list',
            [
              'data' => $page,
              'colsCount' => $page->cols_count()->optionKey()
            ],
            true
          );
        } catch (Exception $e) {
          $alert = ['Anfrage fehlgeschlagen: ' . $e->getMessage()];
        }
      }
    }

    // return data
    return [
      'error' => $alert ?? false,
      'form_data' => $data ?? null,
      'html'  => $html ?? false,
    ];
  }
};

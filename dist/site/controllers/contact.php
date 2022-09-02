<?php

return function ($kirby, $page) {
  if ($kirby->request()->is('POST')) {

    // check the honeypot and exit if it has been filled in
    if (empty(get('website')) === false) {
      go($page->url());
      exit;
    }

    $data = [
      'name'        => get('name'),
      'email'       => get('email'),
      'phone'       => get('phone'),
      'message'     => get('message')
    ];

    $rules = [
      'name' => ['required'],
      'email' => ['email'],
      'phone' => ['numb'],
      'message' => ['required']
    ];

    $messages = [
      'name' => '"Name" ist ein Pflichtfeld.',
      'email' => '"E-Mail" muss eine gültige E-Mail Adresse beinhalten.',
      'name' => '"Telefon" muss eine gültige Telefonnummer beinhalten.',
      'message' => '"Nachricht" ist ein Pflichtfeld.',
    ];

    if ($invalid = invalid($data, $rules, $messages)) {
      $alert = $invalid;
    } else {


      /* create page */

      // authenticate as almighty
      $kirby->impersonate('kirby');

      try {
        $contactEntry = $page->createChild([
          'slug'  => str::slug($data['name'] . microtime()),
          'draft' => true,
          'template' => 'contact.request',
          'content'  => array_merge([
            'title' => 'Anfrage von ' . esc($data['name']) . ' am ' . date('d.m.Y H:i:s')
          ], $data)
        ]);

      } catch (Exception $e) {
        $alert = ['Your request failed: ' . $e->getMessage()];
      }



      /* send e-mail */

      try {
        $kirby->email([
          'template' => 'contact',
          'from'     => 'info@chissmiii.home-webserver.de',
          'replyTo'  => $data['email'],
          'to'       => 'mimi.christian34@gmail.com',
          'subject'  => 'ChissMiii Website – ' . esc($data['name']) . ' hat eine Anfrage gesendet',
          'data'     => [
            'text'   => esc($data['message']),
            'sender' => [
              'name' => esc($data['name']),
              'mail' => esc($data['mail']),
              'phone' => esc($data['phone']),
            ],
            'entryUri' => $contactEntry->uri()
          ]
        ]);
      } catch (Exception $error) {
        if (option('debug')) {
          $alert['error'] = 'The form could not be sent: <strong>' . $error->getMessage() . '</strong>';
        } else {
          $alert['error'] = 'The form could not be sent!';
        }
      }





      /* check if everything went fine */
      if (empty($alert)) {
        $success = 'Vielen Dank für deine Nachricht!';
        $data = [];
      }
    }

    return [
      'error' => $alert ?? null,
      'form_data' => $data ?? null,
      'success' => $success ?? false
    ];
  }
};

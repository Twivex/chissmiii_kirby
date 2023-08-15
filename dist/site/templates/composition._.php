<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }

  snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]);

  if ($page->isSecured() && !$page->userHasAccess()) {

    snippet('components/pwonly-login', ['accessUserEmail' => $page->getAccessUser()->email()]);

  } else {

    $injected = true;
    $data = compact('site', 'kirby', 'injected');

    foreach($page->visibleChildren() as $child) {
      $blueprintName = strtolower($child->intendedTemplate());
      $albumPageBlueprints = ['album', 'ext_album', 'ext_album2'];
      if (in_array($blueprintName, $albumPageBlueprints)) {
        $data['albumPage'] = $child;
        snippet('pages/album.cover', $data);
      } else {
        $data['page'] = $child;
        echo $child->template()->render($data);
      }
    }

    if (!$isInjected) {
      snippet('globals/footer');
    }
  }
?>
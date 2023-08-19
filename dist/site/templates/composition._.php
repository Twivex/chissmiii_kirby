<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }

  snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]);

  if ($page->isSecured() && !$page->userHasAccess()) {

    snippet('components/pwonly-login', ['accessUserEmail' => $page->getAccessUser()->email()]);

  } else {

    $containsAlbum = false;
    $injected = true;
    $data = compact('site', 'kirby', 'injected');

    foreach($page->visibleChildren() as $child) {
      $blueprintName = strtolower($child->intendedTemplate());
      $albumPageBlueprints = ['album', 'ext_album', 'ext_album2'];
      if (in_array($blueprintName, $albumPageBlueprints)) {
        $containsAlbum = true;
        $data['albumPage'] = $child;
        snippet('pages/album.cover', $data);
      } elseif (strpos($blueprintName, 'composition') === 0) {
        $data['page'] = $child;
        snippet('pages/page.cover', $data);
      } else {
        $data['page'] = $child;
        echo $child->template()->render($data);
      }
    }

    if ($containsAlbum) {
      snippet('components/upload-modal');
    }

    if (!$isInjected) {
      snippet('globals/footer');
    }
  }
?>
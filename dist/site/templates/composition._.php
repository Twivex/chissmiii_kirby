<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }

  snippet('atoms/section-heading', [ 'data' => $page ]);

  $injected = true;
  $data = compact('site', 'kirby', 'injected');

  foreach($page->visibleChildren() as $child) {
    $data['page'] = $child;
    echo $child->template()->render($data);
  }

  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }


  snippet($page->blueprint()->name(), [ 'data' => $page ]);


  if (!$isInjected) {
    snippet('globals/footer');
  }

?>
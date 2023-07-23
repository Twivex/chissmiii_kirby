<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/main', slots: true);
  }


  snippet($page->blueprint()->name(), [ 'data' => $page ]);


  if (!$isInjected) {
    endsnippet();
  }

?>
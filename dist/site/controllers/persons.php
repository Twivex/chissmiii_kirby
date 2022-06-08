<?php

return function($page, $kirby) {

  $persons = $page->children();

  if (!$kirby->user()) {
    $persons = $persons->listed();
  }

  return [
    'persons' => $persons
  ];
}

?>
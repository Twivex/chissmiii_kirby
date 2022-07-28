<?php

return function($page, $kirby) {

  $children = $page->children();

  if (!$kirby->user()) {
    $children = $children->listed();
  }

  return [
    'children' => $children
  ];
}

?>
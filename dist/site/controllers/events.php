<?php

return function($page, $kirby) {
  $yesterday = date_create('now')->modify('-1 day')->getTimeStamp();

  $upcomingEvents = $page->children()
  ->filter(function ($page) use ($yesterday) {
    return $page->date()->toDate() > $yesterday;
  })
  ->sortBy('date', 'asc');

  $pastEvents = $page->children()
  ->filter(function ($page) use ($yesterday) {
    return $page->date()->toDate() < $yesterday;
  })
  ->sortBy('date', 'desc');

  if (!$kirby->user()) {
    $upcomingEvents = $upcomingEvents->listed();
    $pastEvents = $pastEvents->listed();
  }


  return [
    'upcomingEvents' => $upcomingEvents,
    'pastEvents' => $pastEvents
  ];
}

?>
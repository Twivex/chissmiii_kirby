<?php
  $additionalContent = '<ul>';

  $date = $event->date()->toDate('d.m.y');
  $additionalContent .= "<li>Datum: $date</li>";

  if ($event->time()->isNotEmpty()) {
    $time = $event->time()->toDate('H:i');
    $additionalContent .= "<li>Zeit: $time Uhr</li>";
  }

  if ($event->companion()->isNotEmpty()) {
    $companion = $event->companion();
    $additionalContent .= "<li>Anhang: $companion</li>";
  }

  if ($event->fooddrinks()->isNotEmpty()) {
    $fooddrinks = $event->fooddrinks();
    $additionalContent .= "<li>Essen/Trinken: $fooddrinks</li>";
  }

  $additionalContent .= '</ul>';

  $cardData = [
    'imageUrl' => $imageUrl,
    'imageAlt' => $imageAlt,
    'title' => $event->title()->escape(),
    'description' => $event->description(),
    'pageUri' => $event->uri(),
    'additionalContent' => $additionalContent
  ];
  snippet('molecules/img_card', $cardData);
?>
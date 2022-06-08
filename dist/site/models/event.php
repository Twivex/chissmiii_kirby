<?php

class EventPage extends Page {
  function coverImg() {
    if ($this->cover()->isNotEmpty()) {
      $cover = $this->cover()->toFile();
    } else {
      $cover = kirby()->site()->files()->filterBy('tag', 'event_placeholder')->first();
    }
    return $cover;
  }
}

?>
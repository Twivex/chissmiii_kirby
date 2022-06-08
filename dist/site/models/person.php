<?php

class PersonPage extends Page {
  function portraitImg() {
    if ($this->portrait()->isNotEmpty()) {
      $portrait = $this->portrait()->toFile();
    } else {
      $portrait = kirby()->site()->files()->filterBy('tag', 'portrait_placeholder')->first();
    }
    return $portrait;
  }
}

?>
<?php
  snippet('atoms/btn-icon', [
    'iconName' => 'close',
    'attributes' => [
      'data-bs-dismiss' => $target,
      'aria-label' => 'Close',
    ],
    'additionalClasses' => ['btn-close'],
  ]);
?>
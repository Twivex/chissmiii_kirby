<?php
  $labelTextIdentifier = $unit;
  if ($counter === '1') {
    $labelTextIdentifier = str_replace('s', '', $unit);
  }
?>

<div data-countdown-value="<?= $counter ?>" data-countdown-unit="<?= $unit ?>" class="countdown-element">
  <span class="countdown-value"><?= $counter ?></span>
  <span class="countdown-label"><?= t($labelTextIdentifier) ?></span>
</div>
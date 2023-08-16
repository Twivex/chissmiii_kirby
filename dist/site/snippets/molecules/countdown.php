<?php
  $isTargetTimeGiven = $targetTime->isNotEmpty();
  $targetDateTime = $targetDate->toDate('Y-m-d');
  if ($isTargetTimeGiven) {
    $targetDateTime .= ' ' . $targetTime->toDate('H:i:s');
  } else {
    $targetDateTime .= ' 23:59:59';
  }

  $currentDateTime = date_create('now');
  $targetDateTime = date_create($targetDateTime);
  $diff = $currentDateTime->diff($targetDateTime, true);

  $yearsInMonths = $diff->format('%y') * 12;
  $months = $diff->format('%m');

  $monthsLeft = $yearsInMonths + $months;
  $daysLeft = $diff->format('%d');
  if (!$positiveDiff) {
    $daysLeft = $daysLeft + 1;
  }

  $hoursLeft = 0;
  $minutesLeft = 0;
  $secondsLeft = 0;

  if ($isTargetTimeGiven) {
    $hoursLeft = $diff->format('%h');
    $minutesLeft = $diff->format('%i');
    $secondsLeft = $diff->format('%s');
  }
?>

<div class="col-12 col-sm-8 col-md-4 countdown-date <?= $isTargetTimeGiven ? 'countdown-date--with-time' : '' ?>" data-countdown data-countdown-target="<?=$targetDateTime->format('Y-m-d\TH:i:s')?>">

  <?php if ($kirby->language()->code() === 'de'): ?>
    <div class="countdown-element">
      <span class="fs-3">
        <?php if ($positiveDiff): ?>
          <?= t('countdown-remaining') ?>
        <?php else: ?>
          <?= t('countdown-carryon') ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>

  <?php
    if ($monthsLeft > 0) {
      snippet('molecules/countdown/countdown-element', [
        'counter' => $monthsLeft,
        'unit' => 'months'
      ]);
    }

    if ($monthsLeft > 0 || $daysLeft > 0) {
      snippet('molecules/countdown/countdown-element', [
        'counter' => $daysLeft,
        'unit' => 'days'
      ]);
    }


    if ($isTargetTimeGiven) {

      if ($monthsLeft > 0 || $daysLeft > 0 || $hoursLeft > 0) {
        snippet('molecules/countdown/countdown-element', [
          'counter' => $hoursLeft,
          'unit' => 'hours'
        ]);
      }

      if ($monthsLeft > 0 || $daysLeft > 0 || $hoursLeft > 0 || $minutesLeft > 0) {
        snippet('molecules/countdown/countdown-element', [
          'counter' => $minutesLeft,
          'unit' => 'minutes'
        ]);
      }

      if ($monthsLeft > 0 || $daysLeft > 0 || $hoursLeft > 0 || $minutesLeft > 0 || $secondsLeft > 0) {
        snippet('molecules/countdown/countdown-element', [
          'counter' => $secondsLeft,
          'unit' => 'seconds'
        ]);
      }

    }
  ?>

  <?php if ($kirby->language()->code() === 'en'): ?>
    <div class="countdown-element">
      <span class="fs-3"><?= t('countdown-remaining') ?></span>
    </div>
  <?php endif; ?>

</div>
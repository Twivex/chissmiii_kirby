<!-- COUNTDOWN -->
<?php
  $today = date_create('now');
  $targetDate = date_create($data->target_date()->toDate('Y-m-d'));
  $diff = $today->diff($targetDate, true);
  $yearsInMonths = $diff->format('%y') * 12;
  $months = $diff->format('%m');
  $monthsLeft = $yearsInMonths + $months;
  $daysLeft = $diff->format('%d');
  $show_title = $show_title ?? $data->show_title()->toBool();
?>
<section class="py-4">
  <div class="row justify-content-center mb-2">
    <div class="col">
      <h2 class="d-flex flex-column gap-2 fs-1 text-center">
        <span class="d-block fs-2">Save the Date!</span>
        <?php if ($show_title): ?>
          <span class="d-block"><?=$data->title()?></span>
        <?php endif; ?>
        <span class="d-block"><?=$targetDate->format('d.m.Y')?></span>
      </h2>
    </div>
  </div>
  <div class="row justify-content-center mb-2">
    <?php snippet('molecules/polaroid', ['image' => $data->cover()->toFile()]); ?>
  </div>

  <div class="row justify-content-center">
    <div class="col d-flex gap-3 justify-content-center">
      <div class="d-inline-fex">
        <p class="fs-3">noch</p>
      </div>
      <div class="d-inline-flex flex-column">
        <p class="fs-3 mb-0 d-flex"><?=$monthsLeft?></p>
        <span class="fs-6 d-flex">Monate</span>
      </div>
      <?php if ($daysLeft > 0): ?>
      <div class="d-inline-flex flex-column">
        <p class="fs-3 mb-0 d-flex">
          <?=$daysLeft?>
        </p>
        <span class="fs-6">Tage</span>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- TODO description -->
</section>
<!-- EO COUNTDOWN -->
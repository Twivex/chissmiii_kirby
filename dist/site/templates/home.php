<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 py-4">

  <!-- COUNTDOWN -->
  <?php
    $today = date_create('now');
    $targetDate = date_create($page->countdownDate()->toDate('Y-m-d'));
    $diff = $today->diff($targetDate, true);
    $yearsInMonths = $diff->format('%y') * 12;
    $months = $diff->format('%m');
    $monthsLeft = $yearsInMonths + $months;
    $daysLeft = $diff->format('%d');
  ?>
  <section>
    <div class="row justify-content-center mb-2">
      <div class="col-xs-12 col-sm-6">
        <h2 class="fs-2 text-center">Save The Date!</h2>
        <h3 class="fs-1 text-center"><?=$page->countdownTitle()?></h3>
        <h3 class="fs-1 text-center"><?=$targetDate->format('d.m.Y')?></h3>
      </div>
    </div>
    <div class="row justify-content-center mb-2">
      <?php snippet('molecules/polaroid', ['image' => $page->countdownImage()->toFile()]); ?>
    </div>

    <div class="row justify-content-center">
      <div class="col-xs-12 col-sm-6 col-md-3 d-flex gap-3 justify-content-center">
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
  </section>
  <!-- EO COUNTDOWN -->

  <section class="mt-5">
    <div class="row justify-content-center mb-2">
      <div class="col">
        <h2 class="fs-2 text-center">To be continued...</h2>
        <h3 class="fs-1 text-center">Updates folgen!</h3>
      </div>
    </div>
  </section>

</main>

<?php snippet('globals/footer') ?>
<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<!-- COUNTDOWN -->
<section class="py-4">

  <div class="row justify-content-center mb-2">
    <div class="col">
      <h2 class="d-flex flex-column gap-2 fs-1 text-center">
        <span class="d-block fs-2">Save the Date!</span>
        <?php if ($page->showTitle()): ?>
          <span class="d-block"><?= $page->title() ?></span>
        <?php endif; ?>
        <span class="d-block"><?= $page->target_date()->toDate('d.m.Y') ?></span>
      </h2>
    </div>
  </div>

  <div class="row justify-content-center mb-2">
    <?php snippet('molecules/polaroid', [
      'image' => $page->cover()->toFile(),
      'size' => '300'
    ]); ?>
  </div>

  <div class="row justify-content-center">
    <?php snippet('molecules/countdown', [
      'targetDate' => $page->target_date(),
      'targetTime' => $page->target_time()
    ]); ?>
  </div>

</section>
<!-- EO COUNTDOWN -->

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
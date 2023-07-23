<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>


<div class="row justify-content-center mt-4 mt-md-5">
  <div class="col-12 col-md-11 d-flex justify-content-center flex-column">

    <?php if ($page->showTitle()): ?>
      <h3 class="<?= $page->headingTextDirectionClass() ?>"><?= $page->title() ?></h3>
    <?php endif; ?>

    <div class="d-flex justify-content-center flex-row">
      <?php snippet('molecules/polaroid', [
        'caption' => $page->role() ?? '',
        'image' => $page->portrait()->toFile(),
        'size' => '300'
      ]); ?>
    </div>

    <?php if (!empty($page->description())): ?>
      <div class="mt-3 mt-md-5 <?= $page->description_text_direction()->directionClass() ?>">
        <?= kt($page->description()); ?>
      </div>
    <?php endif; ?>

  </div>
</div>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
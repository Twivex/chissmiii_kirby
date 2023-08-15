<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<section class="py-4">

<?php snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]); ?>

  <div class="row justify-content-center">
    <div class="col-12 <?= $page->columnsClass() ?> <?= $page->text_direction()->directionClass() ?>">

      <?= kt($page->text()) ?>

    </div>
  </div>

</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
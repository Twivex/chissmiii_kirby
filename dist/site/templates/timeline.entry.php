<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<?php
  $hasDate = $page->tl_date()->isNotEmpty();
  $tl_date = $hasDate ? $page->tl_date() : '';
  if (strpos("$tl_date", '.') === 0) {
    if ("$tl_date" === '.') {
      $tl_date = date_create()->format('Y');
    } elseif ("$tl_date" === '..') {
      $tl_date = date_create()->format('m.Y');
    } elseif ("$tl_date" === '...') {
      $tl_date = date_create()->format('d.m.Y');
    }
  }

  $isTextEntry = $page->tl_type()->value() === 'text';
  $tlTextDirectionClass = $page->tl_text_text_direction()->directionClass();

  $descriptionDirectionClass = $page->description_text_direction()->directionClass();
  $descriptionOrderClass = $isTextEntry ? 'order-1' : 'order-2';

  $tlClasses = ['order-lg-1', 'order-lg-2'];
  if (isset($alternating) && $alternating) {
    $tlEntryClassModifier = 'alternating';
    $tlClassOne = $tlClasses[$page->num() % 2];
    $tlClassTwo = $tlClasses[($page->num() + 1) % 2];
  } else {
    $tlEntryClassModifier = 'strict';
    $tlClassOne = $isTextEntry ? $tlClasses[1] : $tlClasses[0];
    $tlClassTwo = $isTextEntry ? $tlClasses[0] : $tlClasses[1];
  }

?>

<div class="row tl-entry tl-entry--<?= $tlEntryClassModifier?>" timeline-date="<?=$page->tl_date() ?>">

  <?php if ($hasDate): ?>
    <div class="tl-date">
      <div class="tl-date-wrapper">
        <span><?= $tl_date ?></span>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($isTextEntry): ?>

    <div class="col-xs-12 col-lg-6 tl-text <?php e($page->showTitle(), 'tl-text--with-title') ?> order-2 <?= $tlClassOne?> <?=$tlTextDirectionClass ?>">
      <?= kt($page->tl_text()) ?>
    </div>

  <?php else: ?>

    <div class="col-xs-12 col-lg-6 order-1 tl-image <?= $tlClassOne ?>">
      <?php snippet('molecules/polaroid', [
        'image' => $page->tl_image()->toFile(),
        'size' => '300',
        'alt' => $page->title()
      ]); ?>
    </div>

  <?php endif; ?>

  <div class="col-xs-12 col-lg-6 tl-description <?php e($page->showTitle(), 'tl-description--with-title') ?> <?= $descriptionOrderClass?> <?=$tlClassTwo?> <?=$descriptionDirectionClass ?>">

    <?php if ($page->showTitle()): ?>
      <h3 class="<?= $page->headingTextDirectionClass() ?>"><?= $page->title() ?></h3>
    <?php endif; ?>

    <?php e(
      $page->description()->isNotEmpty(),
      kt($page->description())
    ); ?>

  </div>

</div>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
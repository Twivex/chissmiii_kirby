<?php

  $additionalClasses = [];
  if (!empty($addClass)) {
    if (is_array($addClass)) {
      $additionalClasses = $addClass;
    } else {
      $additionalClasses = explode(' ', $addClass);
      $additionalClasses = array_filter($additionalClasses);
      array_walk($additionalClasses, 'trim');
    }
  }
  $additionalClasses = implode(' ', $additionalClasses);

  $headerClasses = '';

  if (!empty($header)) {
    if (isset($header['addClass']) && !empty($header['addClass'])) {
      $headerClasses = implode(' ', $header['addClass']);
    }
  }

  $footerClasses = '';
  if (!empty($footer)) {
    if (isset($footer['addClass']) && !empty($footer['addClass'])) {
      $footerClasses = implode(' ', $footer['addClass']);
    }
  }
?>

<div class="modal" id="<?= $id ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog <?= $size ? 'modal-' . $size : '' ?> <?= $additionalClasses ?>">
    <div class="modal-content">
      <div class="modal-header <?= $headerClasses ?>">
        <?php if (isset($title)): ?>
          <h5 class="modal-title"><?= $title ?></h5>
        <?php endif; ?>
        <?php snippet('atoms/close-button', [
          'target' => 'modal',
          'class' => 'btn-close'
       ] ) ?>
      </div>

      <div class="modal-body">

        <?= $slots->body() ?>

      </div>

      <?php if($footer = $slots->footer()): ?>
        <div class="modal-footer">

            <?= $footer ?>

        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
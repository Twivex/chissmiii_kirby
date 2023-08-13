<?php
  $headerClasses = '';

  if (isset($header)) {
    if (isset($header['addClasses']) && !empty($header['addClasses'])) {
      $headerClasses = implode(' ', $header['addClasses']);
    }
  }
?>

<div class="modal" id="<?= $id ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog <?= $size ? 'modal-' . $size : '' ?>">
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

        <?= $slot ?>

      </div>
    </div>
  </div>
</div>
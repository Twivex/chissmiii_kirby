<div class="modal" id="<?= $id ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog <?= $size ? 'modal-' . $size : '' ?>">
    <div class="modal-content">
      <div class="modal-header">
        <?php if (isset($title)): ?>
          <h5 class="modal-title"><?= $title ?></h5>
        <?php endif; ?>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

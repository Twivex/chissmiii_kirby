<div
  id="<?= $name ?>-alert-<?= $type ?>"
  class="alert alert-small alert-<?= $class ?> alert-dismissible fade visually-hidden mt-3"
  role="alert"
  <?php if(isset($autoclose)) { echo "data-alert-autoclose=\"$autoclose\""; }?>
>
  <span><?= $content ?></span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
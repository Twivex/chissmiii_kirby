<?php
  snippet('molecules/modal/open', [
    'id' => 'modal-upload-form',
    'title' => t('image-upload-modal-title'),
    'size' => 'lg',
  ]);
?>
  <div class="row">
    <div class="col-12">
      <?php snippet('atoms/alert', [
        'name' => 'upload-form',
        'type' => 'info',
        'class' => 'dark',
        'content' => 'Bitte maximal 20 Dateien und insgesamt maximal 200 MB auf einmal hochladen.',
      ]) ?>
      <?php snippet('atoms/alert', [
        'name' => 'upload-form',
        'type' => 'success',
        'class' => 'success',
        'content' => 'Bild(er) erfolgreich hochgeladen.',
        'hidden' => true,
        'close' => true,
        'autoclose' => '5000',
        ]) ?>

      <?php snippet('atoms/alert', [
        'name' => 'upload-form',
        'type' => 'error',
        'class' => 'danger',
        'content' => 'Bild(er) konnte(n) nicht hochgeladen werden.',
        'hidden' => true,
        'close' => true,
        'autoclose' => '5000',
      ]) ?>
    </div>
  </div>
  <form
    data-upload-form
    data-upload-form-alert-error="upload-form-alert-error"
    data-upload-form-alert-success="upload-form-alert-success"
    id="upload-form-<?= $page->uid() ?>"
    action="upload/<?= $page->uri() ?>"
    method="POST"
    enctype="multipart/form-data"
    class="needs-validation"
    novalidate
  >
    <fieldset>

      <div class="mb-3">
        <input class="form-control" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,video/mp4,video/avi,video/mpeg,video/mpeg2,video/quicktime,video/webm" id="uploadFile" name="uploadFile[]" required multiple>
      </div>

      <div class="visually-hidden">
        <input type="website" name="website" id="website"
          value="<?= isset($form_data['website']) ? esc($form_data['website']) : null ?>" />
      </div>

      <button type="submit" class="btn btn-primary"><?= t('image-upload-modal-submit') ?></button>

    </fieldset>
  </form>
<?php snippet('molecules/modal/close') ?>
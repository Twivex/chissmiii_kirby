<div class="row justify-content-center mt-4 mt-md-5">
  <div class="col-12 col-md-11 d-flex justify-content-center flex-column">

    <?php if ($data->showTitle()): ?>
      <h3 class="<?= $data->headingTextDirectionClass() ?>"><?= $data->title() ?></h3>
    <?php endif; ?>

    <div class="d-flex justify-content-center flex-row">
      <?php snippet('molecules/polaroid', [
        'caption' => $data->role() ?? '',
        'image' => $data->portrait()->toFile(),
        'size' => '300'
      ]); ?>
    </div>

    <?php if (!empty($data->description())): ?>
      <div class="mt-3 mt-md-5 <?= $data->description_text_direction()->directionClass() ?>">
        <?= kt($data->description()); ?>
      </div>
    <?php endif; ?>

  </div>
</div>
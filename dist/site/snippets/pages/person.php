<div class="row justify-content-center mt-4 mt-md-5">
  <?php if ($data->show_title()->toBool() === true): ?>
    <h3><?=$data->title()?></h3>
  <?php endif; ?>
  <div class="col-12 col-md-11 d-flex justify-content-center flex-column">
    <div class="d-flex justify-content-center flex-row">
      <?php snippet('molecules/polaroid', [
        'caption' => $data->role() ?? '',
        'image' => $data->portrait()->toFile(),
        'size' => '300'
      ]); ?>
    </div>
    <?php if (!empty($data->description())): ?>
      <div class="mt-3 mt-md-5">
        <?= kt($data->description()); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
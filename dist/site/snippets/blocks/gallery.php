<div id="carousel-<?= $block->id() ?>" class="carousel slide bg-dark" data-bs-interval="false">

  <?php if ($showIndicators): ?>
    <div class="carousel-indicators">
      <?php for ($i = 0; $i < $block->images()->toFiles()->count(); $i++): ?>
        <button type="button" data-bs-target="#carousel-<?= $block->id()?>" data-bs-slide-to="<?=$i?>" <?= $i === 0 ? 'class="active" aria-current="true"' : ''?> aria-label="Slide <?=$i+1 ?>"></button>
      <?php endfor; ?>
    </div>
  <?php endif; ?>

  <div class="carousel-inner" style="max-height: 100vh">
    <?php $isFirst = true; ?>
    <?php foreach ($block->images()->toFiles() as $image): ?>
      <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
       <div class="d-flex justify-content-center align-items-center m-0" style="height: calc(100vh - 56px)">
         <img src="<?= $image->url() ?>" srcset="<?= $image->srcset()?>" class="d-block mw-100 mh-100" alt="<?=$image->title() ?>">
        </div>
      </div>
      <?php $isFirst = false; ?>
    <?php endforeach; ?>
  </div>

  <?php if ($showControls): ?>
    <button class="carousel-control-prev w-7 bg-no-gradient" type="button" data-bs-target="#carousel-<?= $block->id() ?>" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next w-7 bg-no-gradient" type="button" data-bs-target="#carousel-<?= $block->id() ?>" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  <?php endif; ?>
</div>

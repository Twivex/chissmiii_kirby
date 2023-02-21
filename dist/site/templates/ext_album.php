<?php snippet('globals/header') ?>

<?php
  $imagesPath = $page->album_images_path();
  $files = $page->getExtAlbumImages();
?>

<section>
  <div id="carousel-<?= $page->uid() ?>" class="carousel slide" data-bs-interval="false" data-bs-touch="true">

    <?php if ($page->show_indicators()->toBool()): ?>
      <div class="carousel-indicators">
        <?php for ($i = 0; $i < count($images); $i++): ?>
          <button type="button" data-bs-target="#carousel-<?= $page->uid()?>" data-bs-slide-to="<?=$i?>" <?= $i === 0 ? 'class="active" aria-current="true"' : ''?> aria-label="Slide <?=$i+1 ?>"></button>
        <?php endfor; ?>
      </div>
    <?php endif; ?>

    <div class="carousel-inner" style="max-height: 100vh">
      <?php foreach ($files as $k => $file): ?>
        <?php $isPortrait = false; ?>
        <div class="carousel-item <?= $k === 0 ? 'active' : '' ?> bg-black">
        <div class="d-flex justify-content-center align-items-center m-0" style="height: calc(100vh - 56px)">
          <?php if ($file['type'] === 'image'): ?>
            <img src="<?= $file['url'] ?>" class="d-page mw-100 mh-100" >
          <?php elseif ($file['type'] === 'video'): ?>
            <video class="d-page mw-100 mh-100" controls>
              <source src="<?= $file['url'] ?>" type="video/mp4">
            </video>
          <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if ($page->show_controls()->toBool()): ?>
      <button class="carousel-control-prev w-7 bg-no-gradient" type="button" data-bs-target="#carousel-<?= $page->uid() ?>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next w-7 bg-no-gradient" type="button" data-bs-target="#carousel-<?= $page->uid() ?>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    <?php endif; ?>
  </div>

</section>

<?php snippet('globals/footer') ?>
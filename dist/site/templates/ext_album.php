<?php snippet('globals/header') ?>

<?php
  $files = $page->getAlbumFiles(true);
  $fileCount = count($files);
?>

<section>

  <?php
    snippet('atoms/section-heading', [
      'data' => $page,
      'showParentTitle' => $page->parent() !== null,
    , 'injected' => $isInjected
    ]);
  ?>

  <?php if ($page->isSecured() && !$page->userHasAccess()):
    snippet('components/pwonly-login', ['accessUserEmail' => $page->getAccessUser()->email()]);
  else: ?>



    <div id="carousel-<?= $page->uid() ?>" class="carousel slide" data-bs-interval="false" data-bs-touch="true" data-lazy-load="true">

      <?php if ($page->show_indicators()->toBool() && $fileCount > 1): ?>
        <div class="carousel-indicators">
          <?php for ($i = 0; $i < $fileCount; $i++): ?>
            <button type="button" data-bs-target="#carousel-<?= $page->uid()?>" data-bs-slide-to="<?=$i?>" <?= $i === 0 ? 'class="active" aria-current="true"' : ''?> aria-label="Slide <?=$i+1 ?>"></button>
          <?php endfor; ?>
        </div>
      <?php endif; ?>

      <div class="carousel-inner" style="max-height: 100vh">
        <?php foreach ($files as $k => $file): ?>
          <div class="carousel-item <?= $k === 0 ? 'active' : '' ?> bg-black" data-carousel-index="<?=$k?>">

            <div class="d-flex justify-content-center align-items-center m-0" style="height: calc(100vh - 232px)">
              <?php if ($file['type'] === 'image'): ?>

                <img data-src="<?= $file['url'] ?>" class="d-page mw-100 mh-100" >

              <?php elseif ($file['type'] === 'video'): ?>

                <video class="d-page mw-100 mh-100" controls preload="metadata">
                  <source src="<?= $file['url'] ?>" type="video/mp4">
                </video>

              <?php endif; ?>

              <?php
                if ($page->downloadable()->toBool()) {
                  snippet('atoms/fab', [
                    'title' => 'Album herunterladen',
                    'size' => 'large',
                    'iconName' => 'download_for_offline',
                    'additionalClasses' => ['fab-br'],
                    'url' => $file['url'],
                    'attributes' => [
                      'data-download' => 'false',
                      'download' => $file['name'],
                    ],
                  ]);
                }
              ?>
            </div>

          </div>
        <?php endforeach; ?>
      </div>

      <?php if ($page->show_controls()->toBool() && $fileCount > 1): ?>
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

  <?php endif; ?>

</section>

<?php snippet('globals/footer') ?>
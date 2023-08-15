<?php snippet('globals/header') ?>

<?php
  $isInjected = isset($injected) && $injected === true;
  $files = $page->getAlbumFiles(true);
  $fileCount = count($files);
  $uid = $page->uid();
  $imgPlaceholderImage = $site->files()->filterBy('tags','img_placeholder')->first();
  $videoPlaceholderImage = $site->files()->filterBy('tags','video_placeholder')->first();
?>

<section>

    <?php
      snippet('atoms/section-heading', [
        'data' => $page,
        'showParentTitle' => $page->parent() !== null,
        'injected' => $isInjected
      ]);
    ?>

  <?php if ($page->isSecured() && !$page->userHasAccess()):
    snippet('components/pwonly-login', ['accessUserEmail' => $page->getAccessUser()->email()]);
  else: ?>

    <div class="mm-masonry" data-target-modal="#modal-gallery-slider-<?= $uid ?>" data-target-carousel="#carousel-<?= $uid ?>">

      <?php foreach ($files as $k => $file): ?>

        <?php if ($file['type'] === 'image'): ?>

          <div
            class="mm-masonry__item cursor-pointer position-relative"
            style="--w: <?=$imgPlaceholderImage->width()?>; --h: <?=$imgPlaceholderImage->height()?>;"
            data-gallery-index="<?= $k ?>">

            <img
              class="mm-masonry__img img-fluid mb-md-0 mb-3"
              src="<?= $imgPlaceholderImage->url() ?>"
              data-src="/thumbnail?file=<?= urlencode($file['url']) ?>"
            />
          </div>

        <?php elseif ($file['type'] === 'video'): ?>

          <div
            class="mm-masonry__item cursor-pointer position-relative"
            style="--w: <?=$videoPlaceholderImage->width()?>; --h: <?=$videoPlaceholderImage->height()?>;"
            data-gallery-index="<?= $k ?>">

            <div data-show-on-loaded class="d-none d-flex position-absolute top-0 left-0 w-100 h-100 bg-dimmed justify-content-center align-items-center">
              <i class="material-symbols-rounded material-sybmols-outline text-white fs-extreme-large">videocam</i>
            </div>

            <img
              class="mm-masonry__img img-fluid mb-md-0 mb-3"
              src="<?= $videoPlaceholderImage->url() ?>"
              data-src="/thumbnail?file=<?= urlencode($file['url']) ?>"
            />

          </div>

        <?php endif; ?>

      <?php endforeach; ?>

    </div>



    <?php snippet('molecules/modal', [
      'id' => 'modal-gallery-slider-' . $uid,
      'size' => 'fullscreen',
      'addClass' => $page->show_indicators()->toBool() ? 'has-slider-indicators' : '',
      'footer' => [
        'addClass' => ['']
      ]
    ], slots: true); ?>
      <?php slot('body'); ?>
        <div
          id="carousel-<?= $uid ?>"
          class="carousel slide <?= $page->show_indicators()->toBool() ? 'has-indicators' : '' ?>"
          data-download-button="media-download-<?= $uid ?>"
          data-bs-interval="false"
          data-bs-touch="true"
          data-lazy-load="true"
          data-slider-init="true">

          <div class="carousel-inner">
            <?php foreach ($files as $k => $file): ?>
              <div class="carousel-item <?= $k === 0 ? 'active' : '' ?>" data-carousel-index="<?=$k?>">

                <div class="d-flex h-100 justify-content-center align-items-center <?= $file['type'] === 'video' ? 'has-video' : '' ?>">
                  <?php if ($file['type'] === 'image'): ?>

                    <img
                      src="<?= $imgPlaceholderImage->url() ?>"
                      data-src="<?= $file['url'] ?>"
                    >

                  <?php elseif ($file['type'] === 'video'): ?>
                    <div class="d-flex align-items-center">
                      <video
                        preload="metadata"
                        poster="/thumbnail?file=<?= urlencode($file['url']) ?>"
                        controls>
                        <source
                        src="<?= $file['url'] ?>"
                        type="video/mp4">
                      </video>
                    </div>
                  <?php endif; ?>
                </div>

              </div>
            <?php endforeach; ?>
          </div>

          <?php if ($page->show_controls()->toBool() && $fileCount > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $uid ?>" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $uid ?>" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          <?php endif; ?>

          <?php if ($page->show_indicators()->toBool() && $fileCount > 1): ?>
            <div class="carousel-indicators">
              <?php foreach ($files as $k => $file): ?>
                  <button type="button" data-bs-target="#carousel-<?= $uid ?>" data-bs-slide-to="<?= $k ?>" <?= $k === 0 ? 'class="active" aria-current="true"' : '' ?> aria-label="Slide <?= $k+1 ?>">
                    <?php if ($file['type'] === 'image'): ?>

                      <img
                        alt="Slide <?= $k + 1 ?>"
                        src="<?= $imgPlaceholderImage->url() ?>"
                        data-src="/thumbnail?file=<?= urlencode($file['url']) ?>&width=360&height=240"
                      />

                    <?php elseif ($file['type'] === 'video'): ?>

                      <div data-show-on-loaded class="d-none d-flex position-absolute top-0 left-0 w-100 h-100 bg-dimmed justify-content-center align-items-center">
                        <i class="material-symbols-rounded material-sybmols-outline text-white fs-1">videocam</i>
                      </div>

                      <img
                        alt="Slide <?= $k + 1 ?>"
                        src="<?= $videoPlaceholderImage->url() ?>"
                        data-src="/thumbnail?file=<?= urlencode($file['url']) ?>&width=360&height=240"
                      />

                    <?php endif; ?>
                  </button>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endslot(); ?>
      <?php
        slot('footer');
        if ($page->downloadable()->toBool()) {
          snippet('atoms/fab', [
            'title' => 'Datei herunterladen',
            'iconSize' => 'large',
            'iconName' => 'download',
            'additionalClasses' => ['btn-primary'],
            'attributes' => [
              'id' => 'media-download-' . $uid,
              'data-download' => 'false',
            ],
          ]);
        }
        endslot();
      ?>
    <?php endsnippet(); ?>

  <?php endif; ?>

</section>

<?php snippet('globals/footer') ?>
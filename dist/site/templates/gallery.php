<?php snippet('globals/header') ?>

<section class="pt-4">
  <?php
    $galleryPages = $page->children()->listed();
    foreach ($galleryPages as $galleryPage):
  ?>
    <div class="row">
      <div class="col-12">
        <?php
          $lang = $kirby->language();
          $galleryUri = $galleryPage->uri();
          $additionalLinks = [];
          if ($galleryPage->uploadable()->toBool()) {
            $additionalLinks[] = [
              'title' => 'Dateien hochladen',
              'uri' => "/$lang/upload/$galleryUri",
              'attributes' => [
                'data-bs-toggle' => 'modal',
                'data-bs-target' => '#modal-upload-form',
              ],
            ];
          }
          if ($galleryPage->downloadable()->toBool()) {
            $additionalLinks[] = [
              'title' => 'Album herunterladen',
              'type' => 'icon',
              'icon' => 'download_for_offline',
              'uri' => "/$lang/download/$galleryUri",
              'attributes' => [
                'data-download' => 'false',
              ]
            ];
          }
          $imageAlt = '';
          $imageUrl = '';
          $blueprintName = strtolower($galleryPage->intendedTemplate());
          if ($blueprintName === 'album') {
            $firstImage = $galleryPage->images()->first();
            $imageUrl = $firstImage->url();
            $imageAlt = $firstImage->title();
          } else if ($blueprintName === 'ext_album') {
            $files = $galleryPage->getExtAlbumImages();
            $images = array_filter($files, function($file) {
              return $file['type'] === 'image';
            });
            if (isset($images[0])) {
              $firstImage = $images[0];
              $imageUrl = $firstImage['url'];
            }
          }

          snippet('molecules/img_card_horizontal', [
            'imageUrl' => $imageUrl,
            'imageAlt' => $imageAlt,
            'title' => $galleryPage->title(),
            'modifiedDate' => $galleryPage->modified('d.m.y'),
            'pageLinkUri' => $galleryPage->uri(),
            'pageLinkTitle' => 'Album öffnen',
            'additionalLinks' => $additionalLinks,
            'addClass' => 'mb-4',
            'imgWidth' => 4,
            'textWidth' => 8,
          ]);
        ?>
      </div>
    </div>
  <?php endforeach ?>
</section>

<?php snippet('components/upload-modal') ?>

<?php snippet('globals/footer') ?>
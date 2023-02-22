<?php snippet('globals/header') ?>

<section class="pt-4">
  <?php
    $lang = $kirby->language();
    $galleryPages = $page->children()->listed();
    foreach ($galleryPages as $galleryPage):
  ?>
    <div class="row">
      <div class="col-12">
        <?php
          $title = $galleryPage->title();
          $imageAlt = $title;
          $galleryUri = $galleryPage->uri();
          $modifiedDate = $galleryPage->modified('d.m.Y');

          $imageUrl = '';
          $blueprintName = strtolower($galleryPage->intendedTemplate());
          if ($blueprintName === 'album') {
            $files = $galleryPage->files();
            $mediaCount = $files->count();
            $firstImage = $galleryPage->images()->first();
            $imageUrl = $firstImage->url();
            $imageAlt = $firstImage->title();
          } else if ($blueprintName === 'ext_album') {
            $files = $galleryPage->getAlbumFiles(true);
            $mediaCount = count($files);
            $images = array_filter($files, function($file) {
              return $file['type'] === 'image';
            });
            if (!empty($images)) {
              $firstImage = $images[0];
              $imageUrl = $firstImage['url'];
              $modifiedDate = filemtime($files[$mediaCount - 1]['path']);
              $mDate = date('d.m.Y', $modifiedDate);
              $mTime = date('H:i', $modifiedDate);
              $modifiedDate = "$mDate um $mTime Uhr";
            }
          }

          $mediaCountLabel = '<span class="fs-6 text-muted">';
          $mediaCountLabel .= " ($mediaCount Datei";
          if ($mediaCount > 1 || $mediaCount === 0) {
            $mediaCountLabel .= 'en';
          }
          $mediaCountLabel .= ')';
          $mediaCountLabel .= '</span>';
          $title .= $mediaCountLabel;
          $showPageLinkBtn = !empty($files);
          $pageLinkUri = "/$lang/".$galleryPage->uri();
          $pageLinkTitle = 'Album öffnen';

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
          if ($galleryPage->downloadable()->toBool() && !empty($files)) {
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
          $addClass = 'mb-4';
          $imgWidth = 4;
          $textWidth = 8;
          snippet('molecules/img_card_horizontal', compact(
            'imageUrl',
            'imageAlt',
            'title',
            'modifiedDate',
            'showPageLinkBtn',
            'pageLinkUri',
            'pageLinkTitle',
            'additionalLinks',
            'addClass',
            'imgWidth',
            'textWidth'
          ));
        ?>
      </div>
    </div>
  <?php endforeach ?>
</section>

<?php snippet('components/upload-modal') ?>

<?php snippet('globals/footer') ?>
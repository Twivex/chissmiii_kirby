<?php snippet('globals/header') ?>

<section>

  <?php if ($page->isSecured() && !$page->userHasAccess()):
    snippet('components/pwonly-login', ['accessUserEmail' => $page->getAccessUser()->email()]);
  else: ?>

  <?php snippet('atoms/section-heading', [ 'data' => $page ]); ?>

  <?php
    $lang = $kirby->language();
    $galleryPages = $page->children()->listed();
    foreach ($galleryPages as $galleryPage):
  ?>
    <div class="row">
      <div class="col-12">
        <?php
          $title = $galleryPage->title();

          $galleryUri = $galleryPage->uri();
          $modifiedDate = $galleryPage->modified('d.m.Y');

          $imageAlt = '';
          $imageUrl = '';
          if ($galleryPage->album_cover()->isNotEmpty()) {
            $imageUrl = $galleryPage->album_cover()->toFile()->url();
          }

          $blueprintName = strtolower($galleryPage->intendedTemplate());
          if ($blueprintName === 'album') {
            $files = $galleryPage->files();
            $mediaCount = $files->count();
            $firstImage = $galleryPage->images()->first();
            $imageAlt = $firstImage->title();
            if (empty($imageUrl)) {
              $imageUrl = $firstImage->url();
            }
          } else if ($blueprintName === 'ext_album') {
            $files = $galleryPage->getAlbumFiles(true);
            $mediaCount = count($files);
            $images = array_filter($files, function($file) {
              return $file['type'] === 'image';
            });
            if (!empty($images)) {
              $firstImage = $images[0];
              $modifiedDate = filemtime($files[$mediaCount - 1]['path']);
              $mDate = date('d.m.Y', $modifiedDate);
              $mTime = date('H:i', $modifiedDate);
              $modifiedDate = "$mDate um $mTime Uhr";
              if (empty($imageUrl)) {
                $imageUrl = $firstImage['url'];
              }
            }
          }
          if (empty($imageAlt)) {
            $imageAlt = $title;
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

<?php endif; ?>

<?php snippet('globals/footer') ?>
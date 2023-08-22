<section>
  <div class="row">
    <div class="col-12">
      <?php
        $title = $albumPage->title();

        $albumUri = $albumPage->uri();
        $modifiedDate = $albumPage->modified('d.m.Y');

        $imageAlt = '';
        $imageUrl = '';
        if ($albumPage->album_cover()->isNotEmpty()) {
          $imageUrl = $albumPage->album_cover()->toFile()->resize(1200)->url();
        }

        $blueprintName = strtolower($albumPage->intendedTemplate());
        if ($blueprintName === 'album') {
          $files = $albumPage->files();
          $mediaCount = $files->count();
          $firstImage = $albumPage->images()->first();
          $imageAlt = $firstImage->title();
          if (empty($imageUrl)) {
            $imageUrl = $firstImage->url();
          }
        } else if ($blueprintName === 'ext_album' || $blueprintName === 'ext_album2') {
          $files = $albumPage->getAlbumFiles(true);
          $mediaCount = count($files);
          $images = array_filter($files, function($file) {
            return $file['type'] === 'image';
          });
          if (!empty($images)) {
            $firstImage = array_shift($images);
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
        $pageLinkUri = $kirby->language()->url() . '/' . $albumPage->uri();
        $pageLinkTitle = 'Album öffnen';

        $additionalLinks = [];
        if ($albumPage->uploadable()->toBool()) {
          $additionalLinks[] = [
            'title' => 'Dateien hochladen',
            'uri' => $kirby->language()->url() . "/upload/$albumUri",
            'attributes' => [
              'data-bs-toggle' => 'modal',
              'data-bs-target' => '#modal-upload-form',
            ],
          ];
        }
        if ($albumPage->downloadable()->toBool() && !empty($files)) {
          $additionalLinks[] = [
            'title' => 'Album herunterladen',
            'type' => 'icon',
            'icon' => 'download',
            'uri' => $kirby->language()->url() . "/download/$albumUri",
            'additionalClasses' => ['btn-circled', 'btn-circled-large'],
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
</section>

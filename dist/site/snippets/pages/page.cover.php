<div class="row">
  <div class="col-12">
    <?php
      $title = $page->title();
      $description = $page->pages_gallery_description();
      $pageType = $page->pages_gallery_type();
      $imageUrl = '';
      $imageAlt = $title;
      $cover = $page->pages_gallery_cover()->toFile();
      if ($cover) {
        $imageUrl = $cover->url();
        $imageAlt = $cover->title()->isNotEmpty() ? $cover->title() : $imageAlt;
      }
      $showPageLinkBtn = true;
      $pageLinkUri = $page->url();
      $pageLinkTitle = "$pageType öffnen";
      $addClass = 'mb-4';
      $imgWidth = 4;
      $textWidth = 8;
      snippet('molecules/img_card_horizontal', compact(
        'imageUrl',
        'imageAlt',
        'title',
        'description',
        'showPageLinkBtn',
        'pageLinkUri',
        'pageLinkTitle',
        'addClass',
        'imgWidth',
        'textWidth'
      ));
    ?>
  </div>
</div>
<section class="pt-4">

  <?php
    $lang = $kirby->language();
    $subPages = $page->children()->listed();
    foreach ($subPages as $subPage):
  ?>
    <div class="row">
      <div class="col-12">
        <?php
          $title = $subPage->title();
          $description = $subPage->pages_gallery_description();
          $pageType = $subPage->pages_gallery_type();
          $imageUrl = '';
          $imageAlt = $title;
          $cover = $subPage->pages_gallery_cover()->toFile();
          if ($cover) {
            $imageUrl = $cover->url();
            $imageAlt = $cover->title()->isNotEmpty() ? $cover->title() : $imageAlt;
          }
          $showPageLinkBtn = true;
          $pageLinkUri = $subPage->url();
          $pageLinkTitle = "$pageType öffnen";
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
            'imgWidth',
            'textWidth'
          ));
        ?>
      </div>
    </div>

  <?php endforeach ?>
</section>
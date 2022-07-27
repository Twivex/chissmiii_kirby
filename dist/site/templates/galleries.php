<?php snippet('globals/header') ?>

<section class="pt-4">
  <?php
    $galleryPages = $page->children()->listed();
    foreach ($galleryPages as $galleryPage): ?>
    <div class="row">
      <div class="col-12">
        <?php snippet('molecules/img_card_horizontal', [
          'imageUrl' => $galleryPage->images()->first()->url(),
          'imageAlt' => $galleryPage->images()->first()->title(),
          'title' => $galleryPage->title(),
          'modifiedDate' => $galleryPage->modified('d.m.y'),
          'pageLinkUri' => $galleryPage->uri(),
          'pageLinkTitle' => 'Album öffnen',
          'addClass' => 'mb-4'
        ]); ?>
      </div>
    </div>
  <?php endforeach ?>
</section>

<?php snippet('globals/footer') ?>
<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">

<section class="pt-4">
  <?php
    $galleryPages = $page->children()->listed();
    foreach ($galleryPages as $galleryPage): ?>
    <div class="row">
      <div class="col-12">
        <?php snippet('molecules/img_card_horizontal', [
          'imgWidth' => '4',
          'textWidth' => '8',
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
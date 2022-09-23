<?php
  $bgImages = $site->files()->filterBy('tag', 'background');
  if ($bgImages->count() > 0):
    $bgImg = $bgImages->first();
?>
  <picture class="background-img">
    <source
      type="<?= $bgImg->mime() ?>"
      srcset="<?= $bgImg->srcset([
        '780w' => [ 'width' => 780 ],
        '1024w' => [ 'width' => 1024 ],
        '1440w' => [ 'width' => 1440 ],
        '2400w' => [ 'width' => 2400 ]
      ]) ?>"
      sizes="100vw"
    >
    <img src="<?= $bgImg->url() ?>" alt="<?= $bgImg ? $bgImg->title() : '' ?>">
  </picture>
<?php endif; ?>
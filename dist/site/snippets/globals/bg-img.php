<?php
  $bgImages = $site->files()->filterBy('tag', 'background');
  if ($bgImages->count() > 0):
    $bgImg = $bgImages->first();
?>
  <picture class="background-img">
    <source srcset="<?=$bgImg->srcset([
      '780w' => [ 'width' => 780 ],
      '1024w' => [ 'width' => 1024 ],
      '1440' => [ 'width' => 1440 ],
      '2400w' => [ 'width' => 2400 ]
    ])?>"
    >
    <img src="<?=$bgImg->url()?>">
  </picture>
<?php endif; ?>
<picture class="background-img">
  <source
    type="<?= $img->mime() ?>"
    srcset="<?= $img->srcset([
      '450w' => [ 'width' => 450 * 1.2],
      '780w' => [ 'width' => 780 * 1.2 ],
      '1024w' => [ 'width' => 1024 * 1.2 ],
      '1440w' => [ 'width' => 1440 * 1.2 ],
      '2400w' => [ 'width' => 2400 * 1.2 ]
    ]) ?>"
    sizes="100vw"
  >
  <img src="<?= $img->url() ?>" alt="<?= $img ? $img->title() : '' ?>">
</picture>
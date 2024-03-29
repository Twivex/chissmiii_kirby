<?php
  $caption = $caption ?? ($image ? $image->title() : '');
  $size = $size ?? 200;
  $doubleSize = $size * 2;
  $tripleSize = $size * 3;
?>

<div class="polaroid polaroid-<?= $size ?>">
  <figure class="figure">

    <?php if ($image): ?>

      <img
        class="figure-img"
        src="<?= $image->url() ?>"
        srcset="<?= $image->srcset([
          $size . "w" => [ 'width' => $size, 'height' => $size ],
          $doubleSize . "w" => [ 'width' => $doubleSize, 'height' => $doubleSize ],
          $tripleSize . "w" => [ 'width' => $tripleSize, 'height' => $tripleSize ]
        ]) ?>"
        sizes="100vw"
        width="<?= $size ?>"
        height="<?= $size ?>"
        alt="<?= $alt ?? $caption ?>">

    <?php else: ?>

      <img src="https://via.placeholder.com/<?= $size ?>" alt="Placeholder <?= $size ?>x<?= $size ?>">

    <?php endif; ?>

    <figcaption class="figure-caption">
      <p><?= $caption ?></p>
    </figcaption>

  </figure>
</div>
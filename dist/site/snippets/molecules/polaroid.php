<?php
  $caption = $caption ?? ($image ? $image->title() : '');
  $size = $size ?? 200;
?>
<div class="polaroid polaroid-<?= $size ?>">
  <figure class="figure">
    <?php if ($image): ?>
      <img
        class="figure-img"
        src="<?= $image->url() ?>"
        srcset="<?= $image->srcset([
          "1x" => [ 'width' => $size],
          "2x" => [ 'width' => $size * 2],
          "3x" => [ 'width' => $size * 3]
        ]) ?>"
        alt="<?=$alt ?? $caption?>">
    <?php else: ?>
      <img src="https://via.placeholder.com/<?= $size ?>" alt="Placeholder <?=$size?>x<?=$size?>">
    <?php endif; ?>
    <figcaption class="figure-caption">
      <p><?= $caption ?></p>
    </figcaption>
  </figure>
</div>
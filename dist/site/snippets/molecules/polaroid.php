<?php
  $caption = $caption ?? ($image ? $image->title() : '');
  $size = $size ?? 200;
?>
<div class="polaroid polaroid-<?=$size?>" polaroid-caption="<?=$caption?>">
  <?php if ($image): ?>
    <img
      src="<?=$image->url()?>"
      srcset="<?=$image->srcset([
        "1x" => [ 'width' => $size],
        "2x" => [ 'width' => $size * 2],
        "3x" => [ 'width' => $size * 3]
      ])?>"
      alt="<?=$alt ?? $caption?>">
  <?php else: ?>
    <img src="https://via.placeholder.com/<?=$size?>" alt="Placeholder <?=$size?>x<?=$size?>">
  <?php endif; ?>
</div>
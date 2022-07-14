<?php
  $caption = $caption ?? ($image ? $image->title() : '');
?>
<div class="polaroid" polaroid-caption="<?=$caption?>">
  <?php if ($image): ?>
    <img src="<?=$image->url()?>" srcset="<?=$image->srcset()?>" alt="<?=$image->title()?>">
  <?php else: ?>
    <img src="https://via.placeholder.com/200" alt="Placeholder 200x200">
  <?php endif; ?>
</div>
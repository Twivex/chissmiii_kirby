<?php
  $iconSize = !empty($iconSize) ? $iconSize : 'large';
?>

<a
  class="btn btn-icon <?=!empty($additionalClasses) ? implode(' ', $additionalClasses) : '' ?>"
  <?php if (!empty($attributes)): ?>
    <?php foreach ($attributes as $attr => $value) { echo "$attr=\"$value\""; } ?>
  <?php endif; ?>
  <?php if (!empty($url)): ?>
    href="<?= $url ?>"
  <?php endif; ?>
  <?php if (!empty($title)): ?>
    title="<?= $title ?>"
  <?php endif; ?>
><i class="material-symbols-rounded <?= "material-symbols-$iconSize"?>"><?= $iconName ?></i></a>
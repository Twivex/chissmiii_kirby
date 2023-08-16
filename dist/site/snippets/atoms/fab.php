<a
  class="fab <?= !empty($size) ? 'fab-' . $size : '' ?> <?= !empty($additionalClasses) ? implode(' ', $additionalClasses) : '' ?>"
  <?php if (!empty($attributes)): ?>
    <?php foreach ($attributes as $attr => $value) { echo "$attr=\"$value\""; } ?>
  <?php endif; ?>
  <?php if (!empty($url)): ?>
    href="<?= $url ?>"
  <?php endif; ?>
  <?php if (!empty($title)): ?>
    title="<?= $title ?>"
  <?php endif; ?>
><i class="material-symbols-rounded <?= !empty($size) ? 'material-symbols-' . $size : ''?>"><?= $iconName ?></i></a>
<a
  class="fab <?=!empty($additionalClasses) ? implode(' ', $additionalClasses) : '' ?>"
  <?php if ($attributes): ?>
    <?php foreach ($attributes as $attr => $value) { echo "$attr=\"$value\""; } ?>
  <?php endif; ?>
  <?php if (isset($url) && !empty($url)): ?>
    href="<?= $url ?>"
  <?php endif; ?>
  <?php if (isset($title) && !empty($title)): ?>
    title="<?= $title ?>"
  <?php endif; ?>
><i class="material-symbols-rounded <?= isset($iconSize) ? "ms-$iconSize" : ''?>"><?= $iconName ?></i></a>
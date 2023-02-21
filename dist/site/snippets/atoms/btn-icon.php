<a
  class="ms-1 btn-icon <?=!empty($additionalClasses) ? implode(' ', $additionalClasses) : '' ?>"
  <?php if ($attributes): ?>
    <?php foreach ($attributes as $attr => $value) { echo "$attr=\"$value\""; } ?>
  <?php endif; ?>
  <?php if ($url): ?>
    href="<?= $url ?>"
  <?php endif; ?>
  <?php if ($title): ?>
    title="<?= $title ?>"
  <?php endif; ?>
><i class="material-symbols-rounded <?= isset($iconSize) ? "ms-$iconSize" : ''?>"><?= $iconName ?></i></a>
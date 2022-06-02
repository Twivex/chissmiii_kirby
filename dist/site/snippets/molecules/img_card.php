<?php
  $additionalClasses = [];
  if (!empty($addClass)) {
    if (is_array($addClass)) {
      $additionalClasses = $addClass;
    } elseif (!empty($addClass)) {
      $additionalClasses = explode(' ', $addClass);
      $additionalClasses = array_filter($additionalClasses);
      array_walk($additionalClasses, 'trim');
    }
  }
  if (isset($noBorder) && $noBorder === true) {
    $additionalClasses[] = 'border';
    $additionalClasses[] = 'border-transparent';
  }
  $additionalClasses = implode(' ', $additionalClasses);
?>

<div class="card <?=$additionalClasses?>">
  <img src="<?=$imageUrl?>" class="card-img-top" alt="<?=$imageAlt?>">
  <div class="card-body">
    <h5 class="card-title"><?=$title?></h5>
    <?php if (isset($description) && !empty($description)): ?>
      <p class="card-text"><?=kt($description)?></p>
    <?php endif; ?>
    <?php if ($additionalContent) { echo $additionalContent; } ?>
    <a href="<?=$pageUri?>" class="btn btn-light">Go somewhere</a>
  </div>
</div>
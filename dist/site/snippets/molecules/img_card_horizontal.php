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
  $additionalClasses = implode(' ', $additionalClasses);
?>

<div class="card <?=$additionalClasses?>">
  <div class="row g-0">
    <div class="col-md-<?=$imgWidth?>">
      <img src="<?=$imageUrl?>" class="img-fluid rounded-start vh-25" alt="<?=$imageAlt?>">
    </div>
    <div class="col-md-<?=$textWidth?>">
      <div class="card-body">
        <h5 class="card-title"><?=$title?></h5>
        <?php if (isset($description) && !empty($description)): ?>
          <p class="card-text"><?=kt($description)?></p>
        <?php endif; ?>
        <?php if (isset($modifiedDate) && !empty($modifiedDate)): ?>
          <p class="card-text"><small class="text-muted">Zuletzt aktualisiert am <?=$modifiedDate?></small></p>
        <?php endif; ?>
        <a href="<?=$pageLinkUri?>" class="btn btn-light"><?=$pageLinkTitle?></a>
      </div>
    </div>
  </div>
</div>
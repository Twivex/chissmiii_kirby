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

  $additionalImgClasses = [];
  if (!empty($addImgClass)) {
    if (is_array($addImgClass)) {
      $additionalImgClasses = $addImgClass;
    } elseif (!empty($addImgClass)) {
      $additionalImgClasses = explode(' ', $addImgClass);
      $additionalImgClasses = array_filter($additionalImgClasses);
      array_walk($additionalImgClasses, 'trim');
    }
  }
  $additionalImgClasses = implode(' ', $additionalImgClasses);
?>

<div class="col-md-6 <?=$additionalClasses?>">
  <h2 class="h2 my-2"><?=$headline?></h2>
  <?php if (isset($subheadline) && $subheadline->isNotEmpty()): ?>
    <p class="lead py-1"><?=$subheadline?></p>
  <?php endif; ?>
  <img src="<?=$image->url()?>" srcset="<?=$image->srcset()?>" alt="<?=$headline->escape()?>" class="rounded-circle img-fluid <?=$additionalImgClasses?>">
  <?php if (isset($description) && $description->isNotEmpty()): ?>
      <p class="text py-1 mt-2"><?=kt($description)?></p>
  <?php endif; ?>
</div>

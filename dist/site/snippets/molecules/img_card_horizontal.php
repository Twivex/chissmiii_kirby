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

<div class="card card--horizontal <?=$additionalClasses?>">
  <div class="row g-0">
    <div class="card-image-col col-sm-12 col-md-<?=$imgWidth?>">
    <?php if (!empty($pageLinkUri)): ?>
      <a href="<?=$pageLinkUri?>">
    <?php endif; ?>
    <img src="<?=$imageUrl?>" class="card-image" alt="<?=$imageAlt?>">
    <?php if (!empty($pageLinkUri)): ?>
      </a>
    <?php endif; ?>
    </div>
    <div class="card-text-col col-sm-12 col-md-<?=$textWidth?>">
      <div class="card-body d-flex flex-column h-100">
        <h5 class="card-title"><?=$title?></h5>
        <?php if (isset($description) && !empty($description)): ?>
          <p class="card-text"><?=kt($description)?></p>
        <?php endif; ?>
        <?php if (isset($modifiedDate) && !empty($modifiedDate)): ?>
          <p class="card-text"><small class="text-muted">Zuletzt aktualisiert am <?=$modifiedDate?></small></p>
        <?php endif; ?>

        <div class="d-flex flex-column justify-content-end h-100">
          <div class="d-flex flex-column flex-sm-row justify-content-between align-items-baseline">

            <?php if (isset($showPageLinkBtn) && $showPageLinkBtn): ?>
              <a href="<?=$pageLinkUri?>" class="btn btn-primary"><?=$pageLinkTitle?></a>
            <?php endif; ?>

            <?php if (!empty($additionalLinks)): ?>
              <span class="btn-box align-self-start align-self-sm-end mt-2 mt-sm-0">
                <?php foreach ($additionalLinks as $link): ?>

                  <?php
                    if (isset($link['type']) && $link['type'] === 'icon'):

                      snippet('atoms/btn-icon', [
                        'iconName' => $link['icon'],
                        'title' => $link['title'],
                        'url' => $link['uri'],
                        'attributes' => isset($link['attributes']) ? $link['attributes'] : null,
                        // 'iconSize' => '',
                        'additionalClasses' => [ 'link-primary' ],
                      ]);

                    else:
                  ?>

                    <a href="<?=$link['uri']?>" class="btn btn-secondary"
                      <?php if (isset($link['attributes'])): ?>
                        <?php foreach ($link['attributes'] as $attr => $value) { echo "$attr=\"$value\""; } ?>
                      <?php endif; ?>
                    ><?=$link['title']?></a>

                    <?php endif; ?>

                  <?php endforeach; ?>
                </span>

            <?php endif; ?>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php
  $navbarStyleClass = '';
  if ($page->settings_enabled()->toBool()) {
    $source = $page;
  } elseif ($page->parents()->count() > 0 && $page->parent()->settings_enabled()->toBool()) {
    $source = $page->parent();
  } else {
    $source = $site;
  }

  $navbarStyle = $source->navbar_style()->value();
  if ($navbarStyle) {
    $navbarStyleClass = 'navbar-' . $navbarStyle;
  }
?>

<nav id="menu" class="navbar <?= $navbarStyleClass ?> navbar-expand-lg sticky-top pt-sm-3">
  <div class="container-fluid container-lg">
    <?php if ($source->logo_type()->value() === 'text'): ?>
      <a class="navbar-brand fs-6 mb-n3 mb-sm-n1 font-decorative" href="<?= $site->url() ?>">
        <?= $source->logo_text()->value() ?>
      </a>
    <?php elseif($source->logo_type()->value() === 'image' && ($logoImageFile = $source->logo_image()->toFile())->exists()): ?>
      <a href="<?= $site->url() ?>">
        <img class="mt-n2 me-3" src="<?= $logoImageFile->resize(150)->url() ?>" height="50" alt="<?= $site->title() ?>">
      </a>
    <?php endif; ?>
    <a class="navbar-toggler btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="material-symbols-rounded material-symbols-large">menu</i>
    </a>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarContent" aria-labelledby="navbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title mb-n1 mt-1 ms-1 ps-2" id="navbarLabel">Menü</h5>
        <?php snippet('atoms/close-button', [ 'target' => 'offcanvas' ]) ?>
      </div>
      <div class="offcanvas-body">
      <ul class="navbar-nav">
        <?php
          $navItems = $site->children()->listed();
          $navItems = $navItems->filter(function ($item) {
            return $item->userHasAccess();
          });
          foreach ($navItems as $key => $item):
            // skip error page
            if ($item->uid() === 'error') continue;
        ?>
          <?php if ($item->intendedTemplate()->name() === 'virtual-page'): ?>

            <li class="nav-item dropdown ms-1 ms-lg-4">
              <a class="nav-link dropdown-toggle pe-0 ps-2 position-relative <?php e($item->isOpen(), 'active show') ?>" href="#" id="navbarDropdown<?= ucfirst($key) ?>" role="button" data-bs-toggle="dropdown" aria-expanded="<?php e($item->isOpen(), 'true', 'false') ?>">
                <?= $item->title()->html() ?>
              </a>
              <ul class="dropdown-menu mt-sm-2 <?php e($item->isOpen(), 'show',) ?>" aria-labelledby="navbarDropdown<?= ucfirst($key) ?>">
                <?php
                  $subNavItems = $item->visibleChildren();
                  $subNavItems = $subNavItems->filter(function ($item) {
                    return $item->userHasAccess();
                  });
                ?>
                <?php foreach($subNavItems as $subItem): ?>
                  <li><a class="dropdown-item py-2 py-lg-3 <?php e($subItem->isOpen(), 'active') ?>" href="<?= $subItem->url() ?>" <?php e($subItem->isOpen(), 'aria-current="true"') ?>><?= $subItem->title()->html() ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>

          <?php else: ?>

            <li class="nav-item ms-1 ms-lg-4">
              <a class="nav-link pe-0 ps-2 position-relative <?php e($item->isOpen(), 'active') ?>" href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
            </li>
          <?php endif; ?>

        <?php endforeach; ?>
      </ul>
    </div>
    </div>
  </div>
</nav>
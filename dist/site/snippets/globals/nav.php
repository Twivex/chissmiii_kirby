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
    <a class="navbar-brand fs-6 mb-n3 mb-sm-n1 font-decorative" href="/"><?= $site->title() ?></a>
    <a class="navbar-toggler btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="material-symbols-rounded">menu</i>
    </a>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarContent" aria-labelledby="navbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title mb-n1 mt-1 ms-1 ps-2" id="navbarLabel">Menü</h5>
        <a type="button" class="btn-icon" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="material-symbols-rounded">close</i>
        </a>
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
              <a class="nav-link dropdown-toggle pe-0 ps-2 position-relative <?php e($item->isOpen(), 'active') ?>" href="#" id="navbarDropdown<?= ucfirst($key) ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $item->title()->html() ?>
              </a>
              <ul class="dropdown-menu mt-sm-2" aria-labelledby="navbarDropdown<?= ucfirst($key) ?>">
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
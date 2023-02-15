<?php
  $navbarStyleClass = '';
  $navbarStyle = $page->navbar_style()->isNotEmpty() ? $page->navbar_style()->value() : $site->navbar_style()->value();
  if ($navbarStyle) {
    $navbarStyleClass = 'navbar-' . $navbarStyle;
  }
?>

<nav id="menu" class="navbar <?= $navbarStyleClass ?> navbar-expand-lg sticky-top bg-light pt-sm-3">
  <div class="container-fluid container-lg">
    <a class="navbar-brand fs-6 mb-n3 mb-sm-n1 font-decorative" href="/"><?= $site->title() ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarContent" aria-labelledby="navbarLabel">
      <div class="offcanvas-header bg-light">
        <h5 class="offcanvas-title mb-n1 mt-1 ms-1 ps-2" id="navbarLabel">Menü</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
      <ul class="navbar-nav">
        <?php
          $navItems = $site->children()->listed();
          foreach ($navItems as $key => $item):
            // skip secured pages, if not logged in
            if ($item->secured()->toBool() === true && !$kirby->user()) continue;
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
                  $subNavItems = $item->children();
                  if (!$kirby->user()) $subNavItems = $subNavItems->listed();
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
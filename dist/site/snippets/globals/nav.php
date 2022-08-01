<nav id="menu" class="navbar navbar-dark navbar-expand-md sticky-top bg-light pt-sm-3">
  <div class="container-fluid container-lg">
    <a class="navbar-brand fs-6 mb-n3 mb-sm-n1 font-decorative" href="/"><?=$site->title()?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarContent" aria-labelledby="navbarLabel">
      <div class="offcanvas-header bg-light text-white">
        <h5 class="offcanvas-title mb-n1 mt-1" id="navbarLabel">Menü</h5>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
      <ul class="navbar-nav">
        <?php
          $navItems = $site->children();
          if (!$kirby->user()) $navItems = $navItems->listed();
          foreach ($navItems as $item):
            // skip secured pages, if not logged in
            if ($item->secured()->toBool() === true && !$kirby->user()) continue;
            // skip error page
            if ($item->uid() === 'error') continue;
        ?>
          <?php if ($item->intendedTemplate()->name() === 'virtual_page'): ?>

            <li class="nav-item dropdown ms-md-4">
              <a class="nav-link dropdown-toggle pe-0 ps-2 position-relative <?php e($item->isOpen(), 'active') ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $item->title()->html() ?>
              </a>
              <ul class="dropdown-menu mt-sm-2" aria-labelledby="navbarDropdown">
                <?php
                  $subNavItems = $item->children();
                  if (!$kirby->user()) $subNavItems = $subNavItems->listed();
                ?>
                <?php foreach($subNavItems as $subItem): ?>
                  <li><a class="dropdown-item ps-4 <?php e($subItem->isOpen(), 'active') ?>" href="<?= $subItem->url() ?>" <?php e($subItem->isOpen(), 'aria-current="true"') ?>><?= $subItem->title()->html() ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>

          <?php else: ?>

            <li class="nav-item ms-md-4">
              <a class="nav-link pe-0 ps-2 position-relative <?php e($item->isOpen(), 'active') ?>" href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
            </li>
          <?php endif; ?>

        <?php endforeach; ?>
      </ul>
    </div>
    </div>
  </div>
</nav>
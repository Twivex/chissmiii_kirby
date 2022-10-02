<?php
  $imprintPage = $pages->find('impressum');
  $dprgPage = $pages->find('datenschutzerklarung');
?>

<nav id="footer-nav" class="navbar navbar-dark navbar-expand-sm bg-light justify-content-center py-1">
  <div class="container-fluid container-lg justify-content-center">
    <ul class="navbar-nav nav-pipe-sm">

      <li class="nav-item d-flex justify-content-center">
        <a class="nav-link" href="<?= $imprintPage->url() ?>">
          <?= $imprintPage->title()->html() ?>
        </a>
      </li>

      <li class="nav-item d-flex justify-content-center">
        <a class="nav-link" href="<?= $dprgPage->url() ?>">
          <?= $dprgPage->title()->html() ?>
        </a>
      </li>

      <li class="nav-item d-flex justify-content-center">
        <span class="nav-link" tabindex="0" data-cookie-consent="openSettings">
          <?= t('cookie-settings-title') ?>
        </span>
      </li>

    </ul>
  </div>
</nav>

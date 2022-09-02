<?php
  $imprintPage = $pages->find('impressum');
  $dprgPage = $pages->find('datenschutzerklarung');
?>

<nav id="footer-nav" class="navbar navbar-dark navbar-expand bg-light justify-content-center py-1">
  <div class="container-fluid container-lg justify-content-center">
    <ul class="navbar-nav nav-pipe">

      <li class="nav-item">
        <a class="nav-link" href="<?= $imprintPage->uri() ?>">
          <?= $imprintPage->title()->html() ?>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= $dprgPage->uri() ?>">
          <?= $dprgPage->title()->html() ?>
        </a>
      </li>

    </ul>
  </div>
</nav>

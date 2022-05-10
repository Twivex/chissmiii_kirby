<nav id="menu" class="navbar navbar-expand-sm sticky-top bg-light">
  <div class="container">
    <a class="navbar-brand font-decorative" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php
          foreach ($site->children()->listed() as $item) :
          // skip secured pages, if not logged in
          if ($item->secured()->toBool() === true && !$kirby->user()) continue;
        ?>
          <li class="nav-item">
            <a class="nav-link<?php e($item->isOpen(), ' active') ?>" href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
          </li>
        <?php endforeach ?>
      </ul>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
          <?php if ($kirby->user()): ?>
            <a class="nav-link" href="<?= url('logout') ?>">Logout</a>
          <?php else: ?>
            <?php $login = $pages->findBy('uid', 'login'); ?>
            <a class="nav-link<?php e($login->isOpen(), ' active') ?>" href="<?= $login->url() ?>"><?= $login->title()->html() ?></a>
          <?php endif ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
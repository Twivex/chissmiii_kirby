<nav id="menu" class="menu">
  <?php
    foreach ($site->children()->listed() as $item) {
      // skip secured pages, if not logged in
      if ($item->secured()->toBool() === true && !$kirby->user()) continue;
      echo $item->title()->link();
    }
  ?>
  <?php if ($kirby->user()): ?>
    <li>
      <a href="<?= url('logout') ?>">Logout</a>
    </li>
  <?php else: ?>
    <?php
      $login = $pages->findBy('uid', 'login');
      echo $login->title()->link();
    ?>
  <?php endif ?>
</nav>
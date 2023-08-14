<?php snippet('globals/header') ?>

<?php snippet('atoms/section-heading', [ 'data' => $page ]); ?>

<?php if ($page->isSecured() && !$page->userHasAccess()):
  snippet('components/pwonly-login', ['accessUserEmail' => $page->getAccessUser()->email()]);
else: ?>

  <?php
    $albumPages = $page->children()->listed();
    foreach ($albumPages as $albumPage) {
      $data = compact('site', 'kirby', 'albumPage');
      snippet('pages/album.cover', $data);
    }
  ?>

</section>

<?php snippet('components/upload-modal') ?>

<?php endif; ?>

<?php snippet('globals/footer') ?>
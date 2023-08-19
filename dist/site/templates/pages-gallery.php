<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<section>

  <?php snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]); ?>

  <?php
    $lang = $kirby->language();
    $subPages = $page->children()->listed();
    foreach ($subPages as $subPage) {
      snippet('pages/page.cover', [ 'page' => $subPage ]);
    }
  ?>

</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
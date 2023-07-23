<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<section class="py-4 timeline">

  <?php snippet('atoms/section-heading', [ 'data' => $page ]); ?>

  <?php
    $injected = true;
    $data = compact('site', 'kirby', 'injected');
    $c = 0;
    $children = $page->visibleChildren();
    foreach ($children as $child) {
      $c++;

      if ($c === 1) {
        echo '<span class="symbol material-symbols-rounded ms-xlarge">favorite</span>';
      }

      $data['page'] = $child;
      $data['alternating'] = $page->alternating_entries()->toBool();
      echo $child->template()->render($data);

      if ($c === count($children)) {
        echo '<span class="symbol material-symbols-rounded ms-xlarge">keyboard_double_arrow_down</span>';
      }
    }
  ?>

</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
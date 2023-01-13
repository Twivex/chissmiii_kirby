<section class="py-4 timeline">

  <?php snippet('atoms/section-heading', [ 'data' => $data ]); ?>

  <?php
    $entries = $data->children();
    if (!$kirby->user()) {
      $entries = $entries->listed();
    }

    $c = 0;
    foreach ($entries as $entry) {
      $c++;

      if ($c === 1) {
        echo '<span class="symbol material-symbols-rounded ms-xlarge">favorite</span>';
      }

      snippet('pages/timeline.entry', [
        'data' => $entry,
        'alternating' => $data->alternating_entries()->toBool()
      ]);

      if ($c === count($entries)) {
        echo '<span class="symbol material-symbols-rounded ms-xlarge">keyboard_double_arrow_down</span>';
      }
    }
  ?>

</section>
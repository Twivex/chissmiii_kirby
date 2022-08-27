<section class="py-4 timeline">

  <?php snippet('atoms/section-heading', [ 'data' => $data ]); ?>

  <?php
    $entries = $data->children();
    if (!$kirby->user()) {
      $entries = $entries->listed();
    }
    foreach ($entries as $entry) {
      snippet('pages/timeline.entry', [
        'data' => $entry,
        'alternating' => $data->alternating_entries()->toBool()
      ]);
    }
  ?>

</section>
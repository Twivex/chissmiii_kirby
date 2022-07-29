<?php
  $colsCountClass = $colsCount ? "col-lg-$colsCount" : '';
?>
<div class="row justify-content-center">
    <div class="col-12 <?=$colsCountClass?>">
      <h3>Bisher eingereichte Liedwünsche</h3>
      <?php if (!$data->hasChildren()): ?>

        <p class="text-muted">Noch keine Liedwünsche vorhanden.</p>

      <?php else: ?>

        <?php
          $entryGroups = $data->children()
            ->sortBy('song_artist', 'asc', 'song_title', 'asc')
            ->group(function($child) {
              return Str::substr($child->title()->value(), 0, 1);
            });
        ?>
        <?php foreach ($entryGroups as $key => $entries): ?>
          <div class="row justify-content-left mt-3">

            <h4><?=strtoupper($key)?></h4>

            <?php foreach ($entries as $entry): ?>
              <?php snippet('pages/songwish.entry', [ 'data' => $entry ]) ?>
            <?php endforeach; ?>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>
    </div>
  </div>
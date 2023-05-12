<div class="row justify-content-center">
    <div class="col-12 <?= $data->columnsClass() ?>">

      <h3>Bisher eingereichte Liedwünsche</h3>

      <?php if (!$data->hasChildren()): ?>

        <p class="text-muted">Noch keine Liedwünsche vorhanden.</p>

      <?php else: ?>

        <?php
          $groupBy = $data->group_by()->value();
          switch($groupBy) {
            case 'date':
              $entryGroups = $data->children()
                ->sortBy('created_at', 'desc', 'song_artist', 'asc', 'song_title', 'asc')
                ->group(function($child) {
                  return $child->created_at()->toDate('d.m.Y');
                });
              break;

            case 'title':
            default:
              $entryGroups = $data->children()
                ->sortBy('song_artist', 'asc', 'song_title', 'asc')
                ->group(function($child) {
                  return Str::substr($child->title()->value(), 0, 1);
                });
          }
        ?>

        <?php foreach ($entryGroups as $key => $entries): ?>
          <?php
            switch($groupBy) {
              case 'date':
                $headline = $entries->first()->created_at()->toDate('d.m.Y');
                break;

              case 'title':
              default:
                $headline = strtoupper(Str::substr($entries->first()->title()->value(), 0, 1));
            }
          ?>

          <div class="row justify-content-left mt-3">

            <h4><?= $headline ?></h4>

            <?php foreach ($entries as $entry) {
              $data = [
                'text' => $entry->song_artist() . ' – ' . $entry->song_title()
              ];

              if ($groupBy === 'date') {
                $data['addInfo'] = $entry->created_at()->toDate('H:i');
              }

              snippet('pages/songwish.entry', $data);
            } ?>

          </div>

        <?php endforeach; ?>

      <?php endif; ?>

    </div>
  </div>
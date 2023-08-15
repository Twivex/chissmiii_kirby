<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<section class="mt-4">

  <?php snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]); ?>

  <div class="row justify-content-center">
    <div class="col-12 <?= $page->columnsClass() ?>">

      <form
        data-entry-collector
        data-entry-collector-mode="replace"
        data-entry-collector-for="songwish-list"
        data-entry-collector-alert-error="songwish-alert-error"
        data-entry-collector-alert-success="songwish-alert-success"
        action="<?= $page->url() ?>"
        method="POST"
        class="needs-validation"
        novalidate
      >
        <fieldset>

          <div class="row align-items-baseline">
            <div class="col align-self-start">
              <div class="form-floating mb-4">
                <input
                  type="text"
                  id="songArtist"
                  name="song_artist"
                  class="form-control"
                  placeholder="Interpret*"
                  aria-describedby="songArtistValidation"
                  value="<?= $form_data['song_artist'] ?? null ?>"
                  required
                >
                <label for="songArtist">Interpret*</label>
                <div id="songArtistValidation" class="invalid-feedback position-absolute">Bitte gib einen Interpreten ein.</div>
              </div>
            </div>

            <div class="col-auto align-self-center">
              <span class="d-flex mb-4 fs-3">–</span>
            </div>

            <div class="col align-self-start">
              <div class="form-floating mb-4">
                <input
                  type="text"
                  id="songTitle"
                  name="song_title"
                  class="form-control"
                  placeholder="Titel*"
                  aria-describedby="songTitleValidation"
                  value="<?= $form_data['song_title'] ?? null ?>"
                  required
                >
                <label for="songTitle">Titel*</label>
                <div id="songTitleValidation" class="invalid-feedback position-absolute">Bitte gib einen Titel ein.</div>
              </div>
            </div>

          </div>

          <div class="visually-hidden">
            <input type="website" name="website" id="website"
              value="<?= isset($form_data['website']) ? esc($form_data['website']) : null ?>" />
          </div>

          <div class="d-flex flex-row align-items-baseline justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Abschicken</button>
            <p class="text-muted mb-0">* Pflichtfeld</p>
          </div>

        </fieldset>
      </form>

    </div>
  </div>


  <div class="row justify-content-center">
    <div class="col-12 <?= $page->columnsClass() ?>">
      <hr>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 <?= $page->columnsClass() ?>">
      <?= snippet('atoms/alert', [
        'name' => 'songwish',
        'type' => 'success',
        'class' => 'success',
        'content' => 'Liedwunsch erfolgreich hinzugefügt.',
        'hidden' => true,
        'close' => true,
        'autoclose' => '3000',
        ]) ?>

      <?= snippet('atoms/alert', [
        'name' => 'songwish',
        'type' => 'error',
        'class' => 'danger',
        'content' => 'Liedwunsch konnte nicht hinzugefügt werden.',
        'hidden' => true,
        'close' => true,
        'autoclose' => '3000',
      ]) ?>
    </div>
  </div>

</section>


<section id="songwish-list" class="mt-2">

  <div class="row justify-content-center">
    <div class="col-12 <?= $page->columnsClass() ?>">

      <h3>Bisher eingereichte Liedwünsche</h3>

      <?php if (!$page->hasChildren()): ?>

        <p class="text-muted">Noch keine Liedwünsche vorhanden.</p>

      <?php else: ?>

        <?php
          $groupBy = $page->group_by()->value();
          switch($groupBy) {
            case 'date':
              $entryGroups = $page->children()
                ->sortBy('created_at', 'desc', 'song_artist', 'asc', 'song_title', 'asc')
                ->group(function($child) {
                  return $child->created_at()->toDate('d.m.Y');
                });
              break;

            case 'title':
            default:
              $entryGroups = $page->children()
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
                $groupHeadline = $entries->first()->created_at()->toDate('d.m.Y');
                break;

              case 'title':
              default:
                $groupHeadline = strtoupper(Str::substr($entries->first()->title()->value(), 0, 1));
            }
          ?>

          <div class="row justify-content-left mt-3">

            <h4><?= $groupHeadline ?></h4>

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

</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>

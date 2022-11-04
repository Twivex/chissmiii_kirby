<section class="mt-4">

  <?php snippet('atoms/section-heading', [ 'data' => $data ]); ?>

  <div class="row justify-content-center">
    <div class="col-12 <?= $data->columnsClass() ?>">

      <form
        data-entry-collector
        data-entry-collector-mode="replace"
        data-entry-collector-for="songwish-list"
        data-entry-collector-alert-error="songwish-alert-error"
        data-entry-collector-alert-success="songwish-alert-success"
        action="<?= $data->url() ?>"
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
    <div class="col-12 <?= $data->columnsClass() ?>">
      <hr>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 <?= $data->columnsClass() ?>">
      <div class="alert alert-small alert-success alert-dismissible fade visually-hidden mt-3" role="alert">
        <span id="songwish-alert-success">Liedwunsch erfolgreich hinzugefügt.</span>
        <button type="button" class="btn-close" data-visually-hide="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 <?= $data->columnsClass() ?>">
      <div class="alert alert-small alert-danger alert-dismissible fade visually-hidden mt-3" role="alert">
        <span id="songwish-alert-error">ERROR</span>
        <button type="button" class="btn-close" data-visually-hide="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>

</section>


<section id="songwish-list" class="mt-2">

  <?= snippet('pages/songwish.list', [ 'data' => $data ]) ?>

</section>
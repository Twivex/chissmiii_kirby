<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<section class="mt-4">

  <?php snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]); ?>

  <div class="row justify-content-center">

    <div class="col-12 <?= $page->colsCountClass() ?>">

      <form
        data-entry-collector
        data-entry-collector-mode="prepend"
        data-entry-collector-for="guestbook-list"
        action="<?= $page->url() ?>"
        method="POST"
        class="needs-validation"
        novalidate
      >
        <fieldset>

          <div class="row">
            <div class="col-12 mb-1">
              <div class="form-floating mb-4">
                <input
                  type="text"
                  id="name"
                  name="name"
                  class="form-control"
                  placeholder="Name*"
                  aria-describedby="nameValidation"
                  value="<?= $form_data['name'] ?? null ?>"
                  required
                >
                <label for="name" class="form-label">Name*</label>
                <div id="nameValidation" class="invalid-feedback position-absolute">Bitte gib einen Namen ein.</div>
                <div id="nameHelp" class="form-text float-end">Der Name wird für alle sichtbar sein.</div>
              </div>
            </div>

            <div class="col-12 mb-1">
              <div class="form-floating mb-4">
                <textarea
                  id="message"
                  name="message"
                  class="form-control"
                  placeholder="Nachricht*"
                  aria-describedby="messageValidation"
                  style="height: 150px"
                  required
                ><?= $form_data['message'] ?? null ?></textarea>
                <label for="message" class="form-label">Nachricht*</label>
                <div id="messageValidation" class="invalid-feedback position-absolute">Bitte gib eine Nachricht ein.</div>
                <div id="messageHelp" class="form-text float-end">Der Text wird für alle sichtbar sein.</div>
              </div>
            </div>
          </div>

          <div class="visually-hidden">
            <input type="website" name="website" id="website"
              value="<?= isset($form_data['website']) ? esc($form_data['website']) : null ?>" />
          </div>

          <div class="d-flex flex-row align-items-baseline justify-content-between mt-2">
            <button type="submit" class="btn btn-primary">Abschicken</button>
            <p class="text-muted mb-0">* Pflichtfeld</p>
          </div>

        </fieldset>
      </form>

    </div>

  </div>

</section>

<div class="row justify-content-center">
  <div class="col-12 <?= $page->colsCountClass() ?>">
    <hr>
  </div>
</div>

<section id="guestbook-list" class="mt-2">

  <?php if (!$page->hasChildren()): ?>

    <div class="row justify-content-center">
      <div class="col-12 <?= $page->colsCountClass() ?>">
        <p class="text-muted">Noch keine Einträge vorhanden.</p>
      </div>
    </div>

  <?php else: ?>

    <?php foreach ($page->children()->sortBy('created_at', 'desc') as $entry) {
      snippet('pages/guestbook.entry', [ 'data' => $entry ]);
    } ?>

  <?php endif; ?>

</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>

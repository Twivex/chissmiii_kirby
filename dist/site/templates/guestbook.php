<?php snippet('globals/header') ?>

<main id="main" class="container">

  <section class="mt-4 mb-5">
    <form data-guestbook="form" action="<?=$page->url()?>" method="POST" class="needs-validation" novalidate>
      <fieldset>
        <div class="mb-3">
          <label for="name" class="form-label">Name*</label>
          <input type="text" class="form-control" id="name" aria-describedby="nameHelp" value="<?=$data['name'] ?? null?>" required>
          <div id="nameHelp" class="form-text">Der Name wird für alle sichtbar sein.</div>
          <div class="invalid-feedback">Bitte gib einen Namen ein.</div>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Nachricht*</label>
          <textarea class="form-control" id="message" aria-describedby="messageHelp" required><?= $data['message'] ?? null ?></textarea>
          <div id="messageHelp" class="form-text">Der Text wird für alle sichtbar sein.</div>
          <div class="invalid-feedback">Bitte gib eine Nachricht ein.</div>
        </div>
        <div class="visually-hidden">
          <input type="website" name="website" id="website" value="<?= isset($data['website']) ? esc($data['website']) : null ?>"/>
        </div>
        <button type="submit" class="btn btn-primary">Abschicken</button>
        <div class="mt-3">
          <small class="text-muted">* Pflichtfeld</small>
        </div>
      </fieldset>
    </form>
  </section>

  <hr>

  <section class="mt-5 mb-4" data-guestbook="entries">
    <?php foreach ($page->children()->sortBy('created_at', 'desc') as $entry) {
      echo $entry->render();
    } ?>
  </section>

</main>

<?php snippet('globals/footer') ?>
<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<section>

  <?php snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]); ?>

  <div class="row justify-content-center">
    <div class="col-12 <?= $page->columnsClass() ?>">

      <form
        data-form
        id="contact-form"
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
                <label for="name">Name*</label>
                <div id="nameValidation" class="invalid-feedback position-absolute">Bitte gib deinen Namen ein.</div>
              </div>
            </div>

            <div class="col-12 col-md-6 mb-1">
              <div class="form-floating mb-4">
                <input
                  type="mail"
                  id="email"
                  name="email"
                  class="form-control"
                  placeholder="E-Mail"
                  aria-describedby="emailValidation"
                  value="<?= $form_data['email'] ?? null ?>"
                >
                <label for="email">E-Mail</label>
                <div id="emailValidation" class="invalid-feedback position-absolute">Bitte gib eine gültige E-Mail Adresse ein.</div>
              </div>
            </div>

            <div class="col-12 col-md-6 mb-1">
              <div class="form-floating mb-4">
                <input
                  type="phone"
                  id="phone"
                  name="phone"
                  class="form-control"
                  placeholder="Telefon"
                  aria-describedby="phoneValidation"
                  value="<?= $form_data['phone'] ?? null ?>"
                >
                <label for="phone">Telefon</label>
                <div id="phoneValidation" class="invalid-feedback position-absolute">Bitte gib eine gültige Telefonnummer ein.</div>
              </div>

            </div>

            <div class="col-12 mb-1">
              <div class="form-floating mb-4">
                <!-- // TODO make texteare size fixed -->
                <textarea
                  id="message"
                  name="message"
                  class="form-control"
                  placeholder="Nachricht*"
                  aria-describedby="messageValidation"
                  style="height: 211px"
                  required
                ><?= $form_data['message'] ?? null ?></textarea>
                <label for="message" class="form-label">Nachricht*</label>
                <div id="messageValidation" class="invalid-feedback position-absolute">Bitte gib eine Nachricht ein.</div>
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

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>

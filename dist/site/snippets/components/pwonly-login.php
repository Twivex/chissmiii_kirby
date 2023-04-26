<form
  data-form
  data-form-ajax
  data-form-ajax-success="reload"
  data-form-alert-error="pwologin-form-alert-error"
  data-form-alert-success="pwologin-form-alert-success"
  id="pwologin-form-<?= $page->uid() ?>"
  action="/pwologin/<?= $page->uri() ?>"
  method="POST"
  class="needs-validation"
  novalidate
>
  <fielset>
    <div class="row justify-content-center">
      <div class="col-12 col-sm-12 col-md-5 col-lg-4">
        <?php snippet('atoms/alert', [
          'name' => 'pwologin-form',
          'type' => 'error',
          'class' => 'danger',
          'hidden' => true,
          'close' => false,
          'autoclose' => '5000',
        ]) ?>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="visually-hidden">
        <input type="email" id="email" name="email" value="<?= $accessUserEmail ?>">
      </div>
      <div class="col-8 col-sm-6 col-md-5 col-lg-4 mb-1">
        <div class="row">
          <div class="col-12">
            <div class="form-floating mb-4">
              <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="<?= t('password') ?>*"
                aria-describedby="passwordValidation"
                required
              >
              <label for="password"><?= t('password') ?>*</label>
              <div id="passwordValidation" class="invalid-feedback position-absolute"><?= t('password-invalid-hint') ?></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 d-flex flex-row align-items-baseline justify-content-between mt-2">
            <button type="submit" class="btn btn-primary"><?= t('login') ?></button>
            <p class="text-muted mb-0"><?= t('required-field-desc') ?></p>
          </div>
        </div>
      </div>
    </div>
  </fielset>
</form>
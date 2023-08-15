<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }

  $applicationCookieAccepted = isset($_COOKIE['cookie-consent-application']) && $_COOKIE['cookie-consent-application'] == 1;
?>

<section class="py-4">

  <?php snippet('atoms/section-heading', [ 'data' => $page, 'injected' => $isInjected ]); ?>

  <div class="row justify-content-center mb-4">
    <div class="col-12 <?= $page->columnsClass() ?>">

      <?php if($applicationCookieAccepted): ?>

        <iframe
          style="border:0"
          loading="lazy"
          allowfullscreen
          referrerpolicy="no-referrer"
          tabindex="0"
          aria-hidden="false"
          frameborder="0"
          width="100%"
          height="550px"
          src="<?= $page->gmaps_link() ?>"
        ></iframe>

      <?php else: ?>

        <div class="d-flex flex-column align-items-center justify-content-center bg-secondary p-3" style="width: 100%; height: 550px;">
          <p class="text-center"><?= t('application-cookie-required-text') ?></p>
          <button type="button" class="btn btn-primary" data-cookie-consent="openSettings">
            <?= t('cookie-settings-title') ?>
          </button>
        </div>

      <?php endif; ?>

    </div>
  </div>
</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
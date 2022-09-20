<?php
  $applicationCookieAccepted = isset($_COOKIE['cookie-consent-application']) && $_COOKIE['cookie-consent-application'] == 1;
?>

<section class="py-4">

  <?php snippet('atoms/section-heading', [ 'data' => $data ]); ?>

  <div class="row justify-content-center mb-4">
    <div class="col-12 <?= $data->columnsClass() ?>">

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
          src="<?= $data->gmaps_link() ?>"
        ></iframe>

      <?php else: ?>

        <div class="d-flex flex-column align-items-center justify-content-center bg-dark p-3" style="width: 100%; height: 550px;">
          <p class="text-center text-white"><?= t('application-cookie-required-text') ?></p>
          <button type="button" class="btn btn-primary" data-cookie-consent="openSettings">
            <?= t('cookie-settings-title') ?>
          </button>
        </div>

      <?php endif; ?>

    </div>
  </div>
</section>
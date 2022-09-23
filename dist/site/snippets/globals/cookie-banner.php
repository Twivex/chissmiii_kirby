<?php
  $applicationCookieAccepted = isset($_COOKIE['cookie-consent-application']) && $_COOKIE['cookie-consent-application'] == 1;
  // $stasticCookieAccepted = isset($_COOKIE['cookie-consent-statistic']) && $_COOKIE['cookie-consent-statistic'] == 1;
?>

<div id="cookieConsent" class="container fixed-bottom p-0 px-2 pb-3 d-none" aria-live="polite" aria-atomic="true">
  <?php dump($applicationCookieAccepted); ?>
    <div id="cookieConsentBanner" class="toast bg-dark text-white w-100 mw-100" role="alert" data-autohide="false">
        <div class="toast-body p-4 d-flex flex-column">

            <h4 class="fs-5"><?= t('cookie-title') ?></h4>
            <?= kirbytext(t('cookie-text')) ?>

            <div class="d-flex flex-row justify-content-between">

              <button type="button" class="btn btn-outline-primary" id="cookieConsentOpenSettings">
                <?= t('cookie-open-settings') ?>
              </button>

              <div class="d-flex flex-row gap-sm-3 gap-2">
                <button type="button" class="btn btn-primary" id="cookieConsentAccept">
                  <?= t('cookie-accept') ?>
                </button>
                <button type="button" class="btn btn-primary" id="cookieConsentDeny">
                  <?= t('cookie-deny') ?>
                </button>
              </div>

            </div>

        </div>
    </div>

    <div id="cookieConsentSettings" class="toast bg-dark text-white w-100 mw-100" role="alert" data-autohide="false">
        <div class="toast-body p-4">

            <h4 class="fs-5"><?= t('cookie-settings-title') ?></h4>
            <?= kirbytext(t('cookie-settings-text')) ?>

            <div class="form-check disabled">
              <input class="form-check-input" type="checkbox" value="" id="requiredCookies" checked disabled>
              <label class="form-check-label" for="requiredCookies">
                <span class="fw-bold"><?= t('cookie-settings-required-title') ?></span>
                <span class="d-inline-block"><?= kirbytextinline(t('cookie-settings-required-text')) ?></span>
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="applicationCookies" <?= $applicationCookieAccepted ? 'checked' : '' ?>>
              <label class="form-check-label" for="applicationCookies">
                <span class="fw-bold"><?= t('cookie-settings-application-title') ?></span>
                <span class="d-inline-block"><?= kirbytextinline(t('cookie-settings-application-text')) ?></span>
              </label>
            </div>

            <button type="button" class="btn btn-primary" id="cookieConsentSaveSettings">
              <?= t('cookie-save-settings') ?>
            </button>

        </div>
    </div>
</div>

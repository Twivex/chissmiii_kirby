<?php
  $images = $site->files()->filterBy('tag', '*=', 'travel_statistics');
  $countriesImg = $images->filterBy('tag', '*=', 'countries');
  $worldImg = $images->filterBy('tag', '*=', 'world');
  $continentsImg = $images->filterBy('tag', '*=', 'continents');
  if ($countriesImg !== null || $worldImg !== null || $continentsImg !== null):
    $countriesImg = $countriesImg->first();
    $worldImg = $worldImg->first();
    $continentsImg = $continentsImg->first();
?>

  <section class="py-4 travel-statistics">
    <div class="row">

      <div class="col-12 col-lg-4">
        <h4>We've seen …</h4>

        <div class="row">

          <div class="col-6">
            <figure class="figure position-relative">
              <img
                class="figure-img img-fluid rounded"
                src="<?= $countriesImg->url() ?>"
              >
              <figcaption class="figure-caption bottom-0 d-flex flex-column justify-content-start position-absolute ps-4 pt-4 text-white top-0">
                <h5 class="fs-4 fw-bold m-0"><?= $data->countries() ?></h5>
                <p class="fs-5">countries</p>
              </figcaption>
            </figure>
          </div>

          <div class="col-6">
            <figure class="figure position-relative">
              <img
                class="figure-img img-fluid rounded"
                src="<?= $worldImg->url() ?>"
              >
              <figcaption class="figure-caption bottom-0 d-flex flex-column justify-content-start position-absolute ps-4 pt-4 text-white top-0">
                <h5 class="fs-4 fw-bold m-0"><?= $data->world() ?>%</h5>
                <p class="fs-5">of the world</p>
              </figcaption>
            </figure>
          </div>

        </div>
      </div>


      <div class="col-12 col-lg-4">
        <h4>Continents visited</h4>
        <figure class="figure">
          <img
            class="figure-img img-fluid rounded"
            src="<?= $continentsImg->url() ?>">
          <figcaption class="figure-caption">
            <div class="row">
              <div class="col-7 col-xs-3 col-sm-3"><div class="position-relative ps-4 ms-lg-n2 ms-xl-0"><span class="dot" style="background-color: #74ADD2"></span>Europe</div></div>
              <div class="col-5 col-xs-3 col-sm-3"><div class="position-relative ps-4 ms-lg-n2 ms-xl-0"><span class="dot" style="background-color: #A6DBA0"></span>Africa</div></div>
              <div class="col-7 col-xs-6 col-sm-6"><div class="text-muted position-relative ps-4 ms-lg-n2 ms-xl-0"><span class="dot"></span>North-America</div></div>
              <div class="col-5 col-xs-3 col-sm-3"><div class="position-relative ps-4 ms-lg-n2 ms-xl-0"><span class="dot" style="background-color: #FDD9A6"></span>Asia</div></div>
              <div class="col-5 col-xs-3 col-sm-3 order-5 order-xs-4 order-sm-4"><div class="text-muted position-relative ps-4 ms-lg-n2 ms-xl-0"><span class="dot"></span>Oceania</div></div>
              <div class="col-7 col-xs-6 col-sm-6 order-4 order-xs-5 order-sm-5"><div class="text-muted position-relative ps-4 ms-lg-n2 ms-xl-0"><span class="dot"></span>South-America</div></div>
            </div>
          </figcaption>
        </figure>
      </div>

      <div class="col-12 col-lg-4">
        <h4>Flags collected</h4>
        <div class="card border-0">
          <div class="card-body d-flex flex-row flex-wrap gap-2">
            <?php
              $flags = $data->flags()->split();
              sort($flags);
            ?>
            <?php foreach ($flags as $flag): ?>
              <span class="fi fi-<?= $flag ?>"></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </section>

<?php endif; ?>
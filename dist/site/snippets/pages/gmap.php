<section class="py-4">

  <?php snippet('atoms/section-heading', [ 'data' => $data ]); ?>

  <div class="row justify-content-center mb-4">
    <div class="col-12 <?= $data->columnsClass() ?>">

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

      <?php
        \Kirby\Cms\Html::iframe($data->gmaps_link(), [
          'style' => 'border:0',
          'loading' => 'lazy',
          'referrerpolicy' => 'no-referrer',
          'allowfullscreen'
        ]);
      ?>

    </div>
  </div>
</section>
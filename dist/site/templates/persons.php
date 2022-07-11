<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">
  <section>
    <div class="row text-center">
      <?php foreach ($persons as $person) {
        snippet('molecules/img_card_circle', [
          'headline' => $person->title(),
          'subheadline' => $person->role(),
          'description' => $person->description(),
          'image' => $person->portraitImg(),
          'addImgClass' => 'w-50'
        ]);
      }?>
    </div>
  </section>
</main>

<?php snippet('globals/footer') ?>
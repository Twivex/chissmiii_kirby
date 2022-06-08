<?php snippet('globals/header') ?>

<?php
  $yesterday = date_create('now')->modify('-1 day')->getTimeStamp();
?>

<main id="main" class="container">
  <section class="my-5">
    <div class="row">
      <?php snippet('atoms/section_heading', ['heading' => 'Anstehende Events']); ?>
      <!-- <div class="col-4 col-sm-6"> -->
        <?php $c = 0; ?>
        <?php foreach ($upcomingEvents as $event): ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mx-n1">
            <?php
              snippet('components/eventcard', [
                'addClass' => (($c + 1) % 3 == 0) ? 'col-4 col-sm-6' : '',
                'event' => $event
              ]);
            ?>
          </div>
          <?php if (($c + 1) % 3 == 0): ?>
            <!-- </div><div class="col-4"> -->
          <?php endif; ?>
          <?php if (($c + 1) == $page->children()->count()): ?>
            <!-- </dvi> -->
          <?php endif; ?>
          <?php $c++; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <section class="mb-5">
    <div class="row">
      <?php snippet('atoms/section_heading', ['heading' => 'Vergangene Events']); ?>
      <?php $c = 0; ?>
      <?php foreach ($pastEvents as $event): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mx-n1">
          <?php
            snippet('components/eventcard', [
              'addClass' => (($c + 1) % 3 == 0) ? 'col-4 col-sm-6' : '',
              'event' => $event
            ]);
          ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php snippet('globals/footer') ?>
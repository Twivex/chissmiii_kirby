<?php snippet('header') ?>

<section class="my-5">
  <div class="row">
    <!-- <div class="col-4 col-sm-6"> -->

      <?php $c = 0; foreach ($page->children() as $event): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mx-n1">
          <?php
            if ($image = $event->image('thumbnail')) {
              $imageUrl = $image->url();
              $imageAlt = $image->title();
            } else {
              $imageUrl = '/resources/assets/images/event_placeholder.jpg';
              $imageAlt = $event->title()->escape();
            }
            snippet('event', [
              'addClass' => (($c + 1) % 3 == 0) ? 'col-4 col-sm-6' : '',
              'title' => $event->title()->escape(),
              'description' => $event->description(),
              'imageUrl' => $imageUrl,
              'imageAlt' => $imageAlt,
              'date' => $event->date(),
              'time' => $event->time(),
              'companion' => $event->companion(),
              'fooddrinks' => $event->fooddrinks()
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

<?php snippet('footer') ?>
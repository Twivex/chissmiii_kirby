<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">

  <?php if ($page->show_title()->toBool() === true): ?>
    <h1 class="text-center"><?=$page->title()?></h1>
  <?php endif; ?>

  <?php foreach($page->children() as $child) {
    snippet($child->blueprint()->name(), ['data' => $child]);
  } ?>

  <section class="py-4">
    <div class="row justify-content-center mb-2">
      <div class="col">
        <h2 class="fs-2 text-center">To be continued...</h2>
        <h3 class="fs-1 text-center">Updates folgen!</h3>
      </div>
    </div>
  </section>

</main>

<?php snippet('globals/footer') ?>
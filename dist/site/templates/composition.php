<?php snippet('globals/header') ?>

<main id="main" class="container my-sm-4 px-sm-4 py-4">

  <?php foreach($page->children() as $child) {
    snippet('components/' . $child->template()->name(), ['data' => $child]);
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
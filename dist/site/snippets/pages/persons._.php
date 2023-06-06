<?php
  $categoryDirectionClass = $data->category_text_direction()->directionClass();

  $persons = $data->children();
  if (!$kirby->user()) {
    $persons = $persons->listed();
  }
  $personsArray = $persons->toArray();

  $allPersonsHaveCategories = array_reduce($personsArray, function($carry, $person) {
    return $carry && isset($person['content']['category']) && !empty($person['content']['category']);
  }, true);

  $categories = [];
  if ($allPersonsHaveCategories) {
    // get all categories
    $categories = $persons->pluck('category');
    // reduce to unique values
    $categories = array_unique($categories);
    // reindex array
    $categories = array_combine(range(0, count($categories) - 1), $categories);
  }
?>

<section class="py-4">

  <?php snippet('atoms/section-heading', [ 'data' => $data ]); ?>

  <div class="row">

    <?php if (!empty($categories)): ?>

      <?php foreach ($categories as $k => $category): ?>
        <div class="col-12 col-lg-6 <?= $k === 2 ? 'mt-3 mt-md-0' : '' ?>">
          <h2 class="pb-3 mb-n4 mb-md-n5 <?= $categoryDirectionClass?>"><?= $category ?></h2>
          <?php
            $personGroup = $persons->filterBy('category', $category);
            foreach ($personGroup as $person) {
              snippet('pages/persons.entry', [ 'data' => $person ]);
            }
          ?>
        </div>
      <?php endforeach; ?>

    <?php else: ?>

      <?php foreach ($data->children() as $person) {
        snippet('pages/persons.entry', [ 'data' => $person ]);
      } ?>

    <?php endif; ?>

  </div>

</section>
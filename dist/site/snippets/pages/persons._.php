<?php
  $show_title = $show_title ?? $data->show_title()->toBool();
  $titleDirectionClass = $data->title_text_direction()->directionClass();
  $categoryDirectionClass = $data->category_text_direction()->directionClass();

  $persons = $data->children();
  if (!$kirby->user()) {
    $persons = $persons->listed();
  }
  $personsArray = $persons->toArray();
  $allPersonsHaveCategories = array_reduce($personsArray, function($carry, $person) {
    return $carry && isset($person['content']['category']);
  }, true);
  $categories = [];
  if ($allPersonsHaveCategories) {
    $categories = $persons->pluck('category');
    $categories = array_unique($categories);
    sort($categories);
  }
?>
<section class="py-4">
  <div class="row">
    <?php if ($show_title): ?>
      <h2 class="<?=$titleDirectionClass?>"><?=$data->title()?></h2>
    <?php endif; ?>
    <?php if (!empty($categories)): ?>
      <?php foreach ($categories as $k => $category): ?>
        <div class="col-12 col-md-6 <?= $k === 2 ? 'mt-3 mt-md-0' : '' ?>">
          <h2 class="pb-3 mb-n4 mb-md-n5 <?=$categoryDirectionClass?>"><?= $category ?></h2>
          <?php
            $personGroup = $persons->filterBy('category', $category);
            foreach ($personGroup as $person) {
              snippet('pages/persons.entry', [ 'data' => $person ]);
            }
          ?>
        </div>
      <?php endforeach; ?>
    <?php else:
      foreach ($data->children() as $person) {
        snippet('pages/persons.entry', [ 'data' => $person ]);
      }
    endif; ?>
  </div>
</section>

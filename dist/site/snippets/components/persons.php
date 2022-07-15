<section class="py-4">
  <div class="row">
    <?php
      $persons = $data->children();
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
    <?php if (!empty($categories)): ?>
      <?php foreach ($categories as $k => $category): ?>
        <div class="col-12 col-md-6 <?= $k === 2 ? 'mt-3 mt-md-0' : '' ?>">
          <h2 class="pb-3 mb-n4 mb-md-n5"><?= $category ?></h2>
          <?php
            $personGroup = $persons->filterBy('category', $category);
            foreach ($personGroup as $person) {
              snippet('components/' . $person->template()->name(), [ 'data' => $person ]);
            }
          ?>
        </div>
      <?php endforeach; ?>
    <?php else:
      foreach ($data->children() as $person) {
        snippet('components/' . $person->template()->name(), [ 'data' => $person ]);
      }
    endif; ?>
  </div>
</section>

<?php
  $isInjected = isset($injected) && $injected === true;
  if (!$isInjected) {
    snippet('globals/header');
  }
?>

<?php
  $categoryDirectionClass = $page->category_text_direction()->directionClass();
  $persons = $page->visibleChildren();
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

  $injected = true;
  $data = compact('site', 'kirby', 'injected');
?>

<section class="py-4">

  <?php snippet('atoms/section-heading', [ 'data' => $page,'injected' => $isInjected ]); ?>

  <div class="row">

    <?php if (!empty($categories)): ?>

      <?php foreach ($categories as $k => $category): ?>
        <div class="col-12 col-lg-6 <?= $k === 2 ? 'mt-3 mt-md-0' : '' ?>">
          <h2 class="pb-3 mb-n4 mb-md-n5 <?= $categoryDirectionClass?>"><?= $category ?></h2>
          <?php
            $personGroup = $persons->filterBy('category', $category);
            foreach ($personGroup as $person) {
              $data['page'] = $person;
              echo $person->template()->render($data);
            }
          ?>
        </div>
      <?php endforeach; ?>

    <?php else: ?>

      <?php foreach ($persons as $person) {
          $data['page'] = $person;
          echo $person->template()->render($data);
      } ?>

    <?php endif; ?>

  </div>

</section>

<?php
  if (!$isInjected) {
    snippet('globals/footer');
  }
?>
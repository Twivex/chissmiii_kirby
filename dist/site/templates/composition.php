<?php snippet('globals/header') ?>

<?php if ($page->show_title()->toBool() === true): ?>
  <h1 class="<?=$page->title_text_direction()->directionClass()?>"><?=$page->title()?></h1>
<?php endif; ?>

<?php foreach($page->children() as $child) {
  snippet($child->blueprint()->name(), [ 'data' => $child ]);
} ?>

<?php snippet('globals/footer') ?>
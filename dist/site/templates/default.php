<?php snippet('globals/header') ?>

<?php if ($page->parents()->count() === 0): ?>
  <h1 class="<?=$page->title_text_direction()->directionClass()?>"><?=$page->title()?></h1>
<?php endif; ?>

<?php
  snippet($page->blueprint()->name(), [
    'show_title' => false,
    'data' => $page
  ]);
?>

<?php snippet('globals/footer') ?>
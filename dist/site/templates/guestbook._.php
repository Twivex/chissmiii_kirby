<?php snippet('globals/header') ?>

<?php if ($page->parent() === null): ?>
  <h1 class="<?=$page->title_text_direction()->directionClass()?>"><?=$page->title()?></h1>
<?php endif; ?>

<?php
  snippet('pages/guestbook._', [
    'show_title' => false,
    'data' => $page
  ]);
?>

<?php snippet('globals/footer') ?>

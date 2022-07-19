<section class="py-4 timeline">
  <?php if($data->show_title()->toBool()): ?>
    <h2 class="<?=$data->title_text_direction()->directionClass()?>"><?=$data->title()?></h2>
  <?php endif; ?>
  <?php foreach ($data->children() as $entry) {
    $entry = $entry->update([
      'alternating' => $data->alternating_entries()->toBool()
    ]);
    snippet('pages/tl_entry', ['data' => $entry]);
  }?>
</section>
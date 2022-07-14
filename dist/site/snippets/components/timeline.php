<!-- TIMELINE -->
<section class="py-4 timeline">
  <?php foreach ($data->children() as $entry) {
    snippet('components/' . $entry->template()->name(), ['data' => $entry]);
  }?>
</section>
<!-- EO TIMELINE -->
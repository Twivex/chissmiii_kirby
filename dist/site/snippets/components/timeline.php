<!-- TIMELINE -->
<section class="py-4 timeline">
  <?php foreach ($data->children()->sortBy('tl_date', 'asc') as $entry) {
    snippet('components/' . $entry->template()->name(), ['data' => $entry]);
  }?>
</section>

<!-- EO TIMELINE -->
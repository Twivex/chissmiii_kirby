<!-- TIMELINE -->
<section class="py-4 timeline">
  <?php foreach ($data->children() as $entry) {
    snippet('pages/tl_entry', ['data' => $entry]);
  }?>
</section>
<!-- EO TIMELINE -->
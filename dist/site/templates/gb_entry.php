<div class="row">
  <div class="col-12">
    <h5><?=$page->name()?> – <small class="text-muted"><?=$page->created_at()->toDate('d.m.y H:i')?></small></h5>
    <p class="text"><?=$page->message()?></p>
  </div>
</div>
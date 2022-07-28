<div class="row">
  <div class="col-12">
    <h5><?=$data->name()?> – <small class="text-muted"><?=$data->created_at()->toDate('d.m.y H:i')?></small></h5>
    <p class="text"><?=$data->message()?></p>
  </div>
</div>
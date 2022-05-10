<div class="card px-1">
  <img src="<?=$imageUrl?>" class="card-img-top" alt="<?=$imageAlt?>">
  <div class="card-body">
    <h5 class="card-title"><?=$title?></h5>
    <p class="card-text"><?=kt($description)?></p>
    <ul>
      <li>Datum: <?=$date->toDate('d.m.y')?></li>
      <?php if ($date->isNotEmpty()): ?>
        <li>Zeit: <?=$time->toDate('H:i')?> Uhr</li>
      <?php endif; ?>
      <?php if ($companion->isNotEmpty()): ?>
        <li>Anhang: <?=$companion?></li>
      <?php endif; ?>
      <?php if ($fooddrinks->isNotEmpty()): ?>
        <li>Essen/Trinken: <?=$fooddrinks?></li>
      <?php endif; ?>
    </ul>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
<?= $kirby->response()->json([
  'error' => $alert ?? null,
  'data' => $data ?? null,
  'html'  => $html ?? false,
]) ?>
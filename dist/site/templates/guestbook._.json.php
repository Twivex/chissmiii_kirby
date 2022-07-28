<?= $kirby->response()->json([
  'error' => $alert ?? null,
  'form_data' => $form_data ?? null,
  'html'  => $html ?? false,
]) ?>
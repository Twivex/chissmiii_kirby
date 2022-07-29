<?= $kirby->response()->json([
  'error' => $error ?? null,
  'form_data' => $form_data ?? null,
  'html'  => $html ?? false,
]) ?>
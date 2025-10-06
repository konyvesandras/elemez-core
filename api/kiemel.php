<?php
// api/kiemel.php
header('Content-Type: application/json; charset=utf-8');
$fn = __DIR__ . '/../data/kiemeltek.json';

// ensure directory
if (!file_exists(dirname($fn))) @mkdir(dirname($fn), 0755, true);

// GET: visszaadja a jelenlegi listát
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $s = @file_get_contents($fn);
    $s = preg_replace('/^\xEF\xBB\xBF/', '', $s);
    $data = json_decode($s, true);
    if (!is_array($data)) $data = [];
    echo json_encode(array_values($data), JSON_UNESCAPED_UNICODE);
    exit;
}

// POST: hozzáad egy szót (json body: {"word":"...","context":"...","meta":{...}})
$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input) || empty($input['word'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing word']);
    exit;
}
$word = trim($input['word']);
$context = $input['context'] ?? '';
$meta = $input['meta'] ?? [];

// load existing
$existing = [];
$s = @file_get_contents($fn);
$s = preg_replace('/^\xEF\xBB\xBF/', '', $s);
$existing = json_decode($s, true);
if (!is_array($existing)) $existing = [];

// prevent duplicates by exact word
foreach ($existing as $e) {
    if (isset($e['word']) && $e['word'] === $word) {
        http_response_code(200);
        echo json_encode(['status'=>'exists','word'=>$word]);
        exit;
    }
}

// append
$entry = ['word'=>$word,'context'=>$context,'meta'=>$meta,'added_at'=>date('c')];
$existing[] = $entry;
file_put_contents($fn, json_encode($existing, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT), LOCK_EX);

echo json_encode(['status'=>'ok','entry'=>$entry], JSON_UNESCAPED_UNICODE);

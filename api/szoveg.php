<?php
/**
 * API végpont: szöveg és elemzések visszaadása JSON formátumban
 */

header('Content-Type: application/json; charset=utf-8');

$dataDir = __DIR__ . '/../data/';

// Betöltjük a szükséges fájlokat
$files = [
    'szokivonat' => 'szokivonat.json',
    'analyze'    => 'analyze.json',
    'translate'  => 'translate.json',
    'kiemeltek'  => 'kiemeltek.json'
];

$response = [];

foreach ($files as $key => $file) {
    $path = $dataDir . $file;
    if (file_exists($path)) {
        $json = file_get_contents($path);
        $response[$key] = json_decode($json, true) ?: [];
    } else {
        $response[$key] = [];
    }
}

// Válasz visszaadása
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

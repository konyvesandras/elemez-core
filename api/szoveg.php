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

// Betöltjük az eredeti szöveget
$textFile = $dataDir . 'elemzes.txt';
$fullText = file_exists($textFile) ? file_get_contents($textFile) : '';

// Kiemelések alkalmazása
if (!empty($fullText)) {
    $words = preg_split('/\\s+/', $fullText);
    $highlighted = $response['kiemeltek'] ?? [];

    $htmlWords = array_map(function($word) use ($highlighted) {
        $clean = trim($word);
        if ($clean !== '' && in_array($clean, $highlighted)) {
            return "<span class=\"highlight\">{$clean}</span>";
        }
        return htmlspecialchars($clean, ENT_QUOTES, 'UTF-8');
    }, $words);

    $response['szoveg'] = implode(' ', $htmlWords);
} else {
    $response['szoveg'] = '';
}

// Válasz visszaadása
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

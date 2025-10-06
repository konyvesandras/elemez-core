<?php
header('Content-Type: application/json; charset=utf-8');

// AMP CORS header-ek
$origin = isset($_GET['__amp_source_origin']) ? $_GET['__amp_source_origin'] : '';
if ($origin) {
    header('Access-Control-Allow-Origin: *');
    header('AMP-Access-Control-Allow-Source-Origin: ' . $origin);
    header('Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin');
}

$dataDir = __DIR__ . '/../data/';

// Betöltjük a JSON fájlokat
function loadJson($path) {
    return file_exists($path) ? (json_decode(file_get_contents($path), true) ?: []) : [];
}

$szokivonat = loadJson($dataDir . 'szokivonat.json');
$analyze    = loadJson($dataDir . 'analyze.json');
$translate  = loadJson($dataDir . 'translate.json');
$kiemeltek  = loadJson($dataDir . 'kiemeltek.json');

// Betöltjük a teljes szöveget
$textFile = $dataDir . 'elemzes.txt';
$fullText = file_exists($textFile) ? file_get_contents($textFile) : '';

// Szöveg feldarabolása és kiemelések alkalmazása
$html = '';
if ($fullText !== '') {
    $words = preg_split('/\s+/', $fullText);
    $htmlWords = array_map(function($word) use ($kiemeltek) {
        $clean = trim($word);
        if ($clean === '') return '';
        if (in_array($clean, $kiemeltek)) {
            return '<span class="highlight">' . htmlspecialchars($clean, ENT_QUOTES, 'UTF-8') . '</span>';
        }
        return htmlspecialchars($clean, ENT_QUOTES, 'UTF-8');
    }, $words);
    $html = implode(' ', $htmlWords);
}

// Összeállítjuk a választ
$response = [
    'szokivonat' => $szokivonat,
    'analyze'    => $analyze,
    'translate'  => $translate,
    'kiemeltek'  => $kiemeltek,
    'szoveg'     => $html
];

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

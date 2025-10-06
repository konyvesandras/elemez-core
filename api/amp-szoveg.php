<?php
header('Content-Type: application/json; charset=utf-8');

// AMP CORS header-ek
$origin = $_GET['__amp_source_origin'] ?? '';
if ($origin) {
    header('Access-Control-Allow-Origin: *');
    header('AMP-Access-Control-Allow-Source-Origin: ' . $origin);
    header('Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin');
}

$dataDir = __DIR__ . '/../data/';

// Betöltjük a kiemeléseket
$kiemeltekFile = $dataDir . 'kiemeltek.json';
$kiemeltek = file_exists($kiemeltekFile) ? json_decode(file_get_contents($kiemeltekFile), true) : [];

// Betöltjük az eredeti szöveget
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

// Csak a szükséges mezőt adjuk vissza
$response = [
    'szoveg' => $html
];

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

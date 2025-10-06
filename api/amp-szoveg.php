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

// --- Metaadatok előállítása ---
$textFile = $dataDir . 'elemzes.txt';
$meta = [
    'cim'     => basename($textFile),
    'datum'   => file_exists($textFile) ? date("Y-m-d H:i", filemtime($textFile)) : '',
    'szerzo'  => 'Ismeretlen',
    'letoltes'=> file_exists($textFile) ? '../data/' . basename($textFile) : '',
    'meret'   => file_exists($textFile) ? round(filesize($textFile) / 1024) . ' KB' : ''
];

// --- Szöveg + kiemelések ---
$kiemeltekFile = $dataDir . 'kiemeltek.json';
$kiemeltek = file_exists($kiemeltekFile) ? json_decode(file_get_contents($kiemeltekFile), true) : [];

$fullText = file_exists($textFile) ? file_get_contents($textFile) : '';
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

// --- Záró rész ---
$zaras = "Forrás: elemez-core rendszer";

// --- JSON összeállítása ---
$response = [
    'items' => [
        $meta,
        [ 'szoveg' => $html ],
        [ 'zaras'  => $zaras ]
    ]
];

$json = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// Kimenet a böngészőnek
echo $json;

// Mentés a public mappába is (felülírva!)
file_put_contents(__DIR__ . '/../public/amp-szoveg.json', $json, LOCK_EX);

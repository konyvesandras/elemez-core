<?php
/**
 * Előfeldolgozás: szókivonat, elemzés, fordítás
 * Csak akkor fut újra, ha a bemeneti szöveg változott.
 */

require_once __DIR__ . '/functions.php';

$dataDir   = __DIR__ . '/../data/';
$textFile  = $dataDir . 'elemzes.txt';
$stampFile = $dataDir . 'stamp.txt';

// Ellenőrizzük, hogy változott-e a szöveg
$currentStamp = file_exists($textFile) ? filemtime($textFile) : 0;
$lastStamp    = file_exists($stampFile) ? (int)file_get_contents($stampFile) : 0;

if ($currentStamp === $lastStamp) {
    echo "Nincs változás. Előfeldolgozás kihagyva.\n";
    exit;
}

// Szöveg betöltése és feldolgozása
$lines = load_text('elemzes.txt');
$words = get_unique_words($lines);

$analyze   = [];
$translate = [];

foreach ($words as $word) {
    $info = analyze_word($word);
    $analyze[$word]   = $info;
    $translate[$word] = $info['forditas'];
}

// JSON fájlok mentése
file_put_contents($dataDir . 'szokivonat.json', json_encode($words, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
file_put_contents($dataDir . 'analyze.json',   json_encode($analyze, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
file_put_contents($dataDir . 'translate.json', json_encode($translate, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
file_put_contents($stampFile, $currentStamp);

echo "Előfeldolgozás kész: " . count($words) . " egyedi szó feldolgozva.\n";

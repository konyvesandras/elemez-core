<?php
/**
 * Központi függvények az elemez-core projekthez
 * Moduláris: betöltés, feldolgozás, tárolás
 */

// Szöveg betöltése fájlból
function load_text($file) {
    $path = __DIR__ . '/../data/' . basename($file);
    if (!file_exists($path)) return [];
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_map('trim', $lines);
}

// Egyedi szavak kigyűjtése
function get_unique_words(array $lines) {
    $words = [];
    foreach ($lines as $line) {
        $tokens = preg_split('/\s+/', $line);
        foreach ($tokens as $token) {
            $clean = mb_strtolower(trim($token));
            $clean = preg_replace('/[^\p{L}]/u', '', $clean); // csak betűk
            if ($clean !== '') {
                $words[] = $clean;
            }
        }
    }
    return array_values(array_unique($words));
}

// Szavak elemzése (egyszerűsített logika)
function analyze_word($word) {
    return [
        'text'     => $word,
        'tooltip'  => 'Elemzés itt',
        'forditas' => translate_word($word)
    ];
}

// Fordítás (egyszerű szótár)
function translate_word($word) {
    $dict = [
        'Isten' => 'God',
        'ember' => 'man'
    ];
    return $dict[$word] ?? null;
}

// Kiemelések betöltése
function load_highlights() {
    $path = __DIR__ . '/../data/kiemeltek.json';
    if (!file_exists($path)) return [];
    $json = file_get_contents($path);
    return json_decode($json, true) ?: [];
}

// Kiemelések mentése
function save_highlights($words) {
    $path = __DIR__ . '/../data/kiemeltek.json';
    file_put_contents(
        $path,
        json_encode(array_values(array_unique($words)), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
    );
}

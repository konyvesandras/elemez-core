<?php
/**
 * API végpont: kiemelt szavak mentése és visszaadása
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../process/functions.php';

$method = $_SERVER['REQUEST_METHOD'];
$response = [];

if ($method === 'POST') {
    // Beérkező JSON feldolgozása
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['words']) && is_array($input['words'])) {
        // Betöltjük a meglévő kiemeléseket
        $existing = load_highlights();

        // Új szavak hozzáadása
        $merged = array_unique(array_merge($existing, $input['words']));

        // Mentés
        save_highlights($merged);

        $response = [
            'status' => 'ok',
            'count'  => count($merged),
            'words'  => $merged
        ];
    } else {
        $response = [
            'status'  => 'error',
            'message' => 'Hibás bemenet: "words" tömb szükséges.'
        ];
    }
} elseif ($method === 'GET') {
    // Csak visszaadjuk a meglévő kiemeléseket
    $response = [
        'status' => 'ok',
        'words'  => load_highlights()
    ];
} else {
    $response = [
        'status'  => 'error',
        'message' => 'Csak GET vagy POST metódus engedélyezett.'
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

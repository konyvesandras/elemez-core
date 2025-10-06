<?php
// api/adapter.php
header('Content-Type: application/json; charset=utf-8');

// Választható forrás: 'amp' vagy 'orig'
$source = $_GET['source'] ?? 'amp';

// Paths (ajánlott abszolút vagy __DIR__ alapú)
$public = __DIR__ . '/../public';
$api = __DIR__;

// load function
function load_json_file($path) {
    if (!file_exists($path)) return null;
    $s = file_get_contents($path);
    // strip BOM if present
    $s = preg_replace('/^\xEF\xBB\xBF/', '', $s);
    $d = json_decode($s, true);
    return $d;
}

$response = [
    'source' => $source,
    'items' => []
];

if ($source === 'orig') {
    // próbáljuk meghívni az eredeti api/szoveg.php (ha az saját JSON-t ad, akkor közvetlen)
    $origPath = $api . '/szoveg.php';
    // Ha szoveg.php nem fájl, hanem endpoint, include/require a kimenetet bufferbe:
    if (file_exists($origPath)) {
        ob_start();
        include $origPath;
        $out = ob_get_clean();
        $out = preg_replace('/^\xEF\xBB\xBF/', '', $out);
        $data = json_decode($out, true);
        if (is_array($data)) {
            $response['items'] = $data;
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    // fallback: próbáljuk a public/szoveg.json-et
    $d = load_json_file($public . '/szoveg.json');
    if ($d !== null) $response['items'] = $d;
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// default: amp-szoveg.json (items tömb)
$d = load_json_file($public . '/amp-szoveg.json');
if (isset($d['items']) && is_array($d['items'])) {
    // visszaadjuk ugyanazt az items tömböt a kliensnek
    $response['items'] = $d['items'];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// ha semmi nincs, üres tömb
echo json_encode($response, JSON_UNESCAPED_UNICODE);

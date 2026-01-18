<?php
// Permitir CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Manejar preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Obtener la query de búsqueda
$query = isset($_GET['q']) ? $_GET['q'] : '*:*';
$rows = isset($_GET['rows']) ? $_GET['rows'] : 20;

// Construir URL de Solr
$solr_url = "http://localhost:8983/solr/techblog/select";
$params = array(
    'q' => $query,
    'rows' => $rows,
    'wt' => 'json'
);

// Agregar parámetros adicionales si existen
if (isset($_GET['start'])) {
    $params['start'] = $_GET['start'];
}

// Construir URL completa
$full_url = $solr_url . '?' . http_build_query($params);

try {
    // Hacer la petición a Solr
    $response = @file_get_contents($full_url);
    
    if ($response === false) {
        http_response_code(503);
        echo json_encode([
            'error' => 'No se pudo conectar con Solr en localhost:8983',
            'url_attempted' => $full_url
        ]);
        exit;
    }
    
    // Retornar la respuesta
    echo $response;
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>

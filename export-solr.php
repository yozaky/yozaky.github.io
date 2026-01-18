<?php
/**
 * Script para exportar datos de Solr a un archivo JSON estático
 * Ejecutar: http://localhost/yozaky.github.io/export-solr.php
 */

$solr_url = "http://localhost:8983/solr/techblog/select?q=*:*&rows=100&wt=json";

try {
    $response = @file_get_contents($solr_url);
    
    if ($response === false) {
        die("Error: No se pudo conectar con Solr en localhost:8983");
    }
    
    $data = json_decode($response, true);
    
    if ($data === null) {
        die("Error: Respuesta inválida de Solr");
    }
    
    // Guardar en archivo JSON
    $output_file = __DIR__ . '/data.json';
    if (file_put_contents($output_file, json_encode($data, JSON_PRETTY_PRINT))) {
        echo "<h2 style='color: green;'>✓ Datos exportados correctamente a data.json</h2>";
        echo "<p>Total de documentos: " . $data['response']['numFound'] . "</p>";
        echo "<p><a href='./data.json'>Ver archivo</a></p>";
    } else {
        echo "<h2 style='color: red;'>✗ Error al guardar el archivo</h2>";
    }
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>✗ Error: " . $e->getMessage() . "</h2>";
}
?>

<?php
// Configuración de CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Encabezados permitidos

// Si el método es OPTIONS, devuelve un código de éxito 200
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit; // Terminar la ejecución, ya que solo estamos respondiendo a la solicitud OPTIONS
}
?>

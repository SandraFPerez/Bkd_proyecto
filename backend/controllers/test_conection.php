<?php
require_once ('../routers/cors.php'); // Si el archivo está un nivel arriba
require_once '../db/db.php';// Asegúrate de incluir correctamente la conexión a tu base de datos.
try {
    $query = "SELECT * from  vehiculo";
    $stmt = $db->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(["success" => true, "message" => "Conexión exitosa", "data" => $result]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

<?php
require_once ('../routers/cors.php');
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_vehiculo = $data['id_vehiculo'];
    $modelo = $data['modelo'];
    $marca = $data['marca'];
    $estado = $data['estado'];

    $query = "CALL registrar_vehiculo(:id_vehiculo, :modelo, :marca, :estado)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_vehiculo', $id_vehiculo);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();

    echo json_encode(["message" => "Vehículo registrado exitosamente."]);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM vehiculo";
    $stmt = $db->query($query);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

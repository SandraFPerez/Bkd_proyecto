<?php
require_once '../controllers/RentaController.php';
require_once '../controllers/FacturaController.php';
require_once '../controllers/AuditoriaController.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'];

switch ($endpoint) {
    case 'registrarRenta':
        if ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new RentaController();
            $response = $controller->registrarRenta(
                $data['idVehiculo'],
                $data['idCliente'],
                $data['fechaInicio'],
                $data['fechaFin']
            );
            echo json_encode($response);
        }
        break;

    case 'generarFactura':
        if ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new FacturaController();
            $response = $controller->generarFactura($data['idRenta']);
            echo json_encode($response);
        }
        break;

    case 'obtenerAuditorias':
        if ($method === 'GET') {
            $controller = new AuditoriaController();
            $response = $controller->obtenerAuditorias();
            echo json_encode($response);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Endpoint no encontrado"]);
        break;
}
?>

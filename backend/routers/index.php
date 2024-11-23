<?php
// Incluir el archivo CORS primero para manejar las cabeceras correctamente
require_once('cors.php'); // CORS debe estar primero

// Incluir controladores
require_once('../controllers/auditoria.php');
require_once('../controllers/facturacion.php');
require_once('../controllers/reserva.php');
require_once('../controllers/vehiculos.php');
require_once('../controllers/auth.php'); // Nuevo archivo para la autenticación

header('Content-Type: application/json'); // Tipo de respuesta JSON

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'];

// Procesamiento de la solicitud
switch ($endpoint) {
    case 'login':
        if ($method === 'POST') {
            // Recibimos las credenciales del usuario
            $data = json_decode(file_get_contents('php://input'), true);
            $usuario = $data['usuario'];
            $password = $data['password'];

            // Controlador para manejar la autenticación
            $controller = new AuthController();
            $response = $controller->login($usuario, $password);
            echo json_encode($response);
        }
        break;

    case 'registrarRenta':
        if ($method === 'POST') {
            // Verificar el usuario y la contraseña antes de permitir el acceso
            if (!isset($_SESSION['usuario'])) {
                http_response_code(403);
                echo json_encode(["message" => "Acceso denegado. Usuario no autenticado."]);
                exit;
            }

            // Si el usuario está autenticado, proceder con la operación
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
            // Verificar el usuario y la contraseña antes de permitir el acceso
            if (!isset($_SESSION['usuario'])) {
                http_response_code(403);
                echo json_encode(["message" => "Acceso denegado. Usuario no autenticado."]);
                exit;
            }

            // Si el usuario está autenticado, proceder con la operación
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new FacturaController();
            $response = $controller->generarFactura($data['idRenta']);
            echo json_encode($response);
        }
        break;

    case 'obtenerAuditorias':
        if ($method === 'GET') {
            // Verificar el usuario y la contraseña antes de permitir el acceso
            if (!isset($_SESSION['usuario'])) {
                http_response_code(403);
                echo json_encode(["message" => "Acceso denegado. Usuario no autenticado."]);
                exit;
            }

            // Si el usuario está autenticado, proceder con la operación
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

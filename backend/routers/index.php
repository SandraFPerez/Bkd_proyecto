<?php
// Rutas del sistema

include_once '../controllers/reserva.php';
include_once '../controllers/facturacion.php';
include_once '../controllers/auditoria.php';

// Ruta para registrar una reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'registrar_reserva') {
    $id_vehiculo = $_POST['id_vehiculo'];
    $id_cliente = $_POST['id_cliente'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    
    registrarReserva($id_vehiculo, $id_cliente, $fecha_inicio, $fecha_fin);
    echo 'Reserva registrada correctamente';
}

// Ruta para generar una factura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'generar_factura') {
    $id_renta = $_POST['id_renta'];
    
    generarFactura($id_renta);
    echo 'Factura generada correctamente';
}

// Ruta para registrar una auditoría (opcional para uso manual)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'registrar_auditoria') {
    $tabla_afectada = $_POST['tabla_afectada'];
    $operacion = $_POST['operacion'];
    $registro_id = $_POST['registro_id'];
    $usuario = $_POST['usuario'];

    registrarAuditoria($tabla_afectada, $operacion, $registro_id, $usuario);
    echo 'Auditoría registrada correctamente';
}
?>

<?php
include_once '../db/db.php';

// Generar factura
function generarFactura($id_renta) {
    global $conn;
    try {
        // Obtener datos de la renta
        $stmt = $conn->prepare("SELECT (fecha_fin - fecha_inicio) * tarifa_diaria AS total, id_cliente 
                               FROM renta r
                               JOIN vehiculo v ON r.id_vehiculo = v.id_vehiculo
                               WHERE r.id_renta = :id_renta");
        $stmt->execute(['id_renta' => $id_renta]);
        $renta = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $renta['total'];
        $id_cliente = $renta['id_cliente'];

        // Insertar factura
        $stmt = $conn->prepare("INSERT INTO facturacion (id_renta, id_cliente, monto_total, fecha_factura) 
                               VALUES (:id_renta, :id_cliente, :monto_total, SYSDATE)");
        $stmt->execute([
            'id_renta' => $id_renta,
            'id_cliente' => $id_cliente,
            'monto_total' => $total
        ]);

        // Registrar auditoría
        $stmt = $conn->prepare("INSERT INTO auditoria (tabla_afectada, operacion, registro_id, usuario, fecha_operacion) 
                               VALUES ('facturacion', 'INSERT', :id_renta, :usuario, SYSDATE)");
        $stmt->execute(['id_renta' => $id_renta, 'usuario' => $_SESSION['user']]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

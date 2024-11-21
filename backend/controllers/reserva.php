<?php
include_once '../db/db.php';

// Registrar reserva
function registrarReserva($id_vehiculo, $id_cliente, $fecha_inicio, $fecha_fin) {
    global $conn;
    try {
        // Iniciar transacción
        $conn->beginTransaction();

        // Verificar disponibilidad del vehículo
        $stmt = $conn->prepare("SELECT estado FROM vehiculo WHERE id_vehiculo = :id_vehiculo");
        $stmt->execute(['id_vehiculo' => $id_vehiculo]);
        $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($vehiculo['estado'] !== 'DISPONIBLE') {
            throw new Exception('El vehículo no está disponible.');
        }

        // Insertar reserva
        $stmt = $conn->prepare("INSERT INTO reserva (id_vehiculo, id_cliente, fecha_inicio, fecha_fin) 
                               VALUES (:id_vehiculo, :id_cliente, :fecha_inicio, :fecha_fin)");
        $stmt->execute([
            'id_vehiculo' => $id_vehiculo,
            'id_cliente' => $id_cliente,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ]);

        // Actualizar estado del vehículo
        $stmt = $conn->prepare("UPDATE vehiculo SET estado = 'RESERVADO' WHERE id_vehiculo = :id_vehiculo");
        $stmt->execute(['id_vehiculo' => $id_vehiculo]);

        // Registrar en auditoría
        $stmt = $conn->prepare("INSERT INTO auditoria (tabla_afectada, operacion, registro_id, usuario, fecha_operacion) 
                               VALUES ('reserva', 'INSERT', :id_vehiculo, :usuario, SYSDATE)");
        $stmt->execute(['id_vehiculo' => $id_vehiculo, 'usuario' => $_SESSION['user']]);

        // Confirmar transacción
        $conn->commit();
    } catch (Exception $e) {
        // Revertir en caso de error
        $conn->rollBack();
        echo 'Error: ' . $e->getMessage();
    }
}
?>

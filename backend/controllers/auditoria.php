<?php
include_once '../db/db.php';

// Registrar acción en auditoría
function registrarAuditoria($tabla_afectada, $operacion, $registro_id, $usuario) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO auditoria (tabla_afectada, operacion, registro_id, usuario, fecha_operacion) 
                               VALUES (:tabla_afectada, :operacion, :registro_id, :usuario, SYSDATE)");
        $stmt->execute([
            'tabla_afectada' => $tabla_afectada,
            'operacion' => $operacion,
            'registro_id' => $registro_id,
            'usuario' => $usuario
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

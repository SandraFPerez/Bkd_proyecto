<?php
// Incluir el archivo de CORS para manejar las cabeceras
require_once ('../routers/cors.php');

// Incluir la clase para la base de datos
require_once '../db/db.php';

class AuditoriaController {
    private $db;

    public function __construct() {
        // Crear la conexión a la base de datos
        $this->db = (new Database())->getConnection();
    }

    public function obtenerAuditorias() {
        // Consulta SQL para obtener las auditorías
        $sql = "SELECT * FROM auditoria ORDER BY fecha_hora DESC";
        
        // Preparar y ejecutar la consulta
        $stmt = oci_parse($this->db, $sql);
        
        // Verificar si la consulta se ejecutó correctamente
        if (!oci_execute($stmt)) {
            // Si ocurre un error, devolver el mensaje de error
            $error = oci_error($stmt);
            return ["error" => "Error ejecutando la consulta: " . $error['message']];
        }

        // Arreglo para almacenar los resultados
        $auditorias = [];
        
        // Recoger los resultados de la consulta
        while ($row = oci_fetch_assoc($stmt)) {
            $auditorias[] = $row;
        }

        // Retornar los resultados de las auditorías
        return $auditorias;
    }
}
?>

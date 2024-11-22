<?php
require_once '../db/db.php';

class AuditoriaController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function obtenerAuditorias() {
        $sql = "SELECT * FROM auditoria ORDER BY fecha_hora DESC";
        $stmt = oci_parse($this->db, $sql);
        oci_execute($stmt);

        $auditorias = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $auditorias[] = $row;
        }

        return $auditorias;
    }
}
?>

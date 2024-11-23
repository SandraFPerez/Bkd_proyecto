<?php
require_once ('../routers/cors.php');
require_once '../db/db.php';

class FacturaController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function generarFactura($idRenta) {
        $sql = "BEGIN generar_factura(:idRenta); END;";
        $stmt = oci_parse($this->db, $sql);

        oci_bind_by_name($stmt, ":idRenta", $idRenta);

        if (!oci_execute($stmt)) {
            $error = oci_error($stmt);
            return ["success" => false, "message" => $error['message']];
        }

        return ["success" => true, "message" => "Factura generada correctamente."];
    }
}
?>

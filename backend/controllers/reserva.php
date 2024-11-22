<?php
require_once '../db/db.php';

class RentaController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function registrarRenta($idVehiculo, $idCliente, $fechaInicio, $fechaFin) {
        $sql = "BEGIN registrar_reserva(:idVehiculo, :idCliente, :fechaInicio, :fechaFin); END;";
        $stmt = oci_parse($this->db, $sql);

        oci_bind_by_name($stmt, ":idVehiculo", $idVehiculo);
        oci_bind_by_name($stmt, ":idCliente", $idCliente);
        oci_bind_by_name($stmt, ":fechaInicio", $fechaInicio);
        oci_bind_by_name($stmt, ":fechaFin", $fechaFin);

        if (!oci_execute($stmt)) {
            $error = oci_error($stmt);
            return ["success" => false, "message" => $error['message']];
        }

        return ["success" => true, "message" => "Renta registrada correctamente."];
    }
}
?>

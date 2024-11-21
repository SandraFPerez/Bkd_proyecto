<?php
try {
    // Datos de conexión
    $host = 'localhost'; // O 'oracle-db' si accedes desde otro contenedor
    $port = 1522;
    $service = 'orclpdb'; // Nombre del Pluggable Database
    $username = 'SYSTEM'; // Cambiar si usas otro usuario
    $password = '123456'; // Contraseña configurada en Docker

    // Cadena de conexión para Oracle
    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVICE_NAME=$service)))";

    // Crear la conexión PDO
    $pdo = new PDO($dsn, $username, $password);

    // Configuración adicional (opcional)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión exitosa a la base de datos Oracle.";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>

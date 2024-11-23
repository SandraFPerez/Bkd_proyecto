<?php
try {
    // Datos de conexión
    $host = 'localhost';  // Usar el nombre del contenedor en lugar de localhost
    $port = 1522;         // El puerto estándar de Oracle (no 1522 en este caso)
    $service = 'XE'; // Nombre del Pluggable Database (PDB)
    $username = 'SYSTEM'; // Usuario de conexión
    $password = '123456'; // Contraseña configurada en Docker

    // Cadena de conexión para Oracle
    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVICE_NAME=$service)))";

    // Crear la conexión PDO
    $pdo = new PDO($dsn, $username, $password);

    // Configuración adicional (opcional)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db = $pdo; // Define $db si es necesario


    echo "Conexión exitosa a la base de datos Oracle.";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>

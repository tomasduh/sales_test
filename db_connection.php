<?php
// FILEPATH: /c:/xampp/htdocs/sales_test/connect.php

$servername = "localhost";
$username = "root";
$password = "12345";
$database = "sales";

// Crear la conexión
$connection = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($connection->connect_error) {
    die("Error al conectar a la base de datos: " . $connection->connect_error);
}

?>

<?php

/*$servername = "34.71.24.92";
$username = "root";
$password = "N8516uCCY2gsdfWW7TRa8AF0cnSI9U"; // Usa tu contraseña de MySQL
*/

$servername = "localhost";
$username = "root";
$password = "1234"; // Usa tu contraseña de MySQL

$database = "curso_mercadotecnia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

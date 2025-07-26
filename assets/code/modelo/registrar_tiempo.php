<?php
session_start();
include_once 'conexion.php';

if (isset($_SESSION['id_usuario'], $_POST['minutos'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $minutos = intval($_POST['minutos']);

    // Actualizar el campo horas_U1 acumulando minutos
    $stmt = $conn->prepare("
        UPDATE alumnos a
        INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
        SET a.horas_U1 = IFNULL(a.horas_U1, 0) + ?
        WHERE a.id_usuario = ?
    ");
    $stmt->bind_param("ii", $minutos, $id_usuario);
    $stmt->execute();
    $stmt->close();
}
?>

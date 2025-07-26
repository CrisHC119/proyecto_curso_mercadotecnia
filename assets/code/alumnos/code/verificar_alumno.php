<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: /index.php");
    exit;
}

if (!isset($_SESSION['id_tipo_usuario'])) {
    header("Location: /index.php");
    exit;
}

$tipo = intval($_SESSION['id_tipo_usuario']);

if ($tipo === 3) {
    // Alumno - acceso permitido
} elseif ($tipo === 1 || $tipo === 2) {
    // Profesor o Admin - redirige
    header("Location: /assets/code/profesor/alumnos.php");
    exit;
} else {
    // Valor no válido - redirige
    header("Location: /index.php");
    exit;
}
?>

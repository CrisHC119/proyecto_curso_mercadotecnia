<?php
session_start();
include_once __DIR__ . '/conexion.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
$calificacion = $_POST['calificacion'] ?? null; // se obtiene al evaluar respuestas

if ($id_usuario && is_numeric($calificacion)) {
    // Verifica si el usuario ya tiene calificación
    $stmt = $conexion->prepare("SELECT id_usuario FROM alumnos_calificacion WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);

    if ($stmt->rowCount() > 0) {
        // Ya existe, actualiza calificación y marca examen como realizado
        $update = $conexion->prepare("UPDATE alumnos_calificacion SET calf_1 = ?, examen_U1 = 1 WHERE id_usuario = ?");
        $update->execute([$calificacion, $id_usuario]);
    } else {
        // No existe, insertar nuevo registro
        $insert = $conexion->prepare("INSERT INTO alumnos_calificacion 
        (id_usuario, calf_1, examen_U1, calf_2, calf_3, calf_4, calf_5, examen_U2, examen_U3, examen_U4, examen_U5)
        VALUES (?, ?, 1, NULL, NULL, NULL, NULL, 0, 0, 0, 0)");
        $insert->execute([$id_usuario, $calificacion]);
    }

    // Mostrar resultado sin salir de la página
    echo "<div class='alert alert-success mt-4'>
            Tu calificación fue: <strong>$calificacion</strong><br>
            Examen realizado correctamente.
          </div>";
} else {
    echo "<div class='alert alert-danger'>Error al guardar calificación.</div>";
}
?>

<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_examen'];
    $fecha = $_POST['fecha_disponible'];

    if ($id && $fecha) {
        $stmt = $conn->prepare("UPDATE examen_unidad SET fecha_disponible = ? WHERE id_examen = ?");
        $stmt->bind_param("si", $fecha, $id);
        if ($stmt->execute()) {
            header("Location: ../profesor/examenes.php?success=1");
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    } else {
        echo "Datos inválidos.";
    }
}

?>

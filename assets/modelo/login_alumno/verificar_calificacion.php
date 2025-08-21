<?php
    include_once __DIR__ . '/../conexion.php';

    $id_usuario = $_SESSION['id_usuario'] ?? null;
    $calificaciones = [];

    for ($i = 1; $i <= 5; $i++) {
        $calificaciones["calf_$i"] = null;
    }

    if ($id_usuario) {
        $sql = "SELECT calf_1, calf_2, calf_3, calf_4, calf_5 FROM alumnos_calificacion WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $calificaciones = $resultado->fetch_assoc();
        }

        $stmt->close();
    }
?>
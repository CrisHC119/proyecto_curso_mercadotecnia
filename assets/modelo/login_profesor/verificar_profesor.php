<?php
    // verificar_profesor.php
    include_once __DIR__ . '/../conexion.php';
    $sql = "
    SELECT 
        U.id_usuario, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar, 
        U.id_tipo_usuario, U.campus, U.fecha_registro, -- <-- Añadir fecha_registro
        CASE U.id_tipo_usuario
            WHEN 1 THEN 'Administrador'
            WHEN 2 THEN 'Profesor'
            ELSE 'Desconocido'
        END AS rol
    FROM usuarios U
    WHERE U.id_tipo_usuario IN (1, 2)
    ORDER BY U.id_tipo_usuario, U.nombres;
    ";
    $result = $conn->query($sql);
?>
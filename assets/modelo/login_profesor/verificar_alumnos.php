<?php
    require_once __DIR__ . '/../conexion.php';

    if (!isset($_SESSION['id_usuario']) || $_SESSION['id_tipo_usuario'] != 1) { 
        echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
        exit;
    }
    $sql = "
    SELECT 
        U.id_usuario, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar,
        A.nocontrol AS matricula, A.semestre, A.horas_U1, A.horas_U2, A.horas_U3, A.horas_U4, A.horas_U5,
        U.campus, 'Estudiante' AS rol,
        AC.calf_1, AC.calf_2, AC.calf_3, AC.calf_4, AC.calf_5
    FROM usuarios U
    INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
    LEFT JOIN alumnos_calificacion AC ON U.id_usuario = AC.id_usuario
    ";
    $result = $conn->query($sql);
?>
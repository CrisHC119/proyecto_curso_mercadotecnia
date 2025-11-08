<?php
    require_once __DIR__ . '/../conexion.php'; 

    if (!isset($_SESSION['id_usuario'])) {
        header('Location: /login.php'); 
        exit;
    }

    $id_usuario_sesion = $_SESSION['id_usuario'];
    $conn_activo = $conn; 

    $stmt = $conn_activo->prepare("SELECT id_tipo_usuario FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario_sesion);
    $stmt->execute();
    $resultado_db = $stmt->get_result();

    if ($resultado_db->num_rows === 0) {
        session_destroy();
        header('Location: /login.php?error=user_deleted');
        exit;
    }

    $usuario_db = $resultado_db->fetch_assoc();
    $rol_actual_db = $usuario_db['id_tipo_usuario'];
    $stmt->close();

    if ($rol_actual_db != $_SESSION['id_tipo_usuario']) {
        $_SESSION['id_tipo_usuario'] = $rol_actual_db;
    }

    if ($_SESSION['id_tipo_usuario'] != 1 && $_SESSION['id_tipo_usuario'] != 2) {
        session_destroy();
        header('Location: /login.php?error=permission_denied');
        exit;
    }

    $sql = "
    SELECT 
        U.id_usuario, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar,
        A.nocontrol AS matricula, A.semestre, A.horas_U1, A.horas_U2, A.horas_U3, A.horas_U4, A.horas_U5,
        U.campus, 'Estudiante' AS rol,
        AC.calf_1, AC.calf_2, AC.calf_3, AC.calf_4, AC.calf_5,
        AA.calf_A_1, AA.calf_A_2, AA.calf_A_3, AA.calf_A_4, AA.calf_A_5
    FROM usuarios U
    INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
    LEFT JOIN alumnos_calificacion AC ON U.id_usuario = AC.id_usuario
    LEFT JOIN alumnos_actividad AA ON U.id_usuario = AA.id_usuario
    ";
    $result = $conn_activo->query($sql);
    if (!$result) {
        error_log("Error en la consulta de verificar_alumnos.php: " . $conn_activo->error);
        die("Error fatal: No se pudo obtener la lista de alumnos. Contacte al administrador. Detalles: " . $conn_activo->error);
    }
?>
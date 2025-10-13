<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
$idioma = $_SESSION['lang'] ?? 'es';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $semestre = $_POST['semestre'];
    $campus = $_POST['campus'];
    $nocontrol = $_POST['nocontrol'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $nombreAvatarFinal = 'avatar_default.jpg';
    $verificar = $conn->prepare("SELECT nocontrol FROM alumnos WHERE nocontrol = ?");
    $verificar->bind_param("s", $nocontrol);
    $verificar->execute();
    $verificar->store_result();
    if ($verificar->num_rows > 0) {
        $verificar->close();
        $conn->close();
        header("Location: /register.php?toast_msg=" . urlencode("El número de control ya está registrado.") . "&lang=" . $idioma);
        exit;
    }
    $verificar->close();
    $sqlUsuario = "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, campus, idioma, pass, id_tipo_usuario, fecha_registro, avatar)
                   VALUES (?, ?, ?, ?, ?, ?, 3, NOW(), ?)";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("sssssss", $nombres, $apellido_paterno, $apellido_materno, $campus, $idioma, $pass, $nombreAvatarFinal);
    if ($stmtUsuario->execute()) {
        $id_usuario = $conn->insert_id;
        $stmtUsuario->close();
        $sqlAlumno = "INSERT INTO alumnos (id_usuario, nocontrol, semestre) VALUES (?, ?, ?)";
        $stmtAlumno = $conn->prepare($sqlAlumno);
        $stmtAlumno->bind_param("isi", $id_usuario, $nocontrol, $semestre); 
        if ($stmtAlumno->execute()) {
            $stmtAlumno->close();
            $conn->close();
            header("Location: /register.php?registro=exito&lang=" . $idioma);
            exit;
        } else {
            $error = "Error al registrar en Alumnos: " . $stmtAlumno->error;
            $stmtAlumno->close();
            $conn->close();
            header("Location: /register.php?toast_msg=" . urlencode($error) . "&lang=" . $idioma);
            exit;
        }
    } else {
        $error = "Error al registrar en Usuarios: " . $stmtUsuario->error;
        $stmtUsuario->close();
        $conn->close();
        header("Location: /register.php?toast_msg=" . urlencode($error) . "&lang=" . $idioma);
        exit;
    }
} else {
    header("Location: /register.php?toast_msg=" . urlencode("Método no permitido.") . "&lang=" . $idioma);
    exit;
}
?>
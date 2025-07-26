<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $semestre = $_POST['semestre'];
    $campus = $_POST['campus'];
    $nocontrol = $_POST['nocontrol'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $nombreAvatarFinal = 'avatar_default.jpg';

    // Validar si ya existe nocontrol
    $verificar = $conn->prepare("SELECT nocontrol FROM alumnos WHERE nocontrol = ?");
    $verificar->bind_param("s", $nocontrol);
    $verificar->execute();
    $verificar->store_result();

    if ($verificar->num_rows > 0) {
        $verificar->close();
        $conn->close();
        header("Location: ../../../register.php?toast_msg=" . urlencode("El número de control ya está registrado."));
        exit;
    }
    $verificar->close();

    // Insertar en Usuarios
    $sqlUsuario = "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, campus, idioma, pass, id_tipo_usuario, fecha_registro, avatar)
                   VALUES (?, ?, ?, ?, 'es', ?, 3, NOW(), ?)";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("ssssss", $nombres, $apellido_paterno, $apellido_materno, $campus, $pass, $nombreAvatarFinal);

    if ($stmtUsuario->execute()) {
        $id_usuario = $conn->insert_id;
        $stmtUsuario->close();

        // Insertar en Alumnos
        $sqlAlumno = "INSERT INTO alumnos (id_usuario, nocontrol, semestre) VALUES (?, ?, ?)";
        $stmtAlumno = $conn->prepare($sqlAlumno);
        $stmtAlumno->bind_param("iss", $id_usuario, $nocontrol, $semestre);

        if ($stmtAlumno->execute()) {
            $stmtAlumno->close();
            $conn->close();
            header("Location: ../../../register.php?toast_msg=" . urlencode("Registro exitoso."));
            exit;
        } else {
            $error = "Error al registrar en Alumnos: " . $stmtAlumno->error;
            $stmtAlumno->close();
            $conn->close();
            header("Location: ../../../register.php?toast_msg=" . urlencode($error));
            exit;
        }
    } else {
        $error = "Error al registrar en Usuarios: " . $stmtUsuario->error;
        $stmtUsuario->close();
        $conn->close();
        header("Location: ../../../register.php?toast_msg=" . urlencode($error));
        exit;
    }
} else {
    header("Location: ../../../register.php?toast_msg=" . urlencode("Método no permitido."));
    exit;
}

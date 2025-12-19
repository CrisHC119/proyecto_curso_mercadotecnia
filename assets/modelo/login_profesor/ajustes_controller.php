<?php
    // ajustes_controller.php
    session_start();
    include_once __DIR__ . '/../conexion.php';

    if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }

    $id_profesor = $_SESSION['id_usuario'];

    $nombres = $_POST['nombreProfesor'] ?? '';
    $apaterno = $_POST['apaternoProfesor'] ?? '';
    $amaterno = $_POST['amaternoProfesor'] ?? '';
    $campus = $_POST['campusProfesor'] ?? '';
    $antigua_pass = $_POST['antiguaContrasena'] ?? '';
    $nueva_pass = $_POST['nuevaContrasena'] ?? '';
    $confirmar_pass = $_POST['confirmarContrasena'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    if (empty($captcha) || !isset($_SESSION['captcha_answer']) || intval($captcha) !== $_SESSION['captcha_answer']) {
        $_SESSION['error_ajustes'] = "La respuesta de la verificación es incorrecta.";
        unset($_SESSION['captcha_answer']);
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }
    unset($_SESSION['captcha_answer']);

    if (empty($antigua_pass)) {
        $_SESSION['error_ajustes'] = "Debes proporcionar tu contraseña actual para guardar los cambios.";
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_profesor);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }

    $usuario = $resultado->fetch_assoc();
    $hash_bd = $usuario['pass'];
    $stmt->close();

    if (!password_verify($antigua_pass, $hash_bd)) {
        $_SESSION['error_ajustes'] = "La contraseña actual es incorrecta.";
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }

    $sql_update = "UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, campus = ?";
    $params = [$nombres, $apaterno, $amaterno, $campus];
    $types = "ssss"; 
    $actualizar_pass = false;

    if (!empty($nueva_pass)) {
        
        if ($nueva_pass !== $confirmar_pass) {
            $_SESSION['error_ajustes'] = "La nueva contraseña y su confirmación no coinciden.";
            header("Location: ../../code_profesor/menu_ajustes.php");
            exit;
        }

        if (strlen($nueva_pass) < 8) {
            $_SESSION['error_ajustes'] = "La nueva contraseña debe tener al menos 8 caracteres.";
            header("Location: ../../code_profesor/menu_ajustes.php");
            exit;
        }

        $nuevo_hash = password_hash($nueva_pass, PASSWORD_DEFAULT);
        $sql_update .= ", pass = ?";
        $params[] = $nuevo_hash;
        $types .= "s";
        $actualizar_pass = true;
    }

    $sql_update .= " WHERE id_usuario = ?";
    $params[] = $id_profesor;
    $types .= "i";

    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        if ($actualizar_pass) {
            $_SESSION['success_ajustes'] = "Datos y contraseña actualizados correctamente.";
        } else {
            $_SESSION['success_ajustes'] = "Datos actualizados correctamente.";
        }
    } else {
        $_SESSION['error_ajustes'] = "Error al actualizar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ../../code_profesor/menu_ajustes.php");
    exit;
?>
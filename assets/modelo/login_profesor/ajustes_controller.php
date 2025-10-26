<?php
    session_start();
    include_once __DIR__ . '/../conexion.php';

    // 1. Validaciones iniciales
    if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }

    $id_profesor = $_SESSION['id_usuario'];

    // 2. Recolección de datos
    $nombres = $_POST['nombreProfesor'] ?? '';
    $apaterno = $_POST['apaternoProfesor'] ?? '';
    $amaterno = $_POST['amaternoProfesor'] ?? '';
    $campus = $_POST['campusProfesor'] ?? '';
    $antigua_pass = $_POST['antiguaContrasena'] ?? ''; // Ahora es obligatorio
    $nueva_pass = $_POST['nuevaContrasena'] ?? '';     // Sigue siendo opcional
    $confirmar_pass = $_POST['confirmarContrasena'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    // 3. Validación de Captcha
    if (empty($captcha) || !isset($_SESSION['captcha_answer']) || intval($captcha) !== $_SESSION['captcha_answer']) {
        $_SESSION['error_ajustes'] = "La respuesta de la verificación es incorrecta.";
        unset($_SESSION['captcha_answer']);
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }
    unset($_SESSION['captcha_answer']);

    // 4. CAMBIO: Validación de Contraseña Actual (Ahora es obligatoria)
    if (empty($antigua_pass)) {
        $_SESSION['error_ajustes'] = "Debes proporcionar tu contraseña actual para guardar los cambios.";
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }

    // 5. CAMBIO: Verificar la contraseña actual ANTES de hacer cualquier otra cosa
    $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_profesor);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        // Esto no debería pasar si la sesión está activa, pero es buena seguridad
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

    // --- Si llegamos aquí, la contraseña actual y el captcha son correctos ---

    // 6. Preparar la actualización de datos
    $sql_update = "UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, campus = ?";
    $params = [$nombres, $apaterno, $amaterno, $campus];
    $types = "ssss"; 
    $actualizar_pass = false;

    // 7. CAMBIO: Lógica de actualización de contraseña (simplificada)
    // El cambio de contraseña sigue siendo opcional
    if (!empty($nueva_pass)) {
        
        // Ya no necesitamos verificar si la antigua_pass está vacía o si es correcta,
        // porque ya lo hicimos arriba.

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

        // Si todo es correcto, añadimos la nueva pass al query
        $nuevo_hash = password_hash($nueva_pass, PASSWORD_DEFAULT);
        $sql_update .= ", pass = ?";
        $params[] = $nuevo_hash;
        $types .= "s";
        $actualizar_pass = true;
    }

    // 8. Ejecutar la actualización final
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
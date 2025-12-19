<?php
    // reiniciar_ciclo_controller.php
    
    // Tablas modificadas:
    // 1. actividad_entregado (Se vacía)
    // 2. alumnos_actividad (Se vacía)
    // 3. alumnos_calificacion (Se vacía)
    // 4. alumnos (Se vacía - Información de semestre, horas, no. control)
    // 5. usuarios (Se eliminan SOLO los alumnos, id_tipo_usuario = 3)

    session_start();
    require_once '../conexion.php'; 

    // 1. Verificación de sesión y método POST
    if (!isset($_SESSION['id_usuario']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../../../index.php");
        exit;
    }

    $palabra_clave = $_POST['palabra_clave'] ?? '';
    $password = $_POST['password_confirmacion'] ?? '';
    $id_usuario = $_SESSION['id_usuario'];

    // 2. Verificar palabra clave de seguridad
    if ($palabra_clave !== 'ELIMINARTODO') {
        $_SESSION['error_ajustes'] = "La palabra clave es incorrecta.";
        header("Location: ../../login_profesor/ajustes.php");
        exit;
    }

    // 3. Verificar contraseña del profesor actual
    $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
        if (!password_verify($password, $data['pass'])) {
            $_SESSION['error_ajustes'] = "Contraseña incorrecta. Operación cancelada.";
            header("Location: ../../login_profesor/ajustes.php");
            exit;
        }
    } else {
        $_SESSION['error_ajustes'] = "Usuario no encontrado.";
        header("Location: ../../login_profesor/ajustes.php");
        exit;
    }
    $stmt->close();

    $errores_proceso = [];
    $rutaBase = dirname(__DIR__, 2); 

    // INICIO DE TRANSACCIÓN
    $conn->begin_transaction();

    try {
        // ---------------------------------------------------------
        // FASE 1: LIMPIEZA DE ACTIVIDADES Y CALIFICACIONES
        // ---------------------------------------------------------

        // 4. Borrar entregas de archivos en BD
        if (!$conn->query("DELETE FROM actividad_entregado")) {
            throw new Exception("Error al vaciar 'actividad_entregado': " . $conn->error);
        }

        // 5. Borrar archivos físicos
        $carpetas_actividades = [
            $rutaBase . '/code_alumnos/actividades/unidad_1',
            $rutaBase . '/code_alumnos/actividades/unidad_2',
            $rutaBase . '/code_alumnos/actividades/unidad_3',
            $rutaBase . '/code_alumnos/actividades/unidad_4',
            $rutaBase . '/code_alumnos/actividades/unidad_5'
        ];

        foreach ($carpetas_actividades as $carpeta) {
            if (is_dir($carpeta)) {
                $archivos = glob($carpeta . '/*'); 
                foreach ($archivos as $archivo) {
                    if (is_file($archivo)) {
                        @unlink($archivo); 
                    }
                }
            }
        }

        // 6. Borrar relación alumnos-actividad
        if (!$conn->query("DELETE FROM alumnos_actividad")) {
            throw new Exception("Error al vaciar 'alumnos_actividad': " . $conn->error);
        }

        // 7. Borrar calificaciones (examenes y parciales)
        if (!$conn->query("DELETE FROM alumnos_calificacion")) {
            throw new Exception("Error al vaciar 'alumnos_calificacion': " . $conn->error);
        }

        // ---------------------------------------------------------
        // FASE 2: INFORMACIÓN ACADÉMICA (NUEVO)
        // ---------------------------------------------------------

        // 8. Borrar información académica de la tabla 'alumnos'
        // Esto elimina semestre, horas, numero de control, etc.
        if (!$conn->query("DELETE FROM alumnos")) {
            throw new Exception("Error al vaciar la tabla 'alumnos': " . $conn->error);
        }

        // ---------------------------------------------------------
        // FASE 3: ELIMINACIÓN DE USUARIOS Y SUS AVATARES
        // ---------------------------------------------------------

        // 9. Borrar AVATARES físicos
        $rutaAvatars = $rutaBase . '/assets/images/avatar';
        
        $sql_avatars = "SELECT avatar FROM usuarios WHERE id_tipo_usuario = 3 AND avatar IS NOT NULL AND avatar != ''";
        $result_avatars = $conn->query($sql_avatars);

        if ($result_avatars) {
            while ($row = $result_avatars->fetch_assoc()) {
                $archivo_avatar = $rutaAvatars . '/' . $row['avatar'];
                if (file_exists($archivo_avatar)) {
                    @unlink($archivo_avatar);
                }
            }
        }

        // 10. Borrar usuarios alumnos de la BD (id_tipo_usuario = 3)
        if (!$conn->query("DELETE FROM usuarios WHERE id_tipo_usuario = 3")) {
            throw new Exception("Error al eliminar alumnos de 'usuarios': " . $conn->error);
        }

        $conn->commit();

    } catch (Exception $e) {
        $conn->rollback();
        $errores_proceso[] = $e->getMessage();
    }

    if (!empty($errores_proceso)) {
        $_SESSION['error_ajustes'] = "Error durante el reinicio: " . implode(" | ", $errores_proceso);
    } else {
        $_SESSION['success_ajustes'] = "Ciclo reiniciado. Se eliminó toda la información de alumnos, calificaciones y archivos.";
    }

    header("Location: ../../login_profesor/ajustes.php");
    exit;
?>
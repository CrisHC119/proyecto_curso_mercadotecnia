<?php
    // timer_controller.php
    session_start();

    if (!isset($_SESSION['id_usuario']) || !in_array($_SESSION['id_tipo_usuario'], [1, 2])) {
        http_response_code(403);
        echo "Acceso denegado.";
        exit;
    }

    include_once __DIR__ . '/../conexion.php'; 

    $redirect_page = '../../code_profesor/menu_ajustes.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $timer_alumno_min = $_POST['timer_alumno'] ?? null;
        $timer_profesor_min = $_POST['timer_profesor'] ?? null;

        if (!is_numeric($timer_alumno_min) || $timer_alumno_min <= 0 ||
            !is_numeric($timer_profesor_min) || $timer_profesor_min <= 0) {
            
            $_SESSION['error_ajustes'] = 'Error: Los tiempos de inactividad deben ser números positivos.';
            header("Location: $redirect_page");
            exit;
        }

        $timer_alumno_ms = (int)$timer_alumno_min * 60000;
        $timer_profesor_ms = (int)$timer_profesor_min * 60000;

        $stmt = $conn->prepare("UPDATE timer_login SET timer_profesor = ?, timer_alumno = ? WHERE id = 1");
        
        if (!$stmt) {
            $_SESSION['error_ajustes'] = 'Error al preparar la consulta: ' . $conn->error;
            header("Location: $redirect_page");
            exit;
        }

        $stmt->bind_param("ii", $timer_profesor_ms, $timer_alumno_ms);
        
        if ($stmt->execute()) {
            $_SESSION['success_ajustes'] = 'Tiempos de inactividad actualizados correctamente.';
        } else {
            $_SESSION['error_ajustes'] = 'Error al actualizar los tiempos: ' . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();

    } else {
        $_SESSION['error_ajustes'] = 'Método no permitido.';
    }

    header("Location: $redirect_page");
    exit;
?>
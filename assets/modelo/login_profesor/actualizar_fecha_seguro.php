<?php
    session_start();
    require_once '../conexion.php';

    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit;
    }

    $id_profesor = $_SESSION['id_usuario'] ?? null;
    if (!$id_profesor) {
        echo json_encode(['success' => false, 'message' => 'Sesión no válida. Inicie sesión de nuevo.']);
        exit;
    }

    $id_examen = $_POST['id_examen'];
    $fecha = $_POST['fecha_disponible'];
    $accion = $_POST['accion'];
    $password_ingresada = $_POST['password'];

    if (empty($id_examen) || empty($accion) || empty($password_ingresada)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
        exit;
    }

    $stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmtPass->bind_param("i", $id_profesor);
    $stmtPass->execute();
    $resultPass = $stmtPass->get_result();

    if ($resultPass->num_rows === 1) {
        $profesor = $resultPass->fetch_assoc();
        if (!password_verify($password_ingresada, $profesor['pass'])) {
            echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo verificar al usuario.']);
        exit;
    }

    $stmtUpdate = null;
    if ($accion === 'guardar') {
        if (empty($fecha)) {
            echo json_encode(['success' => false, 'message' => 'La fecha no puede estar vacía para guardar.']);
            exit;
        }
        $stmtUpdate = $conn->prepare("UPDATE examen_unidad SET fecha_disponible = ? WHERE id_examen = ?");
        $stmtUpdate->bind_param("si", $fecha, $id_examen);

    } elseif ($accion === 'reiniciar') {
        $stmtUpdate = $conn->prepare("UPDATE examen_unidad SET fecha_disponible = NULL WHERE id_examen = ?");
        $stmtUpdate->bind_param("i", $id_examen);
    }

    if ($stmtUpdate && $stmtUpdate->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
    }

    $stmtPass->close();
    if ($stmtUpdate) $stmtUpdate->close();
    $conn->close();
?>
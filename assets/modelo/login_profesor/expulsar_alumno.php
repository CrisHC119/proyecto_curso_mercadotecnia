<?php
    // eliminar_usuario.php
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

    $id_usuario_expulsar = $_POST['id_usuario_expulsar'] ?? null;
    $password_profesor = $_POST['password'] ?? null;

    if (empty($id_usuario_expulsar) || empty($password_profesor)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos.']);
        exit;
    }

    $stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmtPass->bind_param("i", $id_profesor);
    $stmtPass->execute();
    $resultPass = $stmtPass->get_result();

    if ($resultPass->num_rows === 1) {
        $profesor = $resultPass->fetch_assoc();
        if (!password_verify($password_profesor, $profesor['pass'])) {
            echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo verificar su identidad.']);
        exit;
    }

    $conn->begin_transaction();

    try {
        $stmtDeleteAlumnos = $conn->prepare("DELETE FROM alumnos WHERE id_usuario = ?");
        $stmtDeleteAlumnos->bind_param("i", $id_usuario_expulsar);
        $stmtDeleteAlumnos->execute();

        $stmtDeleteUsuarios = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmtDeleteUsuarios->bind_param("i", $id_usuario_expulsar);
        $stmtDeleteUsuarios->execute();
        
        $conn->commit();
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error durante la expulsión. No se realizaron cambios.']);
    }

    $stmtPass->close();
    if (isset($stmtDeleteAlumnos)) $stmtDeleteAlumnos->close();
    if (isset($stmtDeleteUsuarios)) $stmtDeleteUsuarios->close();
    $conn->close();
?>
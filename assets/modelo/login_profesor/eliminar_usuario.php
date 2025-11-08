<?php
    session_start();
    require_once '../conexion.php'; 

    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => 'Un error desconocido ocurrió.'];

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Método no permitido.');
        }

        $id_admin_actual = $_SESSION['id_usuario'] ?? null;
        $tipo_usuario_actual = $_SESSION['id_tipo_usuario'] ?? null;

        if (!$id_admin_actual || $tipo_usuario_actual != 1) { 
            throw new Exception('Acceso no autorizado. Solo los administradores pueden eliminar usuarios.');
        }

        $id_usuario_eliminar = $_POST['id_usuario_eliminar'] ?? null;
        $password_admin_actual = $_POST['admin_password'] ?? null;

        if (empty($id_usuario_eliminar) || empty($password_admin_actual)) {
            throw new Exception('Faltan datos requeridos (ID de usuario a eliminar o contraseña de admin).');
        }

        if ($id_usuario_eliminar == $id_admin_actual) {
            throw new Exception('No puede eliminarse a sí mismo.');
        }

        $stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
        if (!$stmtPass) throw new Exception('Error preparando consulta de contraseña: '.$conn->error);
        $stmtPass->bind_param("i", $id_admin_actual);
        $stmtPass->execute();
        $resultPass = $stmtPass->get_result();
        $admin = $resultPass->fetch_assoc();
        $stmtPass->close();

        if (!$admin || !password_verify($password_admin_actual, $admin['pass'])) {
            throw new Exception('La contraseña de autorización es incorrecta.');
        }

        $conn->begin_transaction();

        $stmtTipo = $conn->prepare("SELECT id_tipo_usuario FROM usuarios WHERE id_usuario = ?");
        if (!$stmtTipo) throw new Exception('Error preparando consulta de tipo: '.$conn->error);
        $stmtTipo->bind_param("i", $id_usuario_eliminar);
        $stmtTipo->execute();
        $resultTipo = $stmtTipo->get_result();
        $usuario_a_eliminar = $resultTipo->fetch_assoc();
        $stmtTipo->close();

        if (!$usuario_a_eliminar) {
            throw new Exception('El usuario a eliminar no existe.');
        }
        $tipo_usuario_a_eliminar = $usuario_a_eliminar['id_tipo_usuario'];

        if ($tipo_usuario_a_eliminar == 2) { 
            $stmtDeleteProfesor = $conn->prepare("DELETE FROM profesores WHERE id_usuario = ?");
            if (!$stmtDeleteProfesor) throw new Exception('Error preparando delete (profesores): '.$conn->error);
            $stmtDeleteProfesor->bind_param("i", $id_usuario_eliminar);
            if (!$stmtDeleteProfesor->execute()) {
                throw new Exception('Error al eliminar de profesores: '.$stmtDeleteProfesor->error);
            }
            $stmtDeleteProfesor->close();
        }

        $stmtDeleteUsuario = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        if (!$stmtDeleteUsuario) throw new Exception('Error preparando delete (usuarios): '.$conn->error);
        $stmtDeleteUsuario->bind_param("i", $id_usuario_eliminar);
        if (!$stmtDeleteUsuario->execute()) {
            throw new Exception('Error al eliminar de usuarios: '.$stmtDeleteUsuario->error);
        }
        $stmtDeleteUsuario->close();

        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Usuario eliminado correctamente.';

    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = $e->getMessage();
    }

    if ($conn) $conn->close();
    echo json_encode($response);
?>
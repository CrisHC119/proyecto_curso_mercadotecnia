<?php
    session_start();
    include_once '../conexion.php';

    header('Content-Type: application/json');

    if (!isset($_SESSION['id_tipo_usuario']) || $_SESSION['id_tipo_usuario'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Acción no autorizada.']);
        exit;
    }

    $id_usuario_target = $_POST['id_usuario'] ?? 0;
    $nuevo_rol = $_POST['nuevo_rol'] ?? 0;
    $admin_password = $_POST['admin_password'] ?? '';
    $admin_id = $_SESSION['id_usuario'];

    if (empty($id_usuario_target) || !in_array($nuevo_rol, [1, 2]) || empty($admin_password)) {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
        exit;
    }

    if ($id_usuario_target == $admin_id) {
        echo json_encode(['success' => false, 'message' => 'No puedes cambiar tu propio rol.']);
        exit;
    }

    $stmt_admin = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmt_admin->bind_param("i", $admin_id);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Error al verificar al administrador.']);
        exit;
    }

    $admin_data = $result_admin->fetch_assoc();
    if (!password_verify($admin_password, $admin_data['pass'])) { 
        echo json_encode(['success' => false, 'message' => 'Su contraseña de administrador es incorrecta.']);
        exit;
    }

    $stmt_update = $conn->prepare("UPDATE usuarios SET id_tipo_usuario = ? WHERE id_usuario = ?");
    $stmt_update->bind_param("ii", $nuevo_rol, $id_usuario_target);

    if ($stmt_update->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
    }

    $stmt_admin->close();
    $stmt_update->close();
    $conn->close();
?>


<?php
    // agregar_personal.php
    session_start();
    require_once __DIR__ . '/../conexion.php';
    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => 'Un error desconocido ocurrió.'];

    $nombres = $_POST['nombres'] ?? null;
    $apellido_p = $_POST['apellido_paterno'] ?? null;
    $apellido_m = $_POST['apellido_materno'] ?? null;
    $password_prov = $_POST['password_provisional'] ?? null;
    $campus = $_POST['campus'] ?? null;
    $id_tipo_usuario = $_POST['id_tipo_usuario'] ?? null;
    $matricula_personal = $_POST['matricula_personal'] ?? null;
    $password_admin_actual = $_POST['admin_password'] ?? '';

    if (empty($nombres) || empty($apellido_p) || empty($password_prov) || empty($campus) || empty($id_tipo_usuario) || empty($matricula_personal) || empty($password_admin_actual)) {
        $response['message'] = 'Todos los campos son obligatorios.';
        echo json_encode($response);
        exit;
    }

    $conn->begin_transaction();

    try {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['id_tipo_usuario'] != 1) {
            throw new Exception('Acceso no autorizado. Inicie sesión como administrador.');
        }
        $id_admin_actual = $_SESSION['id_usuario'];

        $stmt_admin = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
        $stmt_admin->bind_param("i", $id_admin_actual);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();
        $admin = $result_admin->fetch_assoc();
        $stmt_admin->close();

        if (!$admin || !password_verify($password_admin_actual, $admin['pass'])) {
            throw new Exception('Su contraseña de autorización es incorrecta.');
        }

        $stmt_check_prof = $conn->prepare("SELECT id_usuario FROM profesores WHERE matricula = ?");
        $stmt_check_prof->bind_param("s", $matricula_personal);
        $stmt_check_prof->execute();
        if ($stmt_check_prof->get_result()->num_rows > 0) {
            throw new Exception('Error: La matrícula ya existe (como profesor).');
        }
        $stmt_check_prof->close();
        
        $stmt_check_alu = $conn->prepare("SELECT id_usuario FROM alumnos WHERE nocontrol = ?");
        $stmt_check_alu->bind_param("s", $matricula_personal);
        $stmt_check_alu->execute();
        if ($stmt_check_alu->get_result()->num_rows > 0) {
            throw new Exception('Error: La matrícula ya existe (como alumno).');
        }
        $stmt_check_alu->close();

        $password_nuevo_usuario = password_hash($password_prov, PASSWORD_DEFAULT);

        $stmt_insert_usr = $conn->prepare(
            "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, pass, campus, id_tipo_usuario, avatar, idioma, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, 'avatar_default.jpg', 'es', NOW())"
        );
        $stmt_insert_usr->bind_param(
            "sssssi",
            $nombres,
            $apellido_p,
            $apellido_m,
            $password_nuevo_usuario,
            $campus,
            $id_tipo_usuario
        );
        
        if (!$stmt_insert_usr->execute()) {
            throw new Exception('Error al crear el usuario: ' . $stmt_insert_usr->error);
        }

        $id_nuevo_usuario = $conn->insert_id;
        $stmt_insert_usr->close();

        if ($id_tipo_usuario == 2) { 
            $stmt_insert_prof = $conn->prepare("INSERT INTO profesores (id_usuario, matricula) VALUES (?, ?)");
            $stmt_insert_prof->bind_param("is", $id_nuevo_usuario, $matricula_personal); 
            
            if (!$stmt_insert_prof->execute()) {
                throw new Exception('Error al crear el registro de profesor: ' . $stmt_insert_prof->error);
            }
            $stmt_insert_prof->close();
        }
        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Usuario agregado correctamente.';

    } catch (Exception $e) {
        $conn->rollback();
        $response['message'] = $e->getMessage();
    }

    $conn->close();
    echo json_encode($response);
?>
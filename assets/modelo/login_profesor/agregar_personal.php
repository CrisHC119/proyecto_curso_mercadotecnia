<?php
session_start();
require_once __DIR__ . '/../conexion.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Un error desconocido ocurrió.'];

// Asignar variables POST (sin correo)
$nombres = $_POST['nombres'] ?? null;
$apellido_p = $_POST['apellido_paterno'] ?? null;
$apellido_m = $_POST['apellido_materno'] ?? null;
$password_prov = $_POST['password_provisional'] ?? null;
$campus = $_POST['campus'] ?? null;
$id_tipo_usuario = $_POST['id_tipo_usuario'] ?? null;
$matricula_personal = $_POST['matricula_personal'] ?? null; // El nuevo campo
$password_admin_actual = $_POST['admin_password'] ?? '';

// Validar que los campos no estén vacíos
if (empty($nombres) || empty($apellido_p) || empty($password_prov) || empty($campus) || empty($id_tipo_usuario) || empty($matricula_personal) || empty($password_admin_actual)) {
    $response['message'] = 'Todos los campos son obligatorios.';
    echo json_encode($response);
    exit;
}

// Iniciar transacción
$conn->begin_transaction();

try {
    // 1. Verificar la sesión del administrador
    if (!isset($_SESSION['id_usuario']) || $_SESSION['id_tipo_usuario'] != 1) {
        throw new Exception('Acceso no autorizado. Inicie sesión como administrador.');
    }
    $id_admin_actual = $_SESSION['id_usuario'];

    // 2. Verificar la contraseña del administrador (usando 'pass')
    $stmt_admin = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    $stmt_admin->bind_param("i", $id_admin_actual);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();
    $admin = $result_admin->fetch_assoc();
    $stmt_admin->close();

    if (!$admin || !password_verify($password_admin_actual, $admin['pass'])) {
        throw new Exception('Su contraseña de autorización es incorrecta.');
    }

    // 3. Verificar duplicados de Matrícula (en profesores y alumnos)
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

    // 4. Hashear la nueva contraseña
    $password_nuevo_usuario = password_hash($password_prov, PASSWORD_DEFAULT);

    // 5. Preparar la inserción en 'usuarios' (sin 'correo', usando 'pass')
    $stmt_insert_usr = $conn->prepare(
        "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, pass, campus, id_tipo_usuario, avatar, idioma, fecha_registro) 
         VALUES (?, ?, ?, ?, ?, ?, 'avatar_default.jpg', 'es', NOW())"
    );
    // La firma bind_param es: sss (nombres) s (pass) s (campus) i (tipo_usuario)
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

    // 6. Obtener el ID del usuario recién creado
    $id_nuevo_usuario = $conn->insert_id;
    $stmt_insert_usr->close();

    // 7. Insertar en la tabla 'profesores' si es Profesor
// 7. Insertar en la tabla 'profesores' si es Profesor
    if ($id_tipo_usuario == 2) { 
        $stmt_insert_prof = $conn->prepare("INSERT INTO profesores (id_usuario, matricula) VALUES (?, ?)");
        // El string "is" significa: i=integer (para id_usuario), s=string (para matricula)
        $stmt_insert_prof->bind_param("is", $id_nuevo_usuario, $matricula_personal); 
        
        if (!$stmt_insert_prof->execute()) {
            throw new Exception('Error al crear el registro de profesor: ' . $stmt_insert_prof->error);
        }
        $stmt_insert_prof->close();
    }
    // Si es tipo 1 (Admin), no necesita registro en 'profesores' (según tu lógica)

    // 8. Si todo salió bien, confirmar la transacción
    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Usuario agregado correctamente.';

} catch (Exception $e) {
    // Si algo falló, revertir la transacción
    $conn->rollback();
    $response['message'] = $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>
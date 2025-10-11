<?php
session_start();
require_once __DIR__ . '/../conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario']) || $_SESSION['id_tipo_usuario'] != 1) { 
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}

$id_admin_actual = $_SESSION['id_usuario'];
$password_admin_actual = $_POST['admin_password'];

$stmt = $conn->prepare("SELECT password FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id_admin_actual);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if (!$admin || !password_verify($password_admin_actual, $admin['password'])) {
    echo json_encode(['success' => false, 'message' => 'Su contraseña de autorización es incorrecta.']);
    exit;
}

$password_nuevo_usuario = password_hash($_POST['password_provisional'], PASSWORD_DEFAULT);

$stmt_insert = $conn->prepare(
    "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, correo, password, campus, id_tipo_usuario, avatar) 
     VALUES (?, ?, ?, ?, ?, ?, ?, 'default.png')" 
);
$stmt_insert->bind_param(
    "ssssssi", 
    $_POST['nombres'],
    $_POST['apellido_paterno'],
    $_POST['apellido_materno'],
    $_POST['correo'],
    $password_nuevo_usuario,
    $_POST['campus'],
    $_POST['id_tipo_usuario']
);

if ($stmt_insert->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al crear el usuario en la base de datos.']);
}

$stmt->close();
$stmt_insert->close();
$conn->close();
?>
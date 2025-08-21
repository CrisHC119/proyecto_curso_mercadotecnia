<?php
session_start();
include_once '../conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$passwordIngresado = $data['password'] ?? '';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["success" => false, "message" => "Sesión no válida."]);
    exit;
}

$idUsuario = $_SESSION['id_usuario'];

$stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ? LIMIT 1");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($passwordIngresado, $row['pass'])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Contraseña incorrecta."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Usuario no encontrado."]);
}

$stmt->close();
$conn->close();
?>

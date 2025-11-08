<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();
    require_once '../conexion.php';

    header('Content-Type: application/json'); 

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(["success" => false, "message" => "Método no permitido."]);
        exit;
    }

    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        echo json_encode(["success" => false, "message" => "No se ha identificado al usuario. Por favor, inicie sesión de nuevo."]);
        exit;
    }

    $password_ingresada = $_POST['password'] ?? null;
    if (empty($password_ingresada)) {
        echo json_encode(["success" => false, "message" => "Por favor, ingrese su contraseña."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ? LIMIT 1");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();
        $hash_guardado = $row['pass'];

        if (password_verify($password_ingresada, $hash_guardado)) {
            echo json_encode(["success" => true, "message" => "Contraseña verificada correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "La contraseña es incorrecta."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "No se pudo encontrar al usuario."]);
    }

    $stmt->close();
    $conn->close();
?>
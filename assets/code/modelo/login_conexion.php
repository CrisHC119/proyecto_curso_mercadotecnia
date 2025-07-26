<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('session.cookie_lifetime', 0); // La cookie expira al cerrar el navegador

session_start();
include_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificador = $_POST['nocontrol'] ?? '';
    $password = $_POST['pass'] ?? '';

    if (empty($identificador) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Campos vacíos."]);
        exit;
    }

    // Intentar login como alumno
    $stmt = $conn->prepare("
        SELECT 
            u.id_usuario, u.nombres, u.apellido_paterno, u.apellido_materno, u.campus,
            u.pass, u.idioma, u.id_tipo_usuario, u.fecha_registro, u.avatar,
            a.nocontrol, a.semestre
        FROM alumnos a
        INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
        WHERE a.nocontrol = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $identificador);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();

        if (password_verify($password, $row['pass'])) {
            session_regenerate_id(true);

            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombres'];
            $_SESSION['apellido_p'] = $row['apellido_paterno'];
            $_SESSION['apellido_m'] = $row['apellido_materno'];
            $_SESSION['nocontrol'] = $row['nocontrol'];
            $_SESSION['campus'] = $row['campus'];
            $_SESSION['idioma'] = $row['idioma'];
            $_SESSION['semestre'] = $row['semestre'];
            $_SESSION['id_tipo_usuario'] = $row['id_tipo_usuario'];
            $_SESSION['fecha_registro'] = $row['fecha_registro'];
            $_SESSION['avatar'] = !empty($row['avatar']) ? $row['avatar'] : 'avatar_default.jpg';

            echo json_encode(["success" => true, "tipo" => "alumno"]);
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Número de control o contraseña incorrectos."]);
            exit;
        }
    }
    $stmt->close();

    // Si no es alumno, intentar login como profesor
    $stmt = $conn->prepare("
        SELECT 
            u.id_usuario, u.nombres, u.apellido_paterno, u.apellido_materno, u.campus,
            u.pass, u.idioma, u.id_tipo_usuario, u.fecha_registro, u.avatar,
            p.matricula
        FROM profesores p
        INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE p.matricula = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $identificador);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();

        if (password_verify($password, $row['pass'])) {
            session_regenerate_id(true);

            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombres'];
            $_SESSION['apellido_p'] = $row['apellido_paterno'];
            $_SESSION['apellido_m'] = $row['apellido_materno'];
            $_SESSION['matricula'] = $row['matricula'];
            $_SESSION['idioma'] = $row['idioma'];
            $_SESSION['campus'] = $row['campus'];
            $_SESSION['id_tipo_usuario'] = $row['id_tipo_usuario'];
            $_SESSION['fecha_registro'] = $row['fecha_registro'];
            $_SESSION['avatar'] = !empty($row['avatar']) ? $row['avatar'] : 'avatar_default.jpg';

            echo json_encode(["success" => true, "tipo" => "profesor"]);
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Matrícula o contraseña incorrectos."]);
            exit;
        }
    }

    echo json_encode(["success" => false, "message" => "Credenciales no válidas."]);
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>
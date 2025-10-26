<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('session.cookie_lifetime', 0); 

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
include $_SERVER['DOCUMENT_ROOT'] . '/assets/scripts/script_registrar_log.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nocontrol  = $_POST['nocontrol'] ?? null; 
    $matricula  = $_POST['matricula'] ?? null; 
    $password   = $_POST['password'] ?? '';

    if ((empty($nocontrol) && empty($matricula)) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Campos vacíos."]);
        exit;
    }

    if ($nocontrol) {
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
        $stmt->bind_param("s", $nocontrol);
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

                escribirLog("Inicio de sesión (Alumno): {$row['nombres']} {$row['apellido_paterno']} {$row['apellido_materno']} (Número de control: {$row['nocontrol']})");
                $sql_insert = "INSERT INTO log_acceso_alumnos (id_usuario, fecha_entrada) VALUES (?, NOW())";
                $stmt_log = $conn->prepare($sql_insert);
                if ($stmt_log) {
                    $stmt_log->bind_param("i", $_SESSION['id_usuario']); 
                    $stmt_log->execute();
                    
                    $stmt_log->close();
                }
                echo json_encode(["success" => true, "tipo" => "alumno"]);
                exit;
            } else {
                echo json_encode(["success" => false, "message" => "Número de control o contraseña incorrectos."]);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Número de control no encontrado."]);
            exit;
        }
        $stmt->close();
    }

    if ($matricula) {
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
        $stmt->bind_param("s", $matricula);
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

                escribirLog("Inicio de sesión (Profesor): {$row['nombres']} {$row['apellido_paterno']} {$row['apellido_materno']} (Matrícula: {$row['matricula']})");

                echo json_encode(["success" => true, "tipo" => "profesor"]);
                exit;
            } else {
                echo json_encode(["success" => false, "message" => "Matrícula o contraseña incorrectos."]);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Matrícula no encontrada."]);
            exit;
        }
        $stmt->close();
    }

    echo json_encode(["success" => false, "message" => "Credenciales no válidas."]);
    exit;

} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>

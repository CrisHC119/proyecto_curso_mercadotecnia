<?php
    // actulizar_fecha_seguro.php
    session_start();
    require_once '../conexion.php';

    header('Content-Type: application/json');
    date_default_timezone_set('America/Monterrey');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit;
    }

    $id_profesor = $_SESSION['id_usuario'] ?? null;
    if (!$id_profesor) {
        echo json_encode(['success' => false, 'message' => 'Sesión no válida. Inicie sesión de nuevo.']);
        exit;
    }

    $id_examen = $_POST['id_examen'] ?? null;
    $fecha_disponible_str = $_POST['fecha_disponible'] ?? null;
    $fecha_limite_str = $_POST['fecha_limite'] ?? null;
    $accion = $_POST['accion'] ?? null;
    $password_ingresada = $_POST['password'] ?? null;

    if (empty($id_examen) || empty($accion) || empty($password_ingresada)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos (examen, acción, contraseña).']);
        exit;
    }

    $stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    if (!$stmtPass) {  exit;}
    $stmtPass->bind_param("i", $id_profesor);
    if(!$stmtPass->execute()){ exit;}
    $resultPass = $stmtPass->get_result();
    if ($resultPass->num_rows === 1) {
        $profesor = $resultPass->fetch_assoc();
        if (!password_verify($password_ingresada, $profesor['pass'])) {
            echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta.']);
            $stmtPass->close(); $conn->close(); exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo verificar al usuario.']);
       $stmtPass->close(); $conn->close(); exit;
    }
    $stmtPass->close();

    $stmtUpdate = null;
    $params = [];
    $types = "";

    if ($accion === 'guardar') {
        if (empty($fecha_disponible_str) || empty($fecha_limite_str)) {
            echo json_encode(['success' => false, 'message' => 'Se requieren ambas fechas (inicio y fin) para guardar.']);
            $conn->close(); exit;
        }
        
        try {
            $fecha_disponible_dt = new DateTime($fecha_disponible_str);
            $fecha_limite_dt = new DateTime($fecha_limite_str);
            
            if ($fecha_limite_dt <= $fecha_disponible_dt) {
                 echo json_encode(['success' => false, 'message' => 'La fecha de finalización debe ser posterior a la fecha de inicio.']);
                 $conn->close(); exit;
            }
            
            $fecha_disponible_db = $fecha_disponible_dt->format('Y-m-d H:i:s');
            $fecha_limite_db = $fecha_limite_dt->format('Y-m-d H:i:s');

            $sql = "UPDATE examen_unidad SET fecha_disponible = ?, fecha_limite = ? WHERE id_examen = ?";
            $stmtUpdate = $conn->prepare($sql);
            $types = "ssi";
            $params = [$fecha_disponible_db, $fecha_limite_db, $id_examen];

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Formato de fecha inválido.']);
            $conn->close(); exit;
        }

    } elseif ($accion === 'reiniciar') {
        $sql = "UPDATE examen_unidad SET fecha_disponible = NULL, fecha_limite = NULL WHERE id_examen = ?";
        $stmtUpdate = $conn->prepare($sql);
        $types = "i";
        $params = [$id_examen];
    } else {
         echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
         $conn->close(); exit;
    }

    if ($stmtUpdate) {
        $stmtUpdate->bind_param($types, ...$params); 

        if ($stmtUpdate->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos. Intente de nuevo.']);
        }
        $stmtUpdate->close();
    } else {
         echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
    }
    $conn->close();
?>
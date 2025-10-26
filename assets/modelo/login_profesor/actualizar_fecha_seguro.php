<?php
    session_start();
    require_once '../conexion.php'; // Make sure path is correct

    header('Content-Type: application/json');
    date_default_timezone_set('America/Monterrey'); // Ensure timezone consistency

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
    $fecha_disponible_str = $_POST['fecha_disponible'] ?? null; // Start date string
    $fecha_limite_str = $_POST['fecha_limite'] ?? null;       // End date string
    $accion = $_POST['accion'] ?? null;
    $password_ingresada = $_POST['password'] ?? null;

    if (empty($id_examen) || empty($accion) || empty($password_ingresada)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos (examen, acción, contraseña).']);
        exit;
    }

    // --- Password Verification (Remains the same) ---
    $stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
    // ... (rest of password verification code) ...
    if (!$stmtPass) { /* Handle prepare error */ exit;}
    $stmtPass->bind_param("i", $id_profesor);
    if(!$stmtPass->execute()){/* Handle execute error */ exit;}
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
    // --- End Password Verification ---


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
            
            // Server-side validation: end date must be after start date
            if ($fecha_limite_dt <= $fecha_disponible_dt) {
                 echo json_encode(['success' => false, 'message' => 'La fecha de finalización debe ser posterior a la fecha de inicio.']);
                 $conn->close(); exit;
            }
            
            // Optional: Check if start date is in the past (allow if needed, maybe warn)
            // $ahora = new DateTime();
            // if ($fecha_disponible_dt < $ahora) {
            //     // Handle case where start date is in the past - maybe allow or return error/warning
            // }

            // Store dates as strings in DB format 'Y-m-d H:i:s'
            $fecha_disponible_db = $fecha_disponible_dt->format('Y-m-d H:i:s');
            $fecha_limite_db = $fecha_limite_dt->format('Y-m-d H:i:s');

            $sql = "UPDATE examen_unidad SET fecha_disponible = ?, fecha_limite = ? WHERE id_examen = ?";
            $stmtUpdate = $conn->prepare($sql);
            $types = "ssi"; // string, string, integer
            $params = [$fecha_disponible_db, $fecha_limite_db, $id_examen];

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Formato de fecha inválido.']);
            $conn->close(); exit;
        }

    } elseif ($accion === 'reiniciar') {
        // Set both dates to NULL
        $sql = "UPDATE examen_unidad SET fecha_disponible = NULL, fecha_limite = NULL WHERE id_examen = ?";
        $stmtUpdate = $conn->prepare($sql);
        $types = "i"; // integer
        $params = [$id_examen];
    } else {
         echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
         $conn->close(); exit;
    }

    // Execute the update
    if ($stmtUpdate) {
         // Dynamically bind parameters
        $stmtUpdate->bind_param($types, ...$params); 

        if ($stmtUpdate->execute()) {
            echo json_encode(['success' => true]);
        } else {
            // Log error: error_log("DB Update Error: " . $stmtUpdate->error);
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos. Intente de nuevo.']);
        }
        $stmtUpdate->close();
    } else {
         // Log error: error_log("DB Prepare Error: " . $conn->error);
         echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
    }

    $conn->close();
?>
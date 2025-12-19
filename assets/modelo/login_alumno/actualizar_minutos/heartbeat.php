<?php
    // heartbeat.php
    session_start();
    require __DIR__ . '/../../../conexion.php'; 
    header('Content-Type: application/json');
    if (!isset($conn) || $conn->connect_error) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error 500: Fallo crítico en la conexión MySQLi ($conn).']);
        exit;
    }
    if (!isset($_SESSION['nocontrol']) || empty($_SESSION['nocontrol']) || !isset($_POST['unidad'])) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Error 403: Sesión o datos de unidad no válidos.']);
        exit;
    }
    $no_control = $_SESSION['nocontrol'];
    $unidad = filter_var($_POST['unidad'], FILTER_SANITIZE_NUMBER_INT);
    $minuto_a_sumar = 1; 
    switch ($unidad) {
        case 0: $columna = 'horas_index'; break;
        case 1: case 2: case 3: case 4: case 5: $columna = 'horas_U' . $unidad; break;
        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Error 400: Índice de unidad fuera de rango.']);
            exit;
    }
    try {
        $sql = "UPDATE alumnos SET {$columna} = {$columna} + ? WHERE nocontrol = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $minuto_a_sumar, $no_control); 
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => "Éxito: Columna '{$columna}' actualizada (+1 min)."]);
            } else {
                echo json_encode(['success' => false, 'message' => "Falla: Alumno no encontrado o sin cambios."]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error de ejecución MySQLi: ' . $stmt->error]);
        }
        $stmt->close();
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error fatal en la lógica Heartbeat: ' . $e->getMessage()]);
    }
    $conn->close();
?>
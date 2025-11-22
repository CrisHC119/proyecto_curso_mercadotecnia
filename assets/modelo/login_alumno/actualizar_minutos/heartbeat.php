<?php
// =======================================================
// /assets/modelo/login_alumno/actualizar_minutos/heartbeat.php
// =======================================================

// 1. Omitimos la supresión de errores aquí temporalmente.
// Si deseas suprimir la salida de errores en scripts AJAX:
// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); 

// 2. Inicia la sesión y carga la conexión (provee $conn)
session_start();
// Asegúrate de que esta ruta relativa sea correcta
require __DIR__ . '/../../../conexion.php'; 

header('Content-Type: application/json');

// 3. Verifica la existencia de la conexión MySQLi
// Cambiamos $pdo por $conn
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    // Cambiamos el mensaje para reflejar la conexión MySQLi
    echo json_encode(['success' => false, 'message' => 'Error 500: Fallo crítico en la conexión MySQLi ($conn).']);
    exit;
}

// 4. Verificación de seguridad y datos POST (Sin cambios)
if (!isset($_SESSION['nocontrol']) || empty($_SESSION['nocontrol']) || !isset($_POST['unidad'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Error 403: Sesión o datos de unidad no válidos.']);
    exit;
}

$no_control = $_SESSION['nocontrol'];
$unidad = filter_var($_POST['unidad'], FILTER_SANITIZE_NUMBER_INT);
$minuto_a_sumar = 1; 

// 5. Determinar la columna a actualizar (Sin cambios)
switch ($unidad) {
    case 0: $columna = 'horas_index'; break;
    case 1: case 2: case 3: case 4: case 5: $columna = 'horas_U' . $unidad; break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Error 400: Índice de unidad fuera de rango.']);
        exit;
}

try {
    // 6. Preparar la sentencia SQL (USANDO MYSQLI)
    // Nota: El nombre de la columna {$columna} debe ser insertado directamente en la consulta 
    // antes de la preparación, ya que no se pueden usar placeholders para nombres de columnas.
    $sql = "UPDATE alumnos SET {$columna} = {$columna} + ? WHERE nocontrol = ?";

    $stmt = $conn->prepare($sql);
    
    // Vinculación de parámetros: 'i' para entero ($minuto_a_sumar), 's' para string ($no_control)
    // El $minuto_a_sumar es 1, que encaja en INT(11) o BIGINT(20)
    $stmt->bind_param('is', $minuto_a_sumar, $no_control); 

    // 7. Ejecutar y verificar
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => "Éxito: Columna '{$columna}' actualizada (+1 min)."]);
        } else {
            // No se modificó ninguna fila (posiblemente nocontrol no existe o ya estaba actualizado)
            echo json_encode(['success' => false, 'message' => "Falla: Alumno no encontrado o sin cambios."]);
        }
    } else {
        // Error de ejecución SQL
        echo json_encode(['success' => false, 'message' => 'Error de ejecución MySQLi: ' . $stmt->error]);
    }
    $stmt->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error fatal en la lógica Heartbeat: ' . $e->getMessage()]);
}

// Opcional: Cerrar la conexión si no se necesita más en este script
$conn->close();
?>
<?php
// Ruta: ../modelo/login_profesor/actualizar_fecha_actividad.php

session_start();
// Asegúrate que la ruta a tu conexión sea la correcta
require_once '../conexion.php'; 

header('Content-Type: application/json');
date_default_timezone_set('America/Monterrey');

// --- INICIO DE LA CORRECCIÓN DE AUTENTICACIÓN ---

// 1. Usamos la variable de sesión correcta: 'id_usuario'
$id_profesor = $_SESSION['id_usuario'] ?? null; 
if (!$id_profesor) {
    echo json_encode(['success' => false, 'message' => 'Sesión no válida. Inicie sesión de nuevo.']);
    exit;
}

// 2. Obtenemos los datos POST (la contraseña se llama 'password_ingresada' por claridad)
$id_actividad = $_POST['id_actividad'] ?? null;
$fecha_disponible_str = $_POST['fecha_disponible'] ?? null;
$fecha_limite_str = $_POST['fecha_limite'] ?? null;
$accion = $_POST['accion'] ?? null;
$password_ingresada = $_POST['password'] ?? null;

if (empty($id_actividad) || empty($accion) || empty($password_ingresada)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos (actividad, acción, contraseña).']);
    exit;
}

// 3. Verificación de contraseña (usando tu lógica)
// Usamos la tabla 'usuarios', columna 'pass' y el 'id_usuario'
$stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
if (!$stmtPass) { 
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta de usuario.']);
    exit;
}
$stmtPass->bind_param("i", $id_profesor);
if(!$stmtPass->execute()){
    echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta de usuario.']);
    exit;
}
$resultPass = $stmtPass->get_result();

if ($resultPass->num_rows === 1) {
    $profesor = $resultPass->fetch_assoc();
    // Verificamos la contraseña ingresada contra la columna 'pass'
    if (!password_verify($password_ingresada, $profesor['pass'])) { 
        echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta.']);
        $stmtPass->close(); $conn->close(); exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo verificar al usuario.']);
    $stmtPass->close(); $conn->close(); exit;
}
$stmtPass->close();
// --- FIN DE LA CORRECCIÓN DE AUTENTICACIÓN ---


// --- LÓGICA DE ACTUALIZACIÓN DE ACTIVIDAD (Esta parte ya era correcta) ---

// 4. Validar ID de Actividad
if ($id_actividad < 1 || $id_actividad > 5) {
    echo json_encode(['success' => false, 'message' => 'ID de actividad no válido.']);
    $conn->close(); exit;
}

// 5. Construir la consulta
$id_fila_fechas = 1; // Asumo que la fila a actualizar es siempre id_unidad = 1
$col_inicio = "act_{$id_actividad}_fecha_inicial";
$col_fin = "act_{$id_actividad}_fecha_final";

$sql_update = "";
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

        $sql_update = "UPDATE alumnos_actividad_fecha SET $col_inicio = ?, $col_fin = ? WHERE id_unidad = ?";
        $params = [$fecha_disponible_db, $fecha_limite_db, $id_fila_fechas];
        $types = "ssi"; // string, string, integer

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Formato de fecha inválido.']);
        $conn->close(); exit;
    }

} elseif ($accion === 'reiniciar') {
    $sql_update = "UPDATE alumnos_actividad_fecha SET $col_inicio = NULL, $col_fin = NULL WHERE id_unidad = ?";
    $params = [$id_fila_fechas];
    $types = "i"; // integer

} else {
    echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
    $conn->close(); exit;
}

// 6. Ejecutar la actualización
$stmt_update = $conn->prepare($sql_update);
if ($stmt_update) {
    $stmt_update->bind_param($types, ...$params); 

    if ($stmt_update->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
    }
    $stmt_update->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta de actualización.']);
}

$conn->close();
?>
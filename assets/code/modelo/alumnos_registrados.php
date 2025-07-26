<?php
include_once __DIR__ . '/conexion.php'; // Ajusta si tu ruta es diferente

// Obtener datos de alumnos registrados (unir Usuarios y Alumnos)
$sql = "SELECT U.id_usuario, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar, U.id_tipo_usuario, A.nocontrol, A.semestre
        FROM usuarios U
        INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
        ORDER BY U.nombres ASC";

$result = $conn->query($sql);

$alumnos = [];

if ($result && $result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $alumnos[] = $fila;
    }
}

// Devolver los datos como JSON (opcional, si deseas usarlo con JS)
header('Content-Type: application/json');
echo json_encode($alumnos);
?>

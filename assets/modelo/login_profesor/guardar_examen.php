<?php
// archivo: /assets/modelo/profesor/guardar_examen.php

session_start();
require_once '../conexion.php';

// 1. Seguridad: Verificar que el usuario sea profesor y que el método sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acceso denegado.");
}
if (!isset($_SESSION['id_usuario']) || ($_SESSION['id_tipo_usuario'] != 1 && $_SESSION['id_tipo_usuario'] != 2)) {
    die("No tienes permiso para realizar esta acción.");
}

// 2. Obtener los datos del formulario
$id_examen = $_POST['id_examen'];
$preguntas = $_POST['pregunta'];
$respuestas = $_POST['respuesta'];
$correctos = $_POST['correcto'];

// 3. Iniciar una transacción para asegurar la integridad de los datos
$conn->begin_transaction();

try {
    // 4. Actualizar el texto de cada pregunta
    $stmtPregunta = $conn->prepare("UPDATE examen_pregunta SET pregunta = ? WHERE id_pregunta = ?");
    foreach ($preguntas as $id_pregunta => $texto_pregunta) {
        $stmtPregunta->bind_param("si", $texto_pregunta, $id_pregunta);
        $stmtPregunta->execute();
    }
    $stmtPregunta->close();

    // 5. Actualizar el texto de cada respuesta
    $stmtRespuesta = $conn->prepare("UPDATE examen_respuesta SET respuesta = ? WHERE id_respuesta = ?");
    foreach ($respuestas as $id_respuesta => $texto_respuesta) {
        $stmtRespuesta->bind_param("si", $texto_respuesta, $id_respuesta);
        $stmtRespuesta->execute();
    }
    $stmtRespuesta->close();

    // 6. Actualizar cuál es la respuesta correcta para cada pregunta
    $stmtCorrectoReset = $conn->prepare("UPDATE examen_respuesta SET correcto = 0 WHERE id_pregunta = ?");
    $stmtCorrectoSet = $conn->prepare("UPDATE examen_respuesta SET correcto = 1 WHERE id_respuesta = ?");
    foreach ($correctos as $id_pregunta => $id_respuesta_correcta) {
        // Primero, ponemos todas las respuestas de esta pregunta como incorrectas
        $stmtCorrectoReset->bind_param("i", $id_pregunta);
        $stmtCorrectoReset->execute();
        // Luego, marcamos solo la seleccionada como correcta
        $stmtCorrectoSet->bind_param("i", $id_respuesta_correcta);
        $stmtCorrectoSet->execute();
    }
    $stmtCorrectoReset->close();
    $stmtCorrectoSet->close();

    // 7. Si todo salió bien, confirmamos los cambios
    $conn->commit();

    // 8. Redirigir de vuelta con un mensaje de éxito
    header("Location: ../../code_profesor/modificar_examen.php?unidad=$id_examen&success=1");
    exit();

} catch (Exception $e) {
    // 9. Si algo falló, revertimos todos los cambios
    $conn->rollback();
    die("Error al actualizar el examen. No se guardaron los cambios. Error: " . $e->getMessage());
}
?>
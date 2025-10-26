<?php
session_start();
include_once __DIR__ . '/../conexion.php'; // Ajusta la ruta si es necesario

// 1. Validaciones iniciales
// Solo permitir si hay sesión, es POST y se reciben los 'valores'
if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['valores'])) {
    header("Location: ../../code_profesor/menu_ajustes.php");
    exit;
}

$valores_post = $_POST['valores'];

// 2. Iniciar transacción
// Esto asegura que si falla una unidad, no se guarde ninguna
$conn->begin_transaction();

try {
    // 3. Preparar la consulta UNA SOLA VEZ
    // Usamos UPDATE porque los registros (1-5) ya existen en la tabla.
    $stmt = $conn->prepare("UPDATE alumnos_valores_calificar SET examen_valor = ?, actividad_valor = ? WHERE id_unidad = ?");

    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    // 4. Iterar y validar CADA unidad (1 a 5)
    for ($i = 1; $i <= 5; $i++) {
        
        // Asegurarse de que los datos de esta unidad fueron enviados
        if (!isset($valores_post[$i]) || !isset($valores_post[$i]['examen']) || !isset($valores_post[$i]['actividad'])) {
            throw new Exception("Datos incompletos para la unidad $i.");
        }

        $examen_str = $valores_post[$i]['examen'];
        $actividad_str = $valores_post[$i]['actividad'];

        $examen_db = null;
        $actividad_db = null;
        $unidad_id = $i;

        // 5. Validación del lado del servidor (¡Muy importante!)
        
        // Caso 1: Ambos vacíos (Válido, se guardará como NULL)
        if ($examen_str === '' && $actividad_str === '') {
            $examen_db = null;
            $actividad_db = null;
        } 
        // Caso 2: Ambos llenos (Validar suma)
        else if ($examen_str !== '' && $actividad_str !== '') {
            
            // Validar que sean numéricos
            if (!is_numeric($examen_str) || !is_numeric($actividad_str)) {
                throw new Exception("Error en Unidad $i: Los valores deben ser numéricos.");
            }

            $examen_val = intval($examen_str);
            $actividad_val = intval($actividad_str);

            // Validar rango (0-100)
            if ($examen_val < 0 || $examen_val > 100 || $actividad_val < 0 || $actividad_val > 100) {
                 throw new Exception("Error en Unidad $i: Los valores deben estar entre 0 y 100.");
            }

            // Validar suma
            if ($examen_val + $actividad_val !== 100) {
                throw new Exception("Error en Unidad $i: La suma debe ser 100. Suma actual: " . ($examen_val + $actividad_val));
            }

            // Si todo es válido, asignar los valores enteros
            $examen_db = $examen_val;
            $actividad_db = $actividad_val;
        } 
        // Caso 3: Uno vacío y el otro no (Inválido)
        else {
            // Esto no debería pasar si el JS funciona, pero es la seguridad del servidor
            throw new Exception("Error en Unidad $i: Debe completar ambos valores o dejar ambos vacíos.");
        }

        // 6. Bindeo y ejecución por cada unidad
        // "iii" = integer, integer, integer. PHP/MySQL maneja bien NULL para tipos integer.
        $stmt->bind_param("iii", $examen_db, $actividad_db, $unidad_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar la unidad $i: " . $stmt->error);
        }
    }

    // 7. Si todo el bucle fue bien, aplicar cambios
    $conn->commit();
    $_SESSION['success_ajustes'] = "Valores de calificación actualizados correctamente.";

} catch (Exception $e) {
    // 8. Si algo falló, revertir todos los cambios
    $conn->rollback();
    $_SESSION['error_ajustes'] = $e->getMessage();
}

// 9. Cerrar y redirigir
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
header("Location: ../../code_profesor/menu_ajustes.php");
exit;
?>
<?php
    // valores_calificacion_controller.php
    session_start();
    include_once __DIR__ . '/../conexion.php'; 

    if (!isset($_SESSION['id_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['valores'])) {
        header("Location: ../../code_profesor/menu_ajustes.php");
        exit;
    }

    $valores_post = $_POST['valores'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare(
            "UPDATE alumnos_valores_calificar 
            SET examen_valor = ?, actividad_valor = ?, asistencia_valor = ?, proyecto_final_valor = ? 
            WHERE id_unidad = ?"
        );

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

        for ($i = 1; $i <= 5; $i++) {
            
            if (
                !isset($valores_post[$i]) || 
                !isset($valores_post[$i]['examen']) || 
                !isset($valores_post[$i]['actividad']) ||
                !isset($valores_post[$i]['asistencia']) ||
                !isset($valores_post[$i]['proyecto_final']) 
            ) {
                throw new Exception("Datos incompletos para la unidad $i.");
            }

            $examen_str = $valores_post[$i]['examen'];
            $actividad_str = $valores_post[$i]['actividad'];
            $asistencia_str = $valores_post[$i]['asistencia']; 
            $proyecto_final_str = $valores_post[$i]['proyecto_final'];

            $examen_db = null;
            $actividad_db = null;
            $asistencia_db = null; 
            $proyecto_final_db = null;
            $unidad_id = $i;

            if ($examen_str === '' && $actividad_str === '' && $asistencia_str === '' && $proyecto_final_str === '') {
                $examen_db = null;
                $actividad_db = null;
                $asistencia_db = null;
                $proyecto_final_db = null;
            } 
            else if ($examen_str !== '' && $actividad_str !== '' && $asistencia_str !== '' && $proyecto_final_str !== '') {
                
                if (!is_numeric($examen_str) || !is_numeric($actividad_str) || !is_numeric($asistencia_str) || !is_numeric($proyecto_final_str)) {
                    throw new Exception("Error en Unidad $i: Los valores deben ser numéricos.");
                }

                $examen_val = intval($examen_str);
                $actividad_val = intval($actividad_str);
                $asistencia_val = intval($asistencia_str); 
                $proyecto_final_val = intval($proyecto_final_str);

                if (
                    $examen_val < 0 || $examen_val > 100 || 
                    $actividad_val < 0 || $actividad_val > 100 ||
                    $asistencia_val < 0 || $asistencia_val > 100 || 
                    $proyecto_final_val < 0 || $proyecto_final_val > 100 
                ) {
                    throw new Exception("Error en Unidad $i: Los valores deben estar entre 0 y 100.");
                }

                $suma_total = $examen_val + $actividad_val + $asistencia_val + $proyecto_final_val; 
                if ($suma_total !== 100) {
                    throw new Exception("Error en Unidad $i: La suma debe ser 100. Suma actual: " . $suma_total);
                }

                $examen_db = $examen_val;
                $actividad_db = $actividad_val;
                $asistencia_db = $asistencia_val; 
                $proyecto_final_db = $proyecto_final_val; 
            } 
            else {
                throw new Exception("Error en Unidad $i: Debe completar los CUATRO valores o dejar los CUATRO vacíos.");
            }

            $stmt->bind_param("iiiii", $examen_db, $actividad_db, $asistencia_db, $proyecto_final_db, $unidad_id);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar la unidad $i: " . $stmt->error);
            }
        }

        $conn->commit();
        $_SESSION['success_ajustes'] = "Valores de calificación actualizados correctamente.";

    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error_ajustes'] = $e->getMessage();
    }

    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    header("Location: ../../code_profesor/menu_ajustes.php");
    exit;
?>

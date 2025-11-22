<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . '/../conexion.php';

    $id_usuario = $_SESSION['id_usuario'] ?? null;
    $calificaciones_raw = [];
    $pesos_unidades = [];
    $grades_parciales = [];
    $final_pendiente = false;

    $sql_pesos = "SELECT id_unidad, examen_valor, actividad_valor, asistencia_valor, proyecto_final_valor 
                  FROM alumnos_valores_calificar 
                  WHERE id_unidad BETWEEN 1 AND 5";
    
    $resultado_pesos = $conn->query($sql_pesos);
    if ($resultado_pesos && $resultado_pesos->num_rows > 0) {
        while ($fila = $resultado_pesos->fetch_assoc()) {
            $pesos_unidades[$fila['id_unidad']] = [
                'examen' => $fila['examen_valor'],
                'actividad' => $fila['actividad_valor'],
                'asistencia' => $fila['asistencia_valor'],
                'proyecto_final' => $fila['proyecto_final_valor']
            ];
        }
    } else {
        error_log("Error: No se encontraron los pesos de calificación en la tabla alumnos_valores_calificar.");
        for ($i = 1; $i <= 5; $i++) {
            $pesos_unidades[$i] = ['examen' => 25, 'actividad' => 25, 'asistencia' => 25, 'proyecto_final' => 25];
        }
    }

    for ($i = 1; $i <= 5; $i++) {
        $grades_parciales[$i] = null;
        $calificaciones_raw["calf_$i"] = null;
        $calificaciones_raw["calf_A_$i"] = null;
        $calificaciones_raw["calf_Asis_$i"] = null; 
        $calificaciones_raw["calf_PF_$i"] = null;
    }


    if ($id_usuario) {
        $sql_califs = "SELECT
                ac.calf_1, ac.calf_2, ac.calf_3, ac.calf_4, ac.calf_5,
                aa.calf_A_1, aa.calf_A_2, aa.calf_A_3, aa.calf_A_4, aa.calf_A_5
            FROM
                alumnos_calificacion AS ac
            LEFT JOIN
                alumnos_actividad AS aa ON ac.id_usuario = aa.id_usuario
            WHERE
                ac.id_usuario = ?";

        $stmt = $conn->prepare($sql_califs);
        if ($stmt) {
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $resultado_califs = $stmt->get_result();

            if ($resultado_califs->num_rows > 0) {
                $calificaciones_raw = $resultado_califs->fetch_assoc() + $calificaciones_raw;
            }
            $stmt->close();
        } else {
            error_log("Error al preparar la consulta de calificaciones: " . $conn->error);
        }
    }

    $suma_final = 0;
    $unidades_contadas = 0;

    for ($i = 1; $i <= 5; $i++) {
        $calif_examen = $calificaciones_raw["calf_$i"];
        $calif_actividad = $calificaciones_raw["calf_A_$i"];
        
        $calif_asistencia = $calificaciones_raw["calf_Asis_$i"] ?? null;
        $calif_proyecto_final = $calificaciones_raw["calf_PF_$i"] ?? null;

        $pesos = $pesos_unidades[$i] ?? ['examen' => 0, 'actividad' => 0, 'asistencia' => 0, 'proyecto_final' => 0];

        if ($calif_examen === null && $calif_actividad === null && $calif_asistencia === null && $calif_proyecto_final === null) {
            $grades_parciales[$i] = null;
            $final_pendiente = true;
        } else {
            $examen_temp = ($calif_examen === null) ? 0 : floatval($calif_examen);
            $actividad_temp = ($calif_actividad === null) ? 0 : floatval($calif_actividad);
            $asistencia_temp = ($calif_asistencia === null) ? 0 : floatval($calif_asistencia);
            $proyecto_final_temp = ($calif_proyecto_final === null) ? 0 : floatval($calif_proyecto_final);

            $parcial = ($examen_temp * ($pesos['examen'] / 100.0)) + 
                       ($actividad_temp * ($pesos['actividad'] / 100.0)) + 
                       ($asistencia_temp * ($pesos['asistencia'] / 100.0)) + 
                       ($proyecto_final_temp * ($pesos['proyecto_final'] / 100.0));

            $grades_parciales[$i] = round($parcial, 1);

            $suma_final += $grades_parciales[$i];
            $unidades_contadas++;
        }
    }

    $grade_final = null;
    if (!$final_pendiente && $unidades_contadas > 0) {
        $grade_final = round($suma_final / $unidades_contadas, 1);
    }
?>
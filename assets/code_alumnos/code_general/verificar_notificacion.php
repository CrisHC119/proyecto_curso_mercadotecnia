<?php
    $numeroControl = $_SESSION['nocontrol']; 
    
    $hay_notificaciones = false;
    $notificaciones_pendientes = [];
    $ahora = new DateTime(); 
    $fechas_actividades = [];
    $fechas_examenes = [];

    $sql_fechas_act = "SELECT * FROM alumnos_actividad_fecha WHERE id_unidad BETWEEN 1 AND 5";
    $stmt_fechas_act = $conn->prepare($sql_fechas_act);
    if ($stmt_fechas_act && $stmt_fechas_act->execute()) {
        $result_fechas_act = $stmt_fechas_act->get_result();
        while ($fila = $result_fechas_act->fetch_assoc()) {
            $fechas_actividades[$fila['id_unidad']] = $fila;
        }
        $stmt_fechas_act->close();
    }

    $sql_fechas_exam = "SELECT * FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
    $stmt_fechas_exam = $conn->prepare($sql_fechas_exam);
    if ($stmt_fechas_exam && $stmt_fechas_exam->execute()) {
        $result_fechas_exam = $stmt_fechas_exam->get_result();
        while ($fila = $result_fechas_exam->fetch_assoc()) {
            $fechas_examenes[$fila['id_examen']] = $fila;
        }
        $stmt_fechas_exam->close();
    }
    
    $estado_actividades = null;
    $estado_examenes = null;
    $estado_entregado_bit = []; 
    
    $sql_estado_act = "SELECT * FROM alumnos_actividad WHERE id_usuario = ?";
    $stmt_estado_act = $conn->prepare($sql_estado_act);
    if ($stmt_estado_act) {
        $stmt_estado_act->bind_param("s", $numeroControl);
        if ($stmt_estado_act->execute()) {
            $estado_actividades = $stmt_estado_act->get_result()->fetch_assoc();
        }
        $stmt_estado_act->close();
    }

    $sql_estado_exam = "SELECT * FROM alumnos_calificacion WHERE id_usuario = ?";
    $stmt_estado_exam = $conn->prepare($sql_estado_exam);
    if ($stmt_estado_exam) {
        $stmt_estado_exam->bind_param("s", $numeroControl);
        if ($stmt_estado_exam->execute()) {
            $estado_examenes = $stmt_estado_exam->get_result()->fetch_assoc();
        }
        $stmt_estado_exam->close();
    }

    $sql_entregado_bit = "SELECT act_unidad_1, act_unidad_2, act_unidad_3, act_unidad_4, act_unidad_5 FROM actividad_entregado WHERE id_usuario = ?";
    $stmt_entregado_bit = $conn->prepare($sql_entregado_bit);
    if ($stmt_entregado_bit) {
        $stmt_entregado_bit->bind_param("s", $numeroControl);
        if ($stmt_entregado_bit->execute()) {
            $resultado_bit = $stmt_entregado_bit->get_result()->fetch_assoc();
            if ($resultado_bit) {
                for ($k = 1; $k <= 5; $k++) {
                    $columna_bit = 'act_unidad_' . $k;
                    $estado_entregado_bit[$k] = (int)($resultado_bit[$columna_bit] ?? 0); 
                }
            }
        }
        $stmt_entregado_bit->close();
    }

    $fila_fechas_maestra = $fechas_actividades[1] ?? null; 

    for ($i = 1; $i <= 5; $i++) {
        
        // Verificamos si tenemos la fila maestra cargada
        if ($fila_fechas_maestra) {
            
            // Construimos los nombres de las columnas dinámicamente
            // Ejemplo: act_1_fecha_inicial, act_2_fecha_inicial...
            $col_inicio = 'act_' . $i . '_fecha_inicial';
            $col_final  = 'act_' . $i . '_fecha_final';
            
            // Obtenemos los valores DIRECTAMENTE de la fila maestra (fila 1)
            $fecha_inicial_act_str = $fila_fechas_maestra[$col_inicio] ?? null;
            $fecha_final_act_str = $fila_fechas_maestra[$col_final] ?? null;
            
            // Verificamos si ya entregó
            $actividad_entregada_finalmente = (($estado_entregado_bit[$i] ?? 0) == 1);
            
            if ($fecha_inicial_act_str && $fecha_final_act_str) {
                try {
                    $fecha_inicial_act = new DateTime($fecha_inicial_act_str);
                    $fecha_final_act = new DateTime($fecha_final_act_str);
                    
                    // IMPORTANTE: Ajuste de medianoche para que no desaparezca hoy
                    $fecha_final_act->setTime(23, 59, 59);

                    // Comparamos fechas
                    if ($ahora >= $fecha_inicial_act && $ahora <= $fecha_final_act) {
                        
                        if (!$actividad_entregada_finalmente) { 
                            $notificaciones_pendientes[] = [
                                'tipo' => 'actividad',
                                'unidad' => $i,
                                'mensaje' => $textos['noti_actividad'] . " $i " . $textos['noti_disponible'],
                                'enlace' => "/assets/code_alumnos/temas_unidad/tema_$i/T_" . $i . ".A.php?lang=" . $_SESSION['idioma']
                            ];
                            $hay_notificaciones = true;
                        }
                    }
                } catch (Exception $e) {
                    // Error silencioso o debug
                }
            }
        }
        if (isset($fechas_examenes[$i])) {
            $fecha_inicial_exam_str = $fechas_examenes[$i]['fecha_disponible'];
            $fecha_final_exam_str = $fechas_examenes[$i]['fecha_limite'];
            
            if ($fecha_inicial_exam_str && $fecha_final_exam_str) {
                try {
                    $fecha_inicial_exam = new DateTime($fecha_inicial_exam_str);
                    $fecha_final_exam = new DateTime($fecha_final_exam_str);
                    
                    if ($ahora >= $fecha_inicial_exam && $ahora < $fecha_final_exam) {
                        $columna_exam = 'examen_U' . $i;
                        if ($estado_examenes === null || !isset($estado_examenes[$columna_exam]) || $estado_examenes[$columna_exam] == 0) {
                            $notificaciones_pendientes[] = [
                                'tipo' => 'examen',
                                'unidad' => $i,
                                'mensaje' => $textos['noti_examen'] . " $i " . $textos['noti_disponible'],
                                'enlace' => "/assets/code_alumnos/temas_unidad/tema_$i/T_" . $i . "_confirmar_examen.php?lang=" . $_SESSION['idioma'] 
                            ];
                            $hay_notificaciones = true;
                        }
                    }
                } catch (Exception $e) {
                }
            }
        }
    }
?>
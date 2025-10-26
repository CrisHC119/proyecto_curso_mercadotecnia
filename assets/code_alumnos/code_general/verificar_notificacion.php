<?php
    $id_usuario = $_SESSION['id_usuario']; 
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
    $sql_fechas_exam = "SELECT * FROM examen_unidad WHERE id_unidad BETWEEN 1 AND 5";
    $stmt_fechas_exam = $conn->prepare($sql_fechas_exam);
    if ($stmt_fechas_exam && $stmt_fechas_exam->execute()) {
        $result_fechas_exam = $stmt_fechas_exam->get_result();
        while ($fila = $result_fechas_exam->fetch_assoc()) {
            $fechas_examenes[$fila['id_unidad']] = $fila;
        }
        $stmt_fechas_exam->close();
    }
    $estado_actividades = null;
    $estado_examenes = null;
    $sql_estado_act = "SELECT * FROM alumnos_actividad WHERE id_usuario = ?";
    $stmt_estado_act = $conn->prepare($sql_estado_act);
    if ($stmt_estado_act) {
        $stmt_estado_act->bind_param("i", $id_usuario);
        if ($stmt_estado_act->execute()) {
            $estado_actividades = $stmt_estado_act->get_result()->fetch_assoc();
        }
        $stmt_estado_act->close();
    }
    $sql_estado_exam = "SELECT * FROM alumnos_calificacion WHERE id_usuario = ?";
    $stmt_estado_exam = $conn->prepare($sql_estado_exam);
    if ($stmt_estado_exam) {
        $stmt_estado_exam->bind_param("i", $id_usuario);
        if ($stmt_estado_exam->execute()) {
            $estado_examenes = $stmt_estado_exam->get_result()->fetch_assoc();
        }
        $stmt_estado_exam->close();
    }
    for ($i = 1; $i <= 5; $i++) {
        if (isset($fechas_actividades[$i])) {
            $fecha_inicial_act_str = $fechas_actividades[$i]['act_' . $i . '_fecha_inicial'];
            $fecha_final_act_str = $fechas_actividades[$i]['act_' . $i . '_fecha_final'];
            if ($fecha_inicial_act_str && $fecha_final_act_str) {
                try {
                    $fecha_inicial_act = new DateTime($fecha_inicial_act_str);
                    $fecha_final_act = new DateTime($fecha_final_act_str);
                    if ($ahora >= $fecha_inicial_act && $ahora < $fecha_final_act) {
                        $columna_act = 'calf_A_' . $i;
                        if ($estado_actividades === null || !isset($estado_actividades[$columna_act]) || $estado_actividades[$columna_act] === null) {
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
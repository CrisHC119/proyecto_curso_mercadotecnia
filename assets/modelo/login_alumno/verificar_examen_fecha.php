<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
    date_default_timezone_set('America/Monterrey');

    $numeroControl = $_SESSION['nocontrol'] ?? null;

    $fechas_examen = [];
    $sqlFechasExamen = "SELECT id_examen, fecha_disponible, fecha_limite FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
    $resultFechasExamen = $conn->query($sqlFechasExamen);

    if ($resultFechasExamen) {
        while ($fila = $resultFechasExamen->fetch_assoc()) {
            $fechas_examen[$fila['id_examen']] = [
                'disponible' => $fila['fecha_disponible'],
                'limite' => $fila['fecha_limite']
            ];
        }
    }

    $fechas_actividad_unica_fila = [];
    $sqlFechasActividad = "SELECT * FROM alumnos_actividad_fecha WHERE id_unidad = 1"; 
    $resultFechasActividad = $conn->query($sqlFechasActividad);

    if ($resultFechasActividad && $resultFechasActividad->num_rows > 0) {
        $fechas_actividad_unica_fila = $resultFechasActividad->fetch_assoc();
    }
    
    $estados_calificacion = [];
    $estados_entregado_bit = [];
    
    if ($numeroControl) {
        $sqlEstadoExamen = $conn->prepare("SELECT examen_U1, examen_U2, examen_U3, examen_U4, examen_U5 FROM alumnos_calificacion WHERE id_usuario = ?");
        $sqlEstadoExamen->bind_param("s", $numeroControl); 
        $sqlEstadoExamen->execute();
        $resEstadoExamen = $sqlEstadoExamen->get_result();
        if ($fila = $resEstadoExamen->fetch_assoc()) {
            $estados_calificacion = $fila; 
        }
        $sqlEstadoExamen->close();
        
        $sqlEntregadoBit = $conn->prepare("SELECT act_unidad_1, act_unidad_2, act_unidad_3, act_unidad_4, act_unidad_5 FROM actividad_entregado WHERE id_usuario = ?");
        $sqlEntregadoBit->bind_param("s", $numeroControl); 
        $sqlEntregadoBit->execute();
        $resEntregadoBit = $sqlEntregadoBit->get_result();
        if ($fila = $resEntregadoBit->fetch_assoc()) {
            for ($k = 1; $k <= 5; $k++) {
                $columna_bit = 'act_unidad_' . $k;
                $estados_entregado_bit[$k] = (int)($fila[$columna_bit] ?? 0);
            }
        }
        $sqlEntregadoBit->close();
    }

    for ($i = 1; $i <= 5; $i++) {
        ${"fechaDisponible_U".$i} = $fechas_examen[$i]['disponible'] ?? null;
        ${"fechaLimite_U".$i} = $fechas_examen[$i]['limite'] ?? null;
        ${"examenRealizado_U".$i} = !empty($estados_calificacion['examen_U' . $i]);

        ${"fechaDisponible_A".$i} = $fechas_actividad_unica_fila["act_{$i}_fecha_inicial"] ?? null; 
        ${"fechaLimite_A".$i} = $fechas_actividad_unica_fila["act_{$i}_fecha_final"] ?? null;
        
        ${"actividadRealizada_U".$i} = ($estados_entregado_bit[$i] ?? 0) == 1; 
        
        ${"fechaDisponibleISO_U".$i} = ${"fechaDisponible_U".$i} ? (new DateTime(${"fechaDisponible_U".$i}))->format(DateTime::ATOM) : '';
        ${"fechaLimiteISO_U".$i} = ${"fechaLimite_U".$i} ? (new DateTime(${"fechaLimite_U".$i}))->format(DateTime::ATOM) : '';
    }

    function mostrarEstadoFecha($fechaInicio, $fechaFin, $realizadaBit = false) {
        if ($realizadaBit) {
            return "<span class='text-success fw-bold'>Realizada</span>";
        }
        
        if (!$fechaInicio || !$fechaFin) {
            return "<span class='text-danger fw-bold'>No disponible</span>";
        }

        $zona = new DateTimeZone('America/Monterrey');
        $inicio = new DateTime($fechaInicio, $zona);
        $fin = new DateTime($fechaFin, $zona);
        $ahora = new DateTime('now', $zona);

        if ($ahora < $inicio) {
            return "<span class='text-warning fw-bold'>Disponible desde: " . $inicio->format("d/m/Y H:i") . "</span>";
        } elseif ($ahora > $fin) {
            return "<span class='text-danger fw-bold'>Vencido el: " . $fin->format("d/m/Y H:i") . "</span>";
        } else {
            return "<span class='text-success fw-bold'>Disponible: " . $fin->format("d/m/Y H:i") . "</span>";
        }
    }
?>
<?php
    // verificar_actividad_fecha.php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
    date_default_timezone_set('America/Monterrey');

    $fechas = [];
    $sqlFechas = "SELECT id_examen, fecha_disponible, fecha_limite FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
    $resultFechas = $conn->query($sqlFechas);

    if ($resultFechas) {
        while ($fila = $resultFechas->fetch_assoc()) {
            $fechas[$fila['id_examen']] = [
                'disponible' => $fila['fecha_disponible'],
                'limite' => $fila['fecha_limite']
            ];
        }
    }

    $estadosExamenes = [];
    $id_usuario = $_SESSION['id_usuario'] ?? 0;

    if ($id_usuario) {
        $sqlEstado = $conn->prepare("SELECT examen_U1, examen_U2, examen_U3, examen_U4, examen_U5 FROM alumnos_calificacion WHERE id_usuario = ?");
        $sqlEstado->bind_param("i", $id_usuario);
        $sqlEstado->execute();
        $resEstado = $sqlEstado->get_result();
        if ($fila = $resEstado->fetch_assoc()) {
            $estadosExamenes = $fila;
        }
    }

    for ($i = 1; $i <= 5; $i++) {
        ${"fechaDisponible_U".$i} = $fechas[$i]['disponible'] ?? null;
        ${"fechaLimite_U".$i} = $fechas[$i]['limite'] ?? null;
        ${"examenRealizado_U".$i} = !empty($estadosExamenes['examen_U' . $i]);

        ${"fechaDisponibleISO_U".$i} = ${"fechaDisponible_U".$i} ? (new DateTime(${"fechaDisponible_U".$i}))->format(DateTime::ATOM) : '';
        ${"fechaLimiteISO_U".$i} = ${"fechaLimite_U".$i} ? (new DateTime(${"fechaLimite_U".$i}))->format(DateTime::ATOM) : '';
    }

    function mostrarEstadoFecha($fechaInicio, $fechaFin) {
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

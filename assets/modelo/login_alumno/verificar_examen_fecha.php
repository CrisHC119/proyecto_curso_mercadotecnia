<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
    date_default_timezone_set('America/Monterrey');

    // --- MODELO UNIFICADO Y EFICIENTE ---

    // 1. Obtenemos TODAS las fechas en una sola consulta
    $fechas = [];
    $sqlFechas = "SELECT id_examen, fecha_disponible FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
    $resultFechas = $conn->query($sqlFechas);
    if ($resultFechas) {
        while ($fila = $resultFechas->fetch_assoc()) {
            $fechas[$fila['id_examen']] = $fila['fecha_disponible'];
        }
    }

    // 2. Obtenemos TODOS los estados de los exámenes del usuario en una sola consulta
    $estadosExamenes = [];
    $id_usuario = $_SESSION['id_usuario'] ?? 0;
    if ($id_usuario) {
        $sqlEstado = $conn->prepare("SELECT examen_U1, examen_U2, examen_U3, examen_U4, examen_U5 FROM alumnos_calificacion WHERE id_usuario = ?");
        $sqlEstado->bind_param("i", $id_usuario);
        $sqlEstado->execute();
        $resEstado = $sqlEstado->get_result();
        if ($fila = $resEstado->fetch_assoc()) {
            $estadosExamenes = $fila; // Guardamos la fila completa
        }
    }

    // Generamos las variables específicas para cada unidad para usarlas en el HTML
    for ($i = 1; $i <= 5; $i++) {
        ${"fechaExamen_U".$i} = $fechas[$i] ?? null;
        ${"examenRealizado_U".$i} = !empty($estadosExamenes['examen_U' . $i]);
        ${"fechaISO_U".$i} = ${"fechaExamen_U".$i} ? (new DateTime(${"fechaExamen_U".$i}))->format(DateTime::ATOM) : '';
    }
    
    // Función genérica para mostrar el estado de la fecha
    function mostrarEstadoFecha($fecha) {
        if (!$fecha) {
            return "<span class='text-danger fw-bold'>No disponible</span>";
        }
        $fechaObj = new DateTime($fecha, new DateTimeZone('America/Monterrey'));
        $ahora = new DateTime('now', new DateTimeZone('America/Monterrey'));

        if ($fechaObj < $ahora) {
            return "<span class='text-danger fw-bold'>Vencido: " . $fechaObj->format("d/m/Y H:i") . "</span>";
        }
        // Si la fecha es válida, se muestra normalmente
        return "<span>" . $fechaObj->format("d/m/Y H:i") . "</span>";
    }
?>
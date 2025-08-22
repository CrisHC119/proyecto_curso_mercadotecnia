<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
    date_default_timezone_set('America/Monterrey');

    $sql = "SELECT fecha_disponible FROM examen_unidad WHERE id_examen = 1 LIMIT 1";
    $result = $conn->query($sql);

    $fechaExamen = null;
    if ($result && $result->num_rows > 0) {
        $fechaExamen = $result->fetch_assoc()['fecha_disponible'];
    }

    function mostrarEstadoFecha($fecha) {
        if (!$fecha) {
            return "<span class='text-danger fw-bold'>No disponible</span>";
        }
        $fechaObj = new DateTime($fecha, new DateTimeZone('America/Monterrey'));
        $ahora = new DateTime('now', new DateTimeZone('America/Monterrey'));

        if ($fechaObj < $ahora) {
            return "<span class='text-danger fw-bold'>Vencido: " . $fechaObj->format("d/m/Y H:i") . "</span>";
        }
        return "<span>" . $fechaObj->format("d/m/Y H:i") . "</span>";
    }
    $id_usuario = $_SESSION['id_usuario'] ?? 0;
    $examenRealizado = false;
    if ($id_usuario) {
        $sqlEstado = $conn->prepare("SELECT examen_U1 FROM alumnos_calificacion WHERE id_usuario = ?");
        $sqlEstado->bind_param("i", $id_usuario);
        $sqlEstado->execute();
        $resEstado = $sqlEstado->get_result();
        if ($fila = $resEstado->fetch_assoc()) {
            $examenRealizado = ($fila['examen_U1'] == 1);
        }
    }
    $fechaISO = $fechaExamen ? (new DateTime($fechaExamen, new DateTimeZone('America/Monterrey')))->format(DateTime::ATOM) : null;
?>
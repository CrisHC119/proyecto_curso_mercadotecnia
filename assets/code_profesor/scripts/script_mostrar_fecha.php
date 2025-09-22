<?php
    function mostrarFecha($fecha) {
        if (!$fecha) {
            return "<span class='text-danger fw-bold'>No asignado</span>";
        }

        $zona = new DateTimeZone('America/Monterrey');
        $fechaExamen = new DateTime($fecha, $zona);
        $ahora = new DateTime('now', $zona);

        if ($fechaExamen < $ahora) {
            return "<span class='text-danger fw-bold'>" . $fechaExamen->format("d/m/Y H:i") . " (Vencido)</span>";
        }

        return $fechaExamen->format("d/m/Y H:i");
    }
?>
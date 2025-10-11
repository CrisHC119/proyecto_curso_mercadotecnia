<?php
include_once __DIR__ . '/../../../code_general/verificar_session_apagado.php';
include_once __DIR__ . '/../../../code_general/bootstrap_5.php';
include_once __DIR__ . '/../../../modelo/conexion.php'; 

if (!isset($_SESSION['id_usuario'])) {
    header("Location: /index.php");
    exit;
}

$tipo = intval($_SESSION['id_tipo_usuario'] ?? 0);
if ($tipo !== 3) {
    header("Location: /index.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_unidad_actual = 1; // Unidad 1

$accesoPermitido = false;
$mensajeError = '';
$iconoError = 'bi-x-circle-fill'; // Icono por defecto para errores

// 1. Verificar si el alumno ya realizó el examen
$stmt_realizado = $conn->prepare("SELECT examen_U1 FROM alumnos_calificacion WHERE id_usuario = ?");
$stmt_realizado->bind_param("i", $id_usuario);
$stmt_realizado->execute();
$resultado_realizado = $stmt_realizado->get_result();
$examenRealizado = ($resultado_realizado->fetch_assoc()['examen_U1'] ?? 0) == 1;
$stmt_realizado->close();

if ($examenRealizado) {
    $mensajeError = 'Ya has completado este examen y no puedes volver a presentarlo.';
    $iconoError = 'bi-check-circle-fill';
} else {
    // 2. Obtener las fechas de disponibilidad y límite del examen desde la BD
    // CAMBIO: Se añade 'fecha_limite' a la consulta SQL
    $stmt_fechas = $conn->prepare("SELECT fecha_disponible, fecha_limite FROM examen_unidad WHERE id_unidad = ?");
    $stmt_fechas->bind_param("i", $id_unidad_actual);
    $stmt_fechas->execute();
    $resultado_fechas = $stmt_fechas->get_result();
    $examen_info = $resultado_fechas->fetch_assoc();
    $stmt_fechas->close();

    // 3. Validar las fechas obtenidas
    if (!$examen_info || is_null($examen_info['fecha_disponible']) || is_null($examen_info['fecha_limite'])) {
        $mensajeError = 'Las fechas para este examen no han sido configuradas. Contacta a tu profesor.';
    } else {
        // Establecer la zona horaria correcta
        $zonaHorariaLocal = new DateTimeZone('America/Mexico_City');
        $ahora = new DateTime("now", $zonaHorariaLocal);
        
        // Crear objetos DateTime para las fechas de la base de datos
        $inicio = new DateTime($examen_info['fecha_disponible'], $zonaHorariaLocal);
        $fin = new DateTime($examen_info['fecha_limite'], $zonaHorariaLocal);

        // CAMBIO: La lógica ahora usa las fechas exactas de la base de datos
        if ($ahora < $inicio) {
            $mensajeError = 'El examen aún no está disponible. Podrás presentarlo a partir del ' . $inicio->format('d/m/Y \a \l\a\s H:i');
            $iconoError = 'bi-calendar-x-fill';
        } elseif ($ahora > $fin) {
            // Este es el nuevo mensaje de error usando la fecha límite real
            $mensajeError = 'El periodo para presentar este examen ha finalizado. La fecha límite era el ' . $fin->format('d/m/Y \a \l\a\s H:i');
            $iconoError = 'bi-calendar-x-fill';
        } else {
            // Si la fecha actual está dentro del rango, se permite el acceso
            $accesoPermitido = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Examen - Unidad 1</title>
    <style>
        body { background: linear-gradient(to right, #f8f9fa, #e9ecef); }
    </style>
</head>
<body>
<div class="container d-flex flex-column justify-content-center min-vh-100 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 text-center" style="max-width: 600px; margin: auto;">
                <div class="card-body p-4 p-sm-5">

                    <?php if ($accesoPermitido): ?>
                        <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>
                        <h2 class="card-title mb-3">Confirmar Examen</h2>
                        <p class="text-muted">Estás a punto de iniciar el examen de la <strong>Unidad 1</strong>.</p>
                        <div class="alert alert-info mt-4">
                            <h5 class="alert-heading">Reglas del Examen</h5>
                            <ul class="list-unstyled mb-0 text-start">
                                <li><i class="bi bi-alarm me-2"></i><strong>Tiempo Límite:</strong> 10 minutos.</li>
                                <li><i class="bi bi-exclamation-triangle me-2"></i><strong>Importante:</strong> El cronómetro no se detiene una vez iniciado.</li>
                            </ul>
                        </div>
                        <form action="T_1_Examen.php" method="post" class="mt-4">
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-play-circle me-2"></i>Comenzar Examen
                                </button>
                                <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Regresar
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <i class="bi <?= $iconoError ?> fs-1 <?= ($examenRealizado) ? 'text-success' : 'text-danger' ?> mb-3"></i>
                        <h2 class="card-title mb-3"><?= ($examenRealizado) ? 'Examen Completado' : 'Acceso Denegado' ?></h2>
                        <p class="text-muted"><?= htmlspecialchars($mensajeError) ?></p>
                        <div class="d-grid mt-4">
                            <button type="button" onclick="history.back()" class="btn btn-primary">
                                <i class="bi bi-arrow-left me-2"></i>Regresar
                            </button>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
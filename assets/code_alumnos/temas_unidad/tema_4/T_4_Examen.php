<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    require_once '../../../modelo/conexion.php'; 

    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        die("Acceso denegado: Usuario no identificado.");
    }
    
    // --- CONFIGURACIÓN ESPECÍFICA UNIDAD 4 ---
    $id_examen = 4;        // ID en tabla examen_pregunta
    $id_unidad_actual = 4; // ID en tabla examen_unidad (para fechas)
    
    $puntos_totales = null;
    $examen_enviado = $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST);
    $zonaHorariaLocal = new DateTimeZone('America/Mexico_City');
    
    // --- 1. OBTENER DATOS DEL ALUMNO (CAMPOS U4) ---
    $sqlTipo = $conn->prepare("SELECT tipo_examen_U4, calf_4, examen_U4, inicio_examen_U4 FROM alumnos_calificacion WHERE id_usuario = ?");
    $sqlTipo->bind_param("i", $id_usuario);
    $sqlTipo->execute();
    $resTipo = $sqlTipo->get_result();
    $row = $resTipo->fetch_assoc();
    
    $examenYaRealizado = ($row && $row['examen_U4'] == 1);
    $inicio_examen_db = $row ? $row['inicio_examen_U4'] : null;

    // --- 2. CARGAR TEXTOS ---
    define('ROOT_PATH', dirname(__DIR__, 4));
    $idioma = $_SESSION['idioma'] ?? 'es';
    $rutaArchivo = ROOT_PATH . "/assets/lang/lang_{$idioma}.json"; 
    if (!file_exists($rutaArchivo)) { 
        $rutaArchivo = ROOT_PATH . "/assets/lang/lang_es.json"; 
    }
    $textos = json_decode(file_get_contents($rutaArchivo), true);

    // --- 3. VERIFICACIONES PREVIAS ---
    if (!$examen_enviado) {
        if ($examenYaRealizado) {
            echo "<script>alert('Ya has realizado este examen.'); window.location.href='../../index_alumnos.php';</script>";
            exit;
        }

        $stmt_fechas = $conn->prepare("SELECT fecha_disponible, fecha_limite FROM examen_unidad WHERE id_unidad = ?");
        $stmt_fechas->bind_param("i", $id_unidad_actual); 
        $stmt_fechas->execute(); 
        $examen_info = $stmt_fechas->get_result()->fetch_assoc();
        $stmt_fechas->close();

        $mensajeError = '';

        if (!$examen_info || is_null($examen_info['fecha_disponible']) || is_null($examen_info['fecha_limite'])) {
            $mensajeError = 'Las fechas para este examen no han sido configuradas...';
        } else {
            $ahora = new DateTime("now", $zonaHorariaLocal);
            $inicio = new DateTime($examen_info['fecha_disponible'], $zonaHorariaLocal);
            $fin = new DateTime($examen_info['fecha_limite'], $zonaHorariaLocal);

            if ($ahora < $inicio) {
                $mensajeError = 'El examen aún no está disponible...';
            } elseif ($ahora > $fin) {
                if (is_null($inicio_examen_db)) { 
                    $mensajeError = 'El periodo para presentar este examen ha finalizado...';
                }
            }
        }

        if (!empty($mensajeError)) {
            echo "<div class='container py-5'><div class='alert alert-danger'>$mensajeError</div><a href='../../index_alumnos.php' class='btn btn-primary'>Volver</a></div>";
            exit;
        }
    }

    // --- 4. ASEGURAR EXISTENCIA DE FILA ---
    if (!$row) {
        // Creamos registro inicial U4
        $in = $conn->prepare("INSERT INTO alumnos_calificacion (id_usuario, tipo_examen_U4) VALUES (?, 1)");
        $in->bind_param("ii", $id_usuario);
        $in->execute();
        $inicio_examen_db = null; 
    } else {
        if ($examenYaRealizado) { 
            $puntos_totales = $row['calf_4'];
        }
    }

    // --- 5. LÓGICA DEL TEMPORIZADOR (60 MINUTOS) ---
    $limite = 60 * 60; 
    $tiempo_restante = $limite; 
    $tiempo_inicio_ts = null;

    if ($inicio_examen_db) {
        $inicio = new DateTime($inicio_examen_db, $zonaHorariaLocal);
        $tiempo_inicio_ts = $inicio->getTimestamp();
        $tiempo_restante = $limite - (time() - $tiempo_inicio_ts);
        
    } elseif (!$examen_enviado) {
        $ahora_sql = (new DateTime("now", $zonaHorariaLocal))->format('Y-m-d H:i:s');
        
        $stmt_set_start = $conn->prepare("UPDATE alumnos_calificacion SET inicio_examen_U4 = ? WHERE id_usuario = ? AND inicio_examen_U4 IS NULL");
        $stmt_set_start->bind_param("si", $ahora_sql, $id_usuario);
        $stmt_set_start->execute();
        $stmt_set_start->close();

        $tiempo_restante = $limite;
    }

    // --- 6. MANEJO DE TIMEOUT ---
    if ($tiempo_restante <= 0 && !$examen_enviado) {
        $puntos_totales_timeout = 0; 
        $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_4 = ?, examen_U4 = 1 WHERE id_usuario = ? AND examen_U4 = 0");
        $guardar->bind_param("ii", $puntos_totales_timeout, $id_usuario);
        $guardar->execute();
        
        echo "<script>alert('Tu tiempo ha terminado. El examen se cerró automáticamente.'); window.location.href='../../index_alumnos.php';</script>";
        exit;
    }

    // --- 7. OBTENER TODAS LAS PREGUNTAS ---
    $stmt = $conn->prepare("SELECT * FROM examen_pregunta WHERE id_examen = ?");
    $stmt->bind_param("i", $id_examen);
    $stmt->execute();
    $todasLasPreguntas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $totalPreguntas = count($todasLasPreguntas);

    // Mezclar preguntas
    shuffle($todasLasPreguntas); 

    // --- 8. PROCESAR EXAMEN ENVIADO ---
    if ($examen_enviado && $puntos_totales === null) {
        $aciertos = 0;

        foreach ($_POST as $key => $id_respuesta) {
            if (strpos($key, 'pregunta_') === 0 && is_numeric($id_respuesta)) {
                $ver = $conn->prepare("SELECT correcto FROM examen_respuesta WHERE id_respuesta = ?");
                $ver->bind_param("i", $id_respuesta);
                $ver->execute();
                $rs = $ver->get_result();
                $resp_data = $rs->fetch_assoc();
                
                if ($resp_data && $resp_data['correcto']) {
                    $aciertos++;
                }
            }
        }

        // Calcular calificación proporcional
        $puntos_totales = ($totalPreguntas > 0) ? round(($aciertos / $totalPreguntas) * 100) : 0;

        $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_4 = ?, examen_U4 = 1 WHERE id_usuario = ?");
        $guardar->bind_param("ii", $puntos_totales, $id_usuario);
        $guardar->execute();
    }
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($idioma) ?>">
<head>
    <meta charset="UTF-8">
    <title>Examen Unidad 4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 1rem; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); }
        .card-header { background-color: #0d6efd; color: white; border-top-left-radius: 1rem; border-top-right-radius: 1rem; padding: 1.5rem; }
        #temporizador { font-size: 1.25rem; font-weight: 500; }
        .pregunta-bloque { border: 1px solid #e9ecef; border-radius: 0.75rem; padding: 1.5rem; background-color: #fff; }
        .form-check-label { cursor: pointer; padding: 0.5rem 0.75rem; border-radius: 0.5rem; transition: background-color 0.2s; width: 100%; }
        .form-check-input { margin-top: 0.7em; }
        .form-check-input:checked + .form-check-label { background-color: #e9f2ff; font-weight: 500; color: #0d6efd; }
        .resultado-final { background: linear-gradient(135deg, #28a745, #218838); }
        .form-check-label.correcta { border: 1px solid #198754; background-color: #e9fdef; color: #146c43; font-weight: bold; }
        .form-check-label.incorrecta { border: 1px solid #dc3545; background-color: #fdefee; color: #b02a37; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 h4"><i class="bi bi-file-earmark-text-fill"></i> Examen Unidad 4</h4>
                <small class="text-white-50">Total de preguntas: <?= $totalPreguntas ?></small>
            </div>
            <?php if ($puntos_totales === null) : ?>
                <span id="temporizador" class="badge bg-light text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-clock-fill"></i>
                    <span>--:--</span>
                </span>
            <?php endif; ?>
        </div>
        <div class="card-body p-4 p-md-5">
            <form method="POST" id="form-examen">
                <?php
                foreach ($todasLasPreguntas as $i => $pregunta) {
                    $id_pregunta = $pregunta['id_pregunta'];
                    
                    // Verificamos si es pregunta de Verdadero/Falso (bit)
                    $esVF = isset($pregunta['pre_falso']) && $pregunta['pre_falso'] == 1;

                    $texto_pregunta = $textos[$pregunta['pregunta']] ?? $pregunta['pregunta'];

                    echo "<div class='pregunta-bloque mb-4'><p class='fw-bold fs-5'>" . ($i + 1) . ". " . htmlspecialchars($texto_pregunta) . "</p>";

                    $stmtResp = $conn->prepare("SELECT * FROM examen_respuesta WHERE id_pregunta = ?");
                    $stmtResp->bind_param("i", $id_pregunta);
                    $stmtResp->execute();
                    $resps = $stmtResp->get_result()->fetch_all(MYSQLI_ASSOC);

                    // --- FILTRO V/F: Si es verdadero/falso, cortamos a 2 respuestas ---
                    if ($esVF && count($resps) > 2) {
                        $resps = array_slice($resps, 0, 2);
                    }

                    // Mezclar respuestas
                    shuffle($resps);

                    $seleccionada = $_POST['pregunta_' . $id_pregunta] ?? null;

                    foreach ($resps as $resp) {
                        $id_respuesta = $resp['id_respuesta'];
                        $checked = ($id_respuesta == $seleccionada) ? 'checked' : '';
                        $disabled = ($puntos_totales !== null) ? 'disabled' : '';
                        $clase_label = '';

                        if ($puntos_totales !== null) { 
                            if ($resp['correcto']) {
                                $clase_label = 'correcta';
                            } elseif ($id_respuesta == $seleccionada && !$resp['correcto']) {
                                $clase_label = 'incorrecta';
                            }
                        }

                        $texto_resp = $textos[$resp['respuesta']] ?? $resp['respuesta'];
                        echo "<div class='form-check mb-2'>";
                        echo "<input class='form-check-input' type='radio' name='pregunta_{$id_pregunta}' id='r{$id_respuesta}' value='{$id_respuesta}' {$checked} {$disabled} required>";
                        echo "<label class='form-check-label {$clase_label}' for='r{$id_respuesta}'>" . htmlspecialchars($texto_resp) . "</label>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
                ?>

                <?php if ($puntos_totales === null) : ?>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Enviar Examen</button>
                    </div>
                <?php else : ?>
                    <div class="alert resultado-final text-white text-center mt-4">
                        <h3 class="mb-0">Resultado Final: <?= htmlspecialchars($puntos_totales) ?> / 100</h3>
                        <p class="mb-0">Has acertado <?= $aciertos ?> de <?= $totalPreguntas ?> preguntas.</p>
                    </div>
                    <div class="text-center mt-4">
                        <a href="../../index_alumnos.php" class="btn btn-secondary">Volver al Inicio</a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<script>
    let tiempoRestante = <?= $tiempo_restante > 0 ? $tiempo_restante : 0 ?>;
    
    <?php if ($puntos_totales === null) : ?>
    const temporizadorEl = document.querySelector('#temporizador span');
    const formExamen = document.getElementById('form-examen');
    let intervaloTimer;
    let submitted = false; 

    function actualizarTemporizador() {
        if (tiempoRestante <= 0) {
            temporizadorEl.textContent = '00:00';
            clearInterval(intervaloTimer); 
            
            if (formExamen && !submitted) {
                submitted = true; 
                alert("El tiempo ha terminado. El examen se enviará automáticamente.");
                formExamen.submit();
            }
            return;
        }

        const horas = Math.floor(tiempoRestante / 3600);
        const minutos = Math.floor((tiempoRestante % 3600) / 60);
        const segundos = tiempoRestante % 60;

        const hStr = horas > 0 ? horas.toString().padStart(2, '0') + ':' : '';
        const mStr = minutos.toString().padStart(2, '0');
        const sStr = segundos.toString().padStart(2, '0');

        temporizadorEl.textContent = `${hStr}${mStr}:${sStr}`;
        tiempoRestante--;
    }

    if (formExamen) {
        formExamen.addEventListener('submit', function() {
            submitted = true;
            clearInterval(intervaloTimer); 
        });
    }
    
    if (temporizadorEl) {
        actualizarTemporizador(); 
        intervaloTimer = setInterval(actualizarTemporizador, 1000); 
    }
    <?php endif; ?>
</script>
</body>
</html>
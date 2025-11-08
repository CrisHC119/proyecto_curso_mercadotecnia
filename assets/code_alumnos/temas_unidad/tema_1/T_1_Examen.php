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
    
    $id_examen = 1;
    $id_unidad_actual = 1;
    $puntos_totales = null;
    $examen_enviado = $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST);
    $zonaHorariaLocal = new DateTimeZone('America/Mexico_City');
    
    // --- 1. OBTENER DATOS DEL ALUMNO ---
    // Obtenemos todos los datos, incluyendo el inicio_examen_U1
    $sqlTipo = $conn->prepare("SELECT tipo_examen_U1, calf_1, examen_U1, inicio_examen_U1 FROM alumnos_calificacion WHERE id_usuario = ?");
    $sqlTipo->bind_param("i", $id_usuario);
    $sqlTipo->execute();
    $resTipo = $sqlTipo->get_result();
    $row = $resTipo->fetch_assoc();
    
    $examenYaRealizado = ($row && $row['examen_U1'] == 1);
    $inicio_examen_db = $row ? $row['inicio_examen_U1'] : null;

// --- 2. CARGAR TEXTOS ---
define('ROOT_PATH', dirname(__DIR__, 4));
$idioma = $_SESSION['idioma'] ?? 'es';
$rutaArchivo = ROOT_PATH . "/assets/lang/lang_{$idioma}.json"; // <-- Faltaba
if (!file_exists($rutaArchivo)) { // <-- Faltaba
    $rutaArchivo = ROOT_PATH . "/assets/lang/lang_es.json"; // <-- Faltaba
}
$textos = json_decode(file_get_contents($rutaArchivo), true);


    // --- 3. VERIFICACIONES PREVIAS (SI NO SE HA ENVIADO) ---
    if (!$examen_enviado) {
        
        // 3.1. ¿Ya lo completó?
        if ($examenYaRealizado) {
            echo "<!DOCTYPE html>...</html>"; // Tu HTML de "Examen Completado"
            exit;
        }
// 3.2. ¿Está dentro de las fechas?
$stmt_fechas = $conn->prepare("SELECT fecha_disponible, fecha_limite FROM examen_unidad WHERE id_unidad = ?");
$stmt_fechas->bind_param("i", $id_unidad_actual); // <-- Faltaba
$stmt_fechas->execute(); // <-- Faltaba
$examen_info = $stmt_fechas->get_result()->fetch_assoc();
$stmt_fechas->close();

        $mensajeError = '';
        $iconoError = 'bi-x-circle-fill';

        if (!$examen_info || is_null($examen_info['fecha_disponible']) || is_null($examen_info['fecha_limite'])) {
            $mensajeError = 'Las fechas para este examen no han sido configuradas...';
        } else {
            $ahora = new DateTime("now", $zonaHorariaLocal);
            $inicio = new DateTime($examen_info['fecha_disponible'], $zonaHorariaLocal);
            $fin = new DateTime($examen_info['fecha_limite'], $zonaHorariaLocal);

            if ($ahora < $inicio) {
                $mensajeError = 'El examen aún no está disponible...';
                $iconoError = 'bi-calendar-x-fill';
            
            // --- CORRECCIÓN DE LÓGICA ---
            // Si la fecha ya pasó, solo bloqueamos si NUNCA ha iniciado el examen
            } elseif ($ahora > $fin) {
                if (is_null($inicio_examen_db)) { // <-- CAMBIO: Se checa la DB, no la sesión
                    $mensajeError = 'El periodo para presentar este examen ha finalizado...';
                    $iconoError = 'bi-calendar-x-fill';
                }
                // Si $inicio_examen_db NO es null, significa que empezó a tiempo.
                // La lógica del temporizador de 10 min se encargará.
            }
        }

        if (!empty($mensajeError)) {
            echo "<!DOCTYPE html>...</html>"; // Tu HTML de "Acceso Denegado"
            exit;
        }
    }

    // --- 4. ASEGURAR EXISTENCIA DE FILA Y GRUPO ---
    // (Esta lógica se movió aquí para asegurar que la fila exista ANTES del temporizador)
    if ($row) {
        $grupo = $row['tipo_examen_U1'];
        if (is_null($grupo)) {
            $grupo = rand(1, 3);
            $up = $conn->prepare("UPDATE alumnos_calificacion SET tipo_examen_U1 = ? WHERE id_usuario = ?");
            $up->bind_param("ii", $grupo, $id_usuario);
            $up->execute();
        }
        if ($examenYaRealizado) { 
            $puntos_totales = $row['calf_1'];
        }
    } else {
        // El registro no existe, hay que crearlo.
        $grupo = rand(1, 3);
        $in = $conn->prepare("INSERT INTO alumnos_calificacion (id_usuario, tipo_examen_U1) VALUES (?, ?)");
        $in->bind_param("ii", $id_usuario, $grupo);
        $in->execute();
        // $row sigue siendo null/vacío aquí, $inicio_examen_db es null.
        // La lógica del temporizador (siguiente paso) se encargará de poner la fecha de inicio.
    }


    // --- 5. LÓGICA DEL TEMPORIZADOR (BASADA EN DB) ---
    // (Reemplaza toda la lógica de $_SESSION['inicio_examen_U1'])
    
    $limite = 10 * 60; // 10 minutos
    $tiempo_restante = $limite; 
    $tiempo_inicio_ts = null;

    if ($inicio_examen_db) {
        // El examen ya se había iniciado. Calcular tiempo restante.
        $inicio = new DateTime($inicio_examen_db, $zonaHorariaLocal);
        $tiempo_inicio_ts = $inicio->getTimestamp();
        $tiempo_restante = $limite - (time() - $tiempo_inicio_ts);
        
    } elseif (!$examen_enviado) {
        // Es la primera vez que carga el examen (y no es un envío).
        // Establecer la hora de inicio EN LA BASE DE DATOS.
        $ahora_sql = (new DateTime("now", $zonaHorariaLocal))->format('Y-m-d H:i:s');
        
        $stmt_set_start = $conn->prepare("UPDATE alumnos_calificacion SET inicio_examen_U1 = ? WHERE id_usuario = ? AND inicio_examen_U1 IS NULL");
        $stmt_set_start->bind_param("si", $ahora_sql, $id_usuario);
        $stmt_set_start->execute();
        $stmt_set_start->close();

        // Seteamos las variables locales para esta carga de página
        $tiempo_inicio_ts = time();
        $tiempo_restante = $limite;
    }
    // Si es un envío ($examen_enviado), no necesitamos calcular el tiempo, solo procesar.


    // --- 6. MANEJO DE TIMEOUT ---
    if ($tiempo_restante <= 0 && !$examen_enviado) {
        
        $puntos_totales_timeout = 0; 

        // Asegurarse que solo corra si el examen no se ha marcado como enviado (examen_U1 = 0)
        $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_1 = ?, examen_U1 = 1 WHERE id_usuario = ? AND examen_U1 = 0");
        $guardar->bind_param("ii", $puntos_totales_timeout, $id_usuario);
        $guardar->execute();

        // unset($_SESSION['inicio_examen_U1']); // <-- ELIMINADO (Ya no se usa la sesión)
        
        echo "<script>alert('Tu tiempo ha terminado. Tu examen ha sido enviado automáticamente.'); window.location.href='../../index_alumnos.php';</script>";
        exit;
    }

    // --- 7. PROCESAR EXAMEN ENVIADO ---
    if ($examen_enviado && $puntos_totales === null) {
        $puntos_totales = 0;
 // --- 7. PROCESAR EXAMEN ENVIADO ---
// ...
foreach ($_POST as $key => $id_respuesta) {
    if (strpos($key, 'pregunta_') === 0 && is_numeric($id_respuesta)) {
        // --- INICIO DE CÓDIGO RESTAURADO ---
        $ver = $conn->prepare("SELECT correcto FROM examen_respuesta WHERE id_respuesta = ?");
        $ver->bind_param("i", $id_respuesta);
        $ver->execute();
        $rs = $ver->get_result();
        $resp_data = $rs->fetch_assoc();
        // --- FIN DE CÓDIGO RESTAURADO ---
        
        if ($resp_data && $resp_data['correcto']) {
            $puntos_totales += 20; 
        }
    }
}
// ...

        $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_1 = ?, examen_U1 = 1 WHERE id_usuario = ?");
        $guardar->bind_param("ii", $puntos_totales, $id_usuario);
        $guardar->execute();
        
        // unset($_SESSION['inicio_examen_U1']); // <-- ELIMINADO (Ya no se usa la sesión)
    }
// --- 8. OBTENER PREGUNTAS Y MOSTRAR HTML ---
$offset = ($grupo - 1) * 5;
// --- INICIO DE CÓDIGO RESTAURADO ---
$stmt = $conn->prepare("SELECT * FROM examen_pregunta WHERE id_examen = ? LIMIT 5 OFFSET ?");
$stmt->bind_param("ii", $id_examen, $offset);
$stmt->execute();
// --- FIN DE CÓDIGO RESTAURADO ---
$pregs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    shuffle($pregs);
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($idioma) ?>">
<head>
    <meta charset="UTF-8">
    <title>Examen Unidad 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 1.5rem;
        }
        #temporizador {
            font-size: 1.25rem;
            font-weight: 500;
        }
        .pregunta-bloque {
            border: 1px solid #e9ecef;
            border-radius: 0.75rem;
            padding: 1.5rem;
            background-color: #fff;
        }
        .form-check-label {
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
            width: 100%;
        }
        .form-check-input {
             margin-top: 0.7em;
        }
        .form-check-input:checked + .form-check-label {
            background-color: #e9f2ff;
            font-weight: 500;
            color: #0d6efd;
        }
        .resultado-final {
            background: linear-gradient(135deg, #28a745, #218838);
        }
        .form-check-label.correcta {
            border: 1px solid #198754;
            background-color: #e9fdef;
            color: #146c43;
            font-weight: bold;
        }
        .form-check-label.incorrecta {
            border: 1px solid #dc3545;
            background-color: #fdefee;
            color: #b02a37;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0 h4"><i class="bi bi-file-earmark-text-fill"></i> Examen Unidad 1 - Grupo <?= htmlspecialchars($grupo ?? 'N/A') ?></h4>
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
                foreach ($pregs as $i => $pregunta) {
                    $id_pregunta = $pregunta['id_pregunta'];
                    $texto_pregunta = $textos[$pregunta['pregunta']] ?? $pregunta['pregunta'];

                    echo "<div class='pregunta-bloque mb-4'><p class='fw-bold fs-5'>" . ($i + 1) . ". " . htmlspecialchars($texto_pregunta) . "</p>";

                    $stmtResp = $conn->prepare("SELECT * FROM examen_respuesta WHERE id_pregunta = ?");
                    $stmtResp->bind_param("i", $id_pregunta);
                    $stmtResp->execute();
                    $resps = $stmtResp->get_result()->fetch_all(MYSQLI_ASSOC);

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

        const minutos = Math.floor(tiempoRestante / 60).toString().padStart(2, '0');
        const segundos = (tiempoRestante % 60).toString().padStart(2, '0');
        temporizadorEl.textContent = `${minutos}:${segundos}`;
        
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
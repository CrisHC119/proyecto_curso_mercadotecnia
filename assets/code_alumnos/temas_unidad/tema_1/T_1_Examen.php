<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../../../modelo/conexion.php'; // Asegúrate que la ruta a tu conexión es correcta.

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    die("Acceso denegado: Usuario no identificado.");
}

$id_examen = 1;
$puntos_totales = null;

if (!isset($_SESSION['inicio_examen_U1'])) {
    $_SESSION['inicio_examen_U1'] = time();
}
$limite = 10 * 60; // 10 minutos
$tiempo_restante = $limite - (time() - $_SESSION['inicio_examen_U1']);
if ($tiempo_restante <= 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    unset($_SESSION['inicio_examen_U1']);
    echo "<script>alert('Tu tiempo ha terminado.'); window.location.href='../index_alumnos.php';</script>";
    exit;
}

define('ROOT_PATH', dirname(__DIR__, 4));
$idioma = $_SESSION['idioma'] ?? 'es';
$rutaArchivo = ROOT_PATH . "/assets/lang/lang_{$idioma}.json";
if (!file_exists($rutaArchivo)) {
    $rutaArchivo = ROOT_PATH . "/assets/lang/lang_es.json"; // Fallback a español
}
$textos = json_decode(file_get_contents($rutaArchivo), true);

$sqlTipo = $conn->prepare("SELECT tipo_examen_U1, calf_1, examen_U1 FROM alumnos_calificacion WHERE id_usuario = ?");
$sqlTipo->bind_param("i", $id_usuario);
$sqlTipo->execute();
$resTipo = $sqlTipo->get_result();
$row = $resTipo->fetch_assoc();

$examen_enviado = $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST);

if ($row && $row['examen_U1'] == 1 && !$examen_enviado) {
    echo "<!DOCTYPE html><html lang='{$idioma}'><head><meta charset='UTF-8'><title>Examen Completado</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'><style>body{background-color:#f0f2f5; display:flex; justify-content:center; align-items:center; height:100vh;}.card{border:none; border-radius:15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);}</style></head><body><div class='card text-center p-4 p-md-5'><div class='card-body'><h4 class='card-title mb-3'>✅ ¡Examen Completado!</h4><p class='card-text'>Ya has presentado este examen y tu calificación ha sido registrada.</p><a href='../../index_alumnos.php' class='btn btn-primary mt-3'>Volver al Inicio</a></div></div></body></html>";
    exit;
}

if ($row) {
    $grupo = $row['tipo_examen_U1'];
    if (is_null($grupo)) {
        $grupo = rand(1, 3);
        $up = $conn->prepare("UPDATE alumnos_calificacion SET tipo_examen_U1 = ? WHERE id_usuario = ?");
        $up->bind_param("ii", $grupo, $id_usuario);
        $up->execute();
    }
    if ($row['examen_U1'] == 1) {
        $puntos_totales = $row['calf_1'];
    }
} else {
    $grupo = rand(1, 3);
    $in = $conn->prepare("INSERT INTO alumnos_calificacion (id_usuario, tipo_examen_U1) VALUES (?, ?)");
    $in->bind_param("ii", $id_usuario, $grupo);
    $in->execute();
}

if ($examen_enviado && $puntos_totales === null) {
    $puntos_totales = 0;
    foreach ($_POST as $key => $id_respuesta) {
        if (strpos($key, 'pregunta_') === 0 && is_numeric($id_respuesta)) {
            $ver = $conn->prepare("SELECT correcto FROM examen_respuesta WHERE id_respuesta = ?");
            $ver->bind_param("i", $id_respuesta);
            $ver->execute();
            $rs = $ver->get_result();
            if ($rs->fetch_assoc()['correcto']) {
                $puntos_totales += 20;
            }
        }
    }

    $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_1 = ?, examen_U1 = 1 WHERE id_usuario = ?");
    $guardar->bind_param("ii", $puntos_totales, $id_usuario);
    $guardar->execute();
    unset($_SESSION['inicio_examen_U1']); // Limpiar timer al enviar.
}

$offset = ($grupo - 1) * 5;
$stmt = $conn->prepare("SELECT * FROM examen_pregunta WHERE id_examen = ? LIMIT 5 OFFSET ?");
$stmt->bind_param("ii", $id_examen, $offset);
$stmt->execute();
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
        }
        .form-check-input:checked + .form-check-label {
            background-color: #e9f2ff;
            font-weight: 500;
            color: #0d6efd;
        }
        .resultado-final {
            background: linear-gradient(135deg, #28a745, #218838);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0 h4"><i class="bi bi-file-earmark-text-fill"></i> Examen Unidad 1 - Grupo <?= htmlspecialchars($grupo) ?></h4>
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
                                $clase_label = 'text-success fw-bold'; // Respuesta correcta
                            } elseif ($id_respuesta == $seleccionada) {
                                $clase_label = 'text-danger'; // Selección incorrecta del usuario
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

    function actualizarTemporizador() {
        if (tiempoRestante <= 0) {
            temporizadorEl.textContent = '00:00';
            alert("El tiempo ha terminado. El examen se enviará automáticamente.");
            document.getElementById('form-examen').submit();
            return;
        }

        const minutos = Math.floor(tiempoRestante / 60).toString().padStart(2, '0');
        const segundos = (tiempoRestante % 60).toString().padStart(2, '0');
        temporizadorEl.textContent = `${minutos}:${segundos}`;
        
        tiempoRestante--;
        setTimeout(actualizarTemporizador, 1000);
    }
    
    window.onload = actualizarTemporizador;
    <?php endif; ?>
</script>
</body>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../../../modelo/conexion.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) die("Usuario no identificado.");

$id_unidad = 1;
$id_examen = 1;
$puntos_totales = null; // usado para mostrar después

// 1. CONTROL DE TIEMPO
if (!isset($_SESSION['inicio_examen_U1'])) {
    $_SESSION['inicio_examen_U1'] = time();
}
$limite = 10 * 60;
$tiempo_restante = $limite - (time() - $_SESSION['inicio_examen_U1']);
if ($tiempo_restante <= 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Tiempo agotado.'); window.location.href='fin_examen.php';</script>";
    exit;
}

// 2. IDIOMA
$idiomas = ['es' => 'Español', 'en' => 'English'];
$idioma = $_SESSION['idioma'] ?? 'es';
if (isset($_GET['lang']) && in_array($_GET['lang'], $idiomas)) {
    $_SESSION['idioma'] = $_GET['lang'];
    $idioma = $_GET['lang'];
}
$rutaArchivo = __DIR__ . "/../../../../lang/lang_{$idioma}.json";
if (!file_exists($rutaArchivo)) {
    $rutaArchivo = __DIR__ . "/../../../../lang/lang_es.json";
}
$textos = json_decode(file_get_contents($rutaArchivo), true);

// 3. VERIFICAR O CREAR GRUPO DE EXAMEN
$sqlTipo = $conn->prepare("SELECT tipo_examen_U1, calf_1, examen_U1 FROM alumnos_calificacion WHERE id_usuario = ?");
$sqlTipo->bind_param("i", $id_usuario);
$sqlTipo->execute();
$resTipo = $sqlTipo->get_result();
$calificacion_existente = null;

$row = $resTipo->fetch_assoc();

$examen_enviado = $_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0;

if ($row) {
    if (!$examen_enviado && $row['examen_U1'] == 1) {
        echo "<!DOCTYPE html>
        <html lang='{$idioma}'><head>
        <meta charset='UTF-8'>
        <title>Examen Completado</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head><body class='bg-light'>
        <div class='container py-5'>
          <div class='alert alert-info text-center'>
            <h4 class='mb-3'>✅ Examen ya realizado</h4>
            <p>Este examen ya fue enviado y no se puede volver a presentar.</p>
            <a href='../index_alumnos.php' class='btn btn-primary mt-3'>Regresar</a>
          </div>
        </div>
        </body></html>";
        exit;
    }

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
    // No hay registro aún, lo creamos
    $grupo = rand(1, 3);
    $in = $conn->prepare("INSERT INTO alumnos_calificacion (id_usuario, tipo_examen_U1) VALUES (?, ?)");
    $in->bind_param("ii", $id_usuario, $grupo);
    $in->execute();
}

$offset = ($grupo - 1) * 5;
$limit = 5;

// === GUARDAR RESPUESTAS ===
$examen_enviado = $_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0;

if ($examen_enviado && $puntos_totales === null) {
    $puntos_totales = 0;
    foreach ($_POST as $key => $id_respuesta) {
        if (strpos($key, 'pregunta_') === 0) {
            $id_pregunta = str_replace('pregunta_', '', $key);

            // Ya no usamos tabla examen_alumno_responde, así que
            // eliminamos esta parte que accedía a ella.

            // Solo verificamos si la respuesta es correcta
            $ver = $conn->prepare("SELECT correcto FROM examen_respuesta WHERE id_respuesta = ?");
            $ver->bind_param("i", $id_respuesta);
            $ver->execute();
            $rs = $ver->get_result();
            if ($rs->fetch_assoc()['correcto']) {
                $puntos_totales += 20;
            }
        }
    }

    // Guardar calificación en alumnos_calificacion
    $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_1 = ?, examen_U1 = 1 WHERE id_usuario = ?");
    $guardar->bind_param("ii", $puntos_totales, $id_usuario);
    $guardar->execute();
}

// CARGAR PREGUNTAS DEL GRUPO CORRECTO
$stmt = $conn->prepare("SELECT * FROM examen_pregunta WHERE id_examen = ? LIMIT 5 OFFSET ?");
$stmt->bind_param("ii", $id_examen, $offset);
$stmt->execute();
$pregs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
  <meta charset="UTF-8">
  <title>Examen Unidad 1</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
  let tiempo = <?= $tiempo_restante ?>;
  <?php if ($puntos_totales === null): ?>
  function actualizarTemporizador() {
    const min = Math.floor(tiempo / 60);
    const seg = tiempo % 60;
    document.getElementById('temporizador').textContent = `${min.toString().padStart(2, '0')}:${seg.toString().padStart(2, '0')}`;
    if (tiempo <= 0) {
      alert("Tiempo agotado");
      window.location.href = "../index_alumnos.php";
    } else {
      tiempo--;
      setTimeout(actualizarTemporizador, 1000);
    }
  }
  window.onload = actualizarTemporizador;
  <?php endif; ?>
</script>
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card p-4 shadow">
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Examen Unidad 1 - Grupo <?= $grupo ?></h4>
  <?php if ($puntos_totales === null): ?>
    <span id="temporizador" class="badge bg-danger fs-5"></span>
  <?php endif; ?>
</div>

    <form method="POST" id="form-examen">
    <?php
    foreach ($pregs as $i => $pregunta) {
        $id_pregunta = $pregunta['id_pregunta'];
        $texto = $textos[$pregunta['pregunta']] ?? $pregunta['pregunta'];
        echo "<div class='mb-4'><p class='fw-bold'>" . ($i+1) . ". $texto</p>";
        $stmtResp = $conn->prepare("SELECT * FROM examen_respuesta WHERE id_pregunta = ?");
        $stmtResp->bind_param("i", $id_pregunta);
        $stmtResp->execute();
        $resps = $stmtResp->get_result()->fetch_all(MYSQLI_ASSOC);

        $seleccionada = $respondidas[$id_pregunta] ?? null;
        foreach ($resps as $resp) {
            $checked = ($resp['id_respuesta'] == $seleccionada) ? 'checked' : '';
            $disabled = ($puntos_totales !== null) ? 'disabled' : '';
            $clase = '';
            if ($puntos_totales !== null) {
                if ($resp['correcto']) $clase = 'text-success';
                elseif ($resp['id_respuesta'] == $seleccionada) $clase = 'text-danger';
                else $clase = 'text-muted';
            }
            $texto_resp = $textos[$resp['respuesta']] ?? $resp['respuesta'];
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='radio' name='pregunta_$id_pregunta' id='r{$resp['id_respuesta']}' value='{$resp['id_respuesta']}' $checked $disabled>";
            echo "<label class='form-check-label $clase' for='r{$resp['id_respuesta']}'>{$texto_resp}</label>";
            echo "</div>";
        }
        echo "</div>";
    }
    ?>
    <?php if ($puntos_totales === null): ?>
      <div class="text-end">
        <button class="btn btn-primary">Enviar Examen</button>
      </div>
    <?php else: ?>
      <div class="alert alert-success text-center">Resultado: <?= $puntos_totales ?> / 100</div>
      <?php if ($puntos_totales !== null): ?>
  <div class="text-center mt-3">
    <a href="../index_alumnos.php" class="btn btn-secondary">Regresar</a>
  </div>
<?php endif; ?>

    <?php endif; ?>
    </form>
  </div>
</div>
</body>
</html>

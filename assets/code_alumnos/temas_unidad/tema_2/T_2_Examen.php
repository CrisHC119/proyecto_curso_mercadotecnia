<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../../../modelo/conexion.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) die("Usuario no identificado.");

// ✅ 1. VARIABLES DE UNIDAD
$id_unidad = 2;
$id_examen = 2; // Asumiendo que el id_examen corresponde al id_unidad
$puntos_totales = null;

// ✅ 2. CONTROL DE TIEMPO (usando sesión para Unidad 2)
if (!isset($_SESSION['inicio_examen_U2'])) {
    $_SESSION['inicio_examen_U2'] = time();
}
$limite = 10 * 60; // 10 minutos
$tiempo_restante = $limite - (time() - $_SESSION['inicio_examen_U2']);
if ($tiempo_restante <= 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    unset($_SESSION['inicio_examen_U2']); // Limpiar timer
    echo "<script>alert('Tiempo agotado.'); window.location.href='../index_alumnos.php';</script>";
    exit;
}

// ✅ 3. IDIOMA (con ruta corregida y robusta)
define('ROOT_PATH', dirname(__DIR__, 4));
$idiomas = ['es' => 'Español', 'en' => 'English'];
$idioma = $_SESSION['idioma'] ?? 'es';
$rutaArchivo = ROOT_PATH . "/assets/lang/lang_{$idioma}.json";
if (!file_exists($rutaArchivo)) {
    $rutaArchivo = ROOT_PATH . "/assets/lang/lang_es.json";
}
$textos = json_decode(file_get_contents($rutaArchivo), true);

// ✅ 4. VERIFICAR GRUPO DE EXAMEN (usando columnas para Unidad 2)
$sqlTipo = $conn->prepare("SELECT tipo_examen_U2, calf_2, examen_U2 FROM alumnos_calificacion WHERE id_usuario = ?");
$sqlTipo->bind_param("i", $id_usuario);
$sqlTipo->execute();
$resTipo = $sqlTipo->get_result();
$row = $resTipo->fetch_assoc();

$examen_enviado = $_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0;

if ($row) {
    // Si el examen ya fue enviado previamente
    if (!$examen_enviado && $row['examen_U2'] == 1) {
        echo "<!DOCTYPE html><html lang='{$idioma}'><head><meta charset='UTF-8'><title>Examen Completado</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light'><div class='container py-5'><div class='alert alert-info text-center'><h4 class='mb-3'>✅ Examen ya realizado</h4><p>Este examen ya fue enviado y no se puede volver a presentar.</p><a href='../index_alumnos.php' class='btn btn-primary mt-3'>Regresar</a></div></div></body></html>";
        exit;
    }

    $grupo = $row['tipo_examen_U2'];
    if (is_null($grupo)) {
        $grupo = rand(1, 3);
        $up = $conn->prepare("UPDATE alumnos_calificacion SET tipo_examen_U2 = ? WHERE id_usuario = ?");
        $up->bind_param("ii", $grupo, $id_usuario);
        $up->execute();
    }
    if ($row['examen_U2'] == 1) {
        $puntos_totales = $row['calf_2'];
    }
} else {
    // Si no hay registro para el alumno, se crea uno nuevo
    $grupo = rand(1, 3);
    $in = $conn->prepare("INSERT INTO alumnos_calificacion (id_usuario, tipo_examen_U2) VALUES (?, ?)");
    $in->bind_param("ii", $id_usuario, $grupo);
    $in->execute();
}

$offset = ($grupo - 1) * 5;

// ✅ 5. GUARDAR RESPUESTAS (usando columnas para Unidad 2)
if ($examen_enviado && $puntos_totales === null) {
    $puntos_totales = 0;
    foreach ($_POST as $key => $id_respuesta) {
        if (strpos($key, 'pregunta_') === 0) {
            $ver = $conn->prepare("SELECT correcto FROM examen_respuesta WHERE id_respuesta = ?");
            $ver->bind_param("i", $id_respuesta);
            $ver->execute();
            $rs = $ver->get_result();
            if ($rs->fetch_assoc()['correcto']) {
                $puntos_totales += 20;
            }
        }
    }

    $guardar = $conn->prepare("UPDATE alumnos_calificacion SET calf_2 = ?, examen_U2 = 1 WHERE id_usuario = ?");
    $guardar->bind_param("ii", $puntos_totales, $id_usuario);
    $guardar->execute();
    unset($_SESSION['inicio_examen_U2']); // Limpiar el timer al enviar
}

// 6. CARGAR PREGUNTAS (usa la variable $id_examen que ahora es 2)
$stmt = $conn->prepare("SELECT * FROM examen_pregunta WHERE id_examen = ? LIMIT 5 OFFSET ?");
$stmt->bind_param("ii", $id_examen, $offset);
$stmt->execute();
$pregs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
  <meta charset="UTF-8">
  <title>Examen Unidad 2</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
  let tiempo = <?= $tiempo_restante ?>;
  <?php if ($puntos_totales === null): ?>
  function actualizarTemporizador() {
    const min = Math.floor(tiempo / 60);
    const seg = tiempo % 60;
    const temporizadorEl = document.getElementById('temporizador');
    if (temporizadorEl) {
        temporizadorEl.textContent = `${min.toString().padStart(2, '0')}:${seg.toString().padStart(2, '0')}`;
    }
    
    if (tiempo <= 0) {
      alert("Tiempo agotado. El examen se enviará automáticamente.");
      document.getElementById('form-examen').submit();
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
      <h4>Examen Unidad 2 - Grupo <?= $grupo ?></h4>
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

        // ✅ 8. CORRECCIÓN DE LÓGICA (para mostrar respuestas del usuario)
        $seleccionada = $_POST['pregunta_'.$id_pregunta] ?? null;

        foreach ($resps as $resp) {
            $checked = ($resp['id_respuesta'] == $seleccionada) ? 'checked' : '';
            $disabled = ($puntos_totales !== null) ? 'disabled' : '';
            $clase = '';
            if ($puntos_totales !== null) {
                if ($resp['correcto']) $clase = 'text-success fw-bold';
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
      <div class="alert alert-success text-center"><h3>Resultado: <?= $puntos_totales ?> / 100</h3></div>
      <div class="text-center mt-3">
        <a href="../index_alumnos.php" class="btn btn-secondary">Regresar</a>
      </div>
    <?php endif; ?>
    </form>
  </div>
</div>
</body>
</html>
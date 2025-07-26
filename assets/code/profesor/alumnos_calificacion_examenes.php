<?php
require_once '../modelo/conexion.php';
$unidad = isset($_GET['unidad']) ? intval($_GET['unidad']) : 0;
if ($unidad < 1 || $unidad > 5) {
    die("Unidad inválida.");
}
date_default_timezone_set('America/Monterrey');

$campoCalf = "calf_" . $unidad;
$campoExamen = "examen_U" . $unidad;

// Manejo de repetición de examen si se pasa un parámetro repetir_id
if (isset($_GET['repetir_id'])) {
    $repetir_id = intval($_GET['repetir_id']);

    // Obtener nombre del alumno para mostrar en el toast
    $stmtNom = $conn->prepare("SELECT U.nombres, U.apellido_paterno, U.apellido_materno 
                               FROM usuarios U 
                               WHERE U.id_usuario = ?");
    $stmtNom->bind_param("i", $repetir_id);
    $stmtNom->execute();
    $resultNom = $stmtNom->get_result();
    $nombreAlumno = '';
    if ($rowNom = $resultNom->fetch_assoc()) {
        $nombreAlumno = $rowNom['nombres'] . ' ' . $rowNom['apellido_paterno'] . ' ' . $rowNom['apellido_materno'];
    }
    $stmtNom->close();

    $stmt = $conn->prepare("UPDATE alumnos_calificacion SET $campoExamen = 0 WHERE id_usuario = ?");
    $stmt->bind_param("i", $repetir_id);
    $stmt->execute();
    $stmt->close();

    // Redirigir pasando el nombre del alumno codificado en URL
    header("Location: " . basename(__FILE__) . "?unidad=$unidad&mensaje=ok&alumno=" . urlencode($nombreAlumno));
    exit;
}
// Verificar si alguna fecha de examen ya pasó o es NULL
// Cambiar la consulta para que sólo revise la unidad actual:
$mostrarRecordatorioFecha = false;

// Sólo mostrar aviso si no estamos recién redirigiendo por segunda oportunidad
if (!isset($_GET['repetir_id'])) {
    $sqlFecha = "SELECT COUNT(*) AS total FROM examen_unidad WHERE (fecha_disponible IS NULL OR fecha_disponible <= NOW()) AND id_examen = ?";
    $stmtFecha = $conn->prepare($sqlFecha);
    $stmtFecha->bind_param("i", $unidad);
    $stmtFecha->execute();
    $resultFecha = $stmtFecha->get_result();

    if ($resultFecha) {
        $rowFecha = $resultFecha->fetch_assoc();
        if (intval($rowFecha['total']) > 0) {
            $mostrarRecordatorioFecha = true;
        }
    }
    $stmtFecha->close();
}
include_once __DIR__ . '/code/navbar_profesor.php';

$sql = "SELECT 
            A.id_usuario,
            A.nocontrol,
            U.nombres, U.apellido_paterno, U.apellido_materno,
            AC.$campoCalf AS calificacion,
            AC.$campoExamen AS examen_realizado
        FROM alumnos A
        INNER JOIN usuarios U ON A.id_usuario = U.id_usuario
        LEFT JOIN alumnos_calificacion AC ON A.id_usuario = AC.id_usuario
        ORDER BY U.apellido_paterno, U.nombres";

$result = $conn->query($sql);
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
$alumnoToast = isset($_GET['alumno']) ? htmlspecialchars(urldecode($_GET['alumno'])) : '';

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calificaciones Examen Unidad <?= $unidad ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    body.dark-mode {
      background-color: #1e1e1e;
      color: #f1f1f1;
    }

    .card {
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    body.dark-mode .card {
      background-color: #2c2c2c;
      color: #fff;
    }

    .table th, .table td {
      vertical-align: middle;
    }

    .badge-realizado {
      background-color: #28a745;
    }

    .badge-reprobado {
      background-color: #dc3545;
    }

    .badge-no {
      background-color: #6c757d;
    }

    body.dark-mode .table {
      background-color: #2b2b2b;
      color: #fff;
    }

    body.dark-mode .table th,
    body.dark-mode .table td {
      border-color: #555;
    }

    body.dark-mode .table-primary {
      background-color: #444;
      color: #fff;
    }

    .btn-repetir {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="card p-4">
    <h2 class="mb-4 text-center text-primary">📘 Calificaciones - Examen Unidad <?= $unidad ?></h2>
    
    <div class="table-responsive">
      <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>Alumno</th>
            <th>No. de Control</th>
            <th>Calificación</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows === 0) {
              echo "<tr><td colspan='6' class='text-center'>No hay alumnos registrados.</td></tr>";
          } else {
              $contador = 1;
              while ($row = $result->fetch_assoc()) {
                  $nombre = htmlspecialchars($row['nombres'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno']);
                  $nocontrol = htmlspecialchars($row['nocontrol'] ?? 'N/A');
                  $examenRealizado = intval($row['examen_realizado'] ?? 0);
                  $calificacion = $row['calificacion'];
                  $id_usuario = intval($row['id_usuario']);

                  if ($examenRealizado && is_numeric($calificacion)) {
                      $calif = htmlspecialchars($calificacion) . " / 100";
                      if ($calificacion >= 70) {
                          $estado = "<span class='badge badge-realizado text-white'>Realizado</span>";
                      } else {
                          $estado = "<span class='badge badge-reprobado text-white'>Reprobado</span>";
                      }
$acciones = "<a href='" . basename(__FILE__) . "?unidad={$unidad}&repetir_id={$id_usuario}&mensaje=ok' class='btn btn-sm btn-outline-warning btn-repetir'>Repetir Examen</a>";

                  } else {
                      $calif = "—";
                      $estado = "<span class='badge badge-no text-white'>No realizado</span>";
                      $acciones = "—";
                  }

                  echo "<tr>
                          <td>{$contador}</td>
                          <td>{$nombre}</td>
                          <td>{$nocontrol}</td>
                          <td>{$calif}</td>
                          <td>{$estado}</td>
                          <td>{$acciones}</td>
                        </tr>";
                  $contador++;
              }
          }
          ?>
        </tbody>
      </table>
    </div>
    
    <div class="text-center mt-4">
      <a href="examenes.php" class="btn btn-outline-secondary">⬅ Regresar</a>
    </div>
  </div>
</div>
<?php if ($mostrarRecordatorioFecha): ?>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
  <div id="toastRecordatorioFecha" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        ⚠️ Recuerde actualizar la fecha disponible de los exámenes, hay uno o más con fecha pasada o sin fecha asignada.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>
<?php endif; ?>
<!-- Toast de éxito -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
  <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">
        ✅ El examen fue habilitado nuevamente con éxito.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('mensaje') === 'ok') {
    const alumno = urlParams.get('alumno') || '';
    console.log("Nombre alumno recibido en JS:", alumno);
    const toastBody = document.getElementById('toastBody');
    if (alumno) {
      toastBody.textContent = `✅ El examen fue habilitado nuevamente para: ${decodeURIComponent(alumno)}`;
    }
    const toastElement = document.getElementById('toastExito');
    const toast = new bootstrap.Toast(toastElement, { delay: 4000 });
    toast.show();
  }
});
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($mostrarRecordatorioFecha): ?>
    const toastFecha = new bootstrap.Toast(document.getElementById('toastRecordatorioFecha'), { delay: 5000 });
    toastFecha.show();
  <?php endif; ?>
});
</script>

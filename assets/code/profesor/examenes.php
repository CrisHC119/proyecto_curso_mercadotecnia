<?php
include_once __DIR__ . '/code/navbar_profesor.php';
require_once '../modelo/conexion.php';

// Configurar zona horaria a Tamaulipas (America/Monterrey)
date_default_timezone_set('America/Monterrey');

// Obtener fechas de exámenes
$sql = "SELECT id_examen, fecha_disponible FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
$result = $conn->query($sql);
$fechas = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fechas[$row['id_examen']] = $row['fecha_disponible'];
    }
}

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

<style>
  .card-menu {
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #f2f2f2; /* claro por defecto */
    border-radius: 0.75rem;
    color: #333;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.2s ease-in-out;
    width: 100%;
  }

  .card-menu:hover {
    transform: scale(1.01);
  }

  .card-menu i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: #0d6efd; /* azul */
  }

  .card-menu h5 {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .card-menu p {
    margin-bottom: 0.25rem;
  }

  .btn-group-sm .btn {
    padding: 0.4rem 1rem;
    font-size: 0.85rem;
    margin-right: 0.5rem;
  }

  .disabled {
    pointer-events: none;
    opacity: 0.5;
  }

  .card-container {
    max-width: 900px;
    margin: 0 auto;
  }

  .card-menu .btn-primary i {
    color: #fff !important; /* Ícono blanco para fondo azul */
  }

  .card-menu .btn {
    font-size: 1rem;
    font-weight: 500;
  }

  body:not(.light-mode) .card-menu {
    background-color: #2c2c2c;
    color: #fff;
  }

  body:not(.light-mode) .btn-outline-light {
    border-color: #aaa;
    color: #eee;
  }
  body:not(.light-mode) .modal-content {
    background-color: #2b2b2b;
    color: #fff;
  }

  body:not(.light-mode) .form-control {
    background-color: #3c3c3c;
    color: #fff;
    border-color: #666;
  }

  body:not(.light-mode) .form-control::placeholder {
    color: #aaa;
  }

  body:not(.light-mode) .modal-header,
  body:not(.light-mode) .modal-footer {
    border-color: #444;
  }

  .btn-outline-primary:hover .icon-calificaciones {
    color: #fff; /* Blanco o el color que prefieras */
  }

  @media (max-width: 768px) {
    .card-menu {
      padding: 1rem;
    }

    .btn-group-sm .btn {
      font-size: 0.75rem;
      margin-right: 0.25rem;
    }
  }
</style>

<div class="container mt-4 px-2">
  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      ✅ Fecha de examen actualizada con éxito.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  <?php endif; ?>

  <div class="card-container">
    <?php 
    // Obtener total de alumnos solo una vez
    $totalAlumnos = 0;
    $totalRes = $conn->query("SELECT COUNT(*) AS total FROM alumnos");
    if ($totalRes) {
        $totalAlumnos = $totalRes->fetch_assoc()['total'];
    }

    // Contar cuántos realizaron el examen por unidad una sola vez
    $realizados = [];
    for ($u = 1; $u <= 5; $u++) {
        $res = $conn->query("SELECT COUNT(*) AS hechos FROM alumnos_calificacion WHERE examen_U$u = 1");
        $realizados[$u] = ($res && $res->num_rows > 0) ? $res->fetch_assoc()['hechos'] : 0;
    }

    for ($i = 1; $i <= 5; $i++): 
        $fecha = $fechas[$i] ?? null;
        $disabled = ($i !== 1);
    ?>
      <div class="card-menu mb-3 <?php echo $disabled ? 'opacity-50' : ''; ?>">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div>
            <i class="bi bi-journal-text"></i>
            <h5 class="d-inline ms-2">Unidad <?php echo $i; ?></h5>
          </div>
        </div>
        <p class="mb-1">📘 Valor: <strong>100 pts</strong></p>
        <p>📅 Disponible: <?php echo mostrarFecha($fecha); ?></p>
        <p>🧑‍🎓 Completado por: <strong><?php echo $realizados[$i]; ?> de <?php echo $totalAlumnos; ?></strong></p>

        <div class="btn-group btn-group-sm mt-3" role="group">
          <a href="alumnos_calificacion_examenes.php?unidad=<?php echo $i; ?>" 
             class="btn btn-outline-primary <?php echo $disabled ? 'disabled' : ''; ?>">
            <i class="bi bi-people-fill me-1 icon-calificaciones"></i> Ver Calificaciones
          </a>
          <button class="btn btn-primary <?php echo $disabled ? 'disabled' : ''; ?>" 
                  data-bs-toggle="modal" 
                  data-bs-target="#modalFecha" 
                  onclick="prepararModal(<?php echo $i; ?>)">
            <i class="bi bi-calendar-event me-1"></i> Cambiar Fecha
          </button>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFecha" tabindex="-1" aria-labelledby="modalFechaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="../modelo/guardar_fecha_examen.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFechaLabel">Asignar Fecha de Examen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_examen" id="modal_id_examen">
          <label for="fecha_disponible" class="form-label">Selecciona fecha y hora:</label>
          <input type="datetime-local" class="form-control" name="fecha_disponible" id="fecha_disponible" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function prepararModal(id) {
    document.getElementById('modal_id_examen').value = id;

    const input = document.getElementById('fecha_disponible');
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    const localISOTime = now.toISOString().slice(0, 16);
    input.min = localISOTime;
    input.value = localISOTime;
  }
</script>

<?php include_once __DIR__ . '/../footer.php'; ?>
</body>
</html>

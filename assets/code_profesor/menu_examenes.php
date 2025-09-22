<?php
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/styles/style_menu_examenes.php';
    include_once __DIR__ . '/scripts/script_mostrar_fecha.php';
    require_once '../modelo/conexion.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    date_default_timezone_set('America/Monterrey');

    // Verifica las fechas del examen
    $sql = "SELECT id_examen, fecha_disponible FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
    $result = $conn->query($sql);
    $fechas = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fechas[$row['id_examen']] = $row['fecha_disponible'];
        }
    }
?>


<div class="container mt-4 px-2">
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ <?php echo $textos['actualizar_fecha_examen_exito']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>
    <div class="card-container">
    <?php 
        $totalAlumnos = 0;
        $totalRes = $conn->query("SELECT COUNT(*) AS total FROM alumnos");
        if ($totalRes) {
            $totalAlumnos = $totalRes->fetch_assoc()['total'];
        }
        $realizados = [];
        for ($u = 1; $u <= 5; $u++) {
            $res = $conn->query("SELECT COUNT(*) AS hechos FROM alumnos_calificacion WHERE examen_U$u = 1");
            $realizados[$u] = ($res && $res->num_rows > 0) ? $res->fetch_assoc()['hechos'] : 0;
        }
        for ($i = 1; $i <= 5; $i++): 
            $fecha = $fechas[$i] ?? null;
            $disabled = false;
    ?>
    <div class="card-menu mb-3 <?php echo $disabled ? 'opacity-50' : ''; ?>">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <i class="bi bi-journal-text"></i>
                <h5 class="d-inline ms-2"><?php echo $textos['unidad']; ?> <?php echo $i; ?></h5>
            </div>
        </div>
        <p class="mb-1">📘 <?php echo $textos['valor']; ?> <strong>100 pts</strong></p>
        <p>📅 <?php echo $textos['disponible']; ?> <?php echo mostrarFecha($fecha); ?></p>
        <p>🧑‍🎓 <?php echo $textos['completado_por']; ?> <strong><?php echo $realizados[$i]; ?> <?php echo $textos['de']; ?> <?php echo $totalAlumnos; ?></strong></p>
        <div class="btn-group btn-group-sm mt-3" role="group">
            <a href="alumnos_calificacion_examenes.php?unidad=<?php echo $i; ?>" 
                class="btn btn-outline-primary <?php echo $disabled ? 'disabled' : ''; ?>">
                <i class="bi bi-people-fill me-1 icon-calificaciones"></i>  <?php echo $textos['ver_calificaciones']; ?> 
            </a>
            <a href="alumnos_calificacion_examenes.php?unidad=<?php echo $i; ?>" 
                class="btn btn-outline-primary <?php echo $disabled ? 'disabled' : ''; ?>">
                <i class="bi bi-book me-1 icon-calificaciones"></i> <?php echo $textos['modificar_examen']; ?> 
            </a>
            <button class="btn btn-primary <?php echo $disabled ? 'disabled' : ''; ?>" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalFecha" 
                    onclick="prepararModal(<?php echo $i; ?>)">
                <i class="bi bi-calendar-event me-1"></i> <?php echo $textos['cambiar_fecha']; ?> 
            </button>
        </div>
    </div>
    <?php endfor; ?>
</div>

    <div class="text-center my-4">
        <a href="index_profesor.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i>Volver al menú principal
        </a>
    </div>
    </div>

<div class="modal fade" id="modalFecha" tabindex="-1" aria-labelledby="modalFechaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="../modelo/login_profesor/guardar_fecha_examen.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFechaLabel"><?php echo $textos['asignar_fecha_examen']; ?> </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_examen" id="modal_id_examen">
          <label for="fecha_disponible" class="form-label"><?php echo $textos['seleccionar_fecha_hora']; ?></label>
          <input type="datetime-local" class="form-control" name="fecha_disponible" id="fecha_disponible" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><?php echo $textos['guardar']; ?></button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cancelar']; ?></button>
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
<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
</body>
</html>
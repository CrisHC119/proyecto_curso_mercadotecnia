<?php
    $page_5 = 'active';
    require_once '../modelo/conexion.php';
    $unidad = isset($_GET['unidad']) ? intval($_GET['unidad']) : 0;
    if ($unidad < 1 || $unidad > 5) die("Unidad inválida.");
    date_default_timezone_set('America/Monterrey');
    
    $campoCalf = "calf_" . $unidad;
    $campoExamen = "examen_U" . $unidad;

    // Lógica para repetir examen
    if (isset($_GET['repetir_id'])) {
        $repetir_id = intval($_GET['repetir_id']);
        $nombreAlumno = '';
        
        $stmtNom = $conn->prepare("SELECT U.nombres, U.apellido_paterno FROM usuarios U WHERE U.id_usuario = ?");
        $stmtNom->bind_param("i", $repetir_id);
        $stmtNom->execute();
        $resultNom = $stmtNom->get_result();
        if ($rowNom = $resultNom->fetch_assoc()) {
            $nombreAlumno = $rowNom['nombres'] . ' ' . $rowNom['apellido_paterno'];
        }
        $stmtNom->close();

        // Se reinicia el examen y la calificación a NULL
        $stmt = $conn->prepare("UPDATE alumnos_calificacion SET $campoExamen = 0, $campoCalf = NULL WHERE id_usuario = ?");
        $stmt->bind_param("i", $repetir_id);
        $stmt->execute();
        $stmt->close();
        
        header("Location: " . basename(__FILE__) . "?unidad=$unidad&mensaje=ok&alumno=" . urlencode($nombreAlumno));
        exit;
    }

    include_once __DIR__ . '/code_general/navbar.php';

    // Consulta principal de alumnos
    $sql = "SELECT 
                A.id_usuario, A.nocontrol, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar,
                AC.$campoCalf AS calificacion, AC.$campoExamen AS examen_realizado
            FROM alumnos A
            INNER JOIN usuarios U ON A.id_usuario = U.id_usuario
            LEFT JOIN alumnos_calificacion AC ON A.id_usuario = AC.id_usuario
            ORDER BY U.apellido_paterno, U.apellido_materno, U.nombres";
    $result = $conn->query($sql);
    if (!$result) die("Error en la consulta: " . $conn->error);
    
    $alumnoToast = isset($_GET['alumno']) ? htmlspecialchars(urldecode($_GET['alumno'])) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones - Unidad <?= $unidad ?></title>
    <?php
        include_once __DIR__ . '/styles/style_calificacion_alumnos.php';
    ?>
</head>
<body class="d-flex flex-column min-vh-100">

<main class="flex-fill">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">📘 Calificaciones - Unidad <?= $unidad ?></h1>
            <a href="menu_examenes.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Regresar al Menú
            </a>
        </div>
        
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="buscador" class="form-control" placeholder="Buscar por nombre o número de control...">
                    </div>
                </div>

                <div class="list-group">
                    <?php if ($result->num_rows === 0): ?>
                        <div class="alert alert-info text-center">No hay alumnos registrados.</div>
                    <?php else: ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php
                            $nombre = htmlspecialchars($row['nombres'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno']);
                            $nocontrol = htmlspecialchars($row['nocontrol'] ?? 'N/A');
                            $examenRealizado = intval($row['examen_realizado'] ?? 0);
                            $calificacion = $row['calificacion'];
                            $id_usuario = intval($row['id_usuario']);

                            $badgeClass = 'bg-secondary';
                            $estadoTexto = 'No realizado';
                            $califTexto = "—";

                            if ($examenRealizado && is_numeric($calificacion)) {
                                $califTexto = "<strong>" . htmlspecialchars($calificacion) . "</strong> / 100";
                                if ($calificacion >= 70) {
                                    $badgeClass = 'bg-success';
                                    $estadoTexto = 'Aprobado';
                                } else {
                                    $badgeClass = 'bg-danger';
                                    $estadoTexto = 'Reprobado';
                                }
                            }
                            ?>
                            <div class="list-group-item list-group-item-calif alumno-item">
                                <img src="/assets/images/avatar/<?= htmlspecialchars($row['avatar']) ?>" alt="Avatar" class="rounded-circle avatar-calif">
                                <div class="info-alumno">
                                    <h5 class="mb-0"><?= $nombre ?></h5>
                                    <small class="text-body-secondary">No. Control: <?= $nocontrol ?></small>
                                </div>
                                <div class="calif-estado">
                                    <div class="calificacion-valor"><?= $califTexto ?></div>
                                    <span class="badge rounded-pill <?= $badgeClass ?>"><?= $estadoTexto ?></span>
                                </div>
                                <div class="acciones-calif">
                                    <?php if ($examenRealizado): ?>
                                        <a href="<?= basename(__FILE__) ?>?unidad=<?= $unidad ?>&repetir_id=<?= $id_usuario ?>" 
                                           class="btn btn-sm btn-outline-warning" 
                                           onclick="return confirm('¿Estás seguro de que deseas habilitar nuevamente el examen para este alumno?')">
                                            <i class="bi bi-arrow-clockwise"></i> Repetir
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../code_general/footer.php'; ?>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
  <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastBody"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('mensaje') === 'ok') {
        const alumno = decodeURIComponent(urlParams.get('alumno') || '');
        const toastBody = document.getElementById('toastBody');
        toastBody.textContent = alumno 
            ? `✅ Examen habilitado nuevamente para: ${alumno}`
            : '✅ Acción completada con éxito.';
        const toast = new bootstrap.Toast(document.getElementById('toastExito'));
        toast.show();
    }

    const buscador = document.getElementById('buscador');
    buscador.addEventListener('input', function() {
        const filtro = this.value.toLowerCase();
        document.querySelectorAll('.alumno-item').forEach(item => {
            const textoItem = item.textContent.toLowerCase();
            item.style.display = textoItem.includes(filtro) ? '' : 'none';
        });
    });
});
</script>
</body>
</html>
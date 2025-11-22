<?php
    $page_8 = 'active'; 
    $page_actividades = 'active'; 
    require_once '../modelo/conexion.php';
    
    $unidad = isset($_GET['unidad']) ? intval($_GET['unidad']) : 0;
    $numActividad = isset($_GET['actividad']) ? intval($_GET['actividad']) : 0; 
    
    if ($unidad < 1 || $unidad > 5) die("Unidad inválida.");
    // Quitamos validación estricta de actividad si no es relevante, o la dejamos si usas el 1
    if ($numActividad < 1) $numActividad = 1; 

    date_default_timezone_set('America/Monterrey');
    
    // --- DEFINICIÓN DE COLUMNAS DINÁMICAS (CORREGIDO) ---
    // AHORA: La columna de calificación depende de la UNIDAD (calf_A_1 = Unidad 1, calf_A_5 = Unidad 5)
    $columnaCalificacion = "calf_A_" . $unidad; 
    
    // La columna de entregado también depende de la UNIDAD
    $columnaActividadEntregado = 'act_unidad_' . $unidad; 
    
    // El identificador de archivos sigue usando ambos para mantener orden en carpetas
    $identificadorActividad = 'U' . $unidad . 'A' . $numActividad; 

    // --- 1. LÓGICA PARA GUARDAR CALIFICACIÓN (INSERT O UPDATE) ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion_calificar'])) {
        try {
            $id_usuario_calificar = intval($_POST['id_usuario']);
            $calificacion_input = intval($_POST['calificacion']);

            if ($calificacion_input < 0) $calificacion_input = 0;
            if ($calificacion_input > 100) $calificacion_input = 100;

            // Usamos la columna basada en la UNIDAD ($columnaCalificacion)
            $sql = "INSERT INTO alumnos_actividad (id_usuario, $columnaCalificacion) 
                    VALUES (?, ?) 
                    ON DUPLICATE KEY UPDATE $columnaCalificacion = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $id_usuario_calificar, $calificacion_input, $calificacion_input);
            $stmt->execute();
            $stmt->close();

            header("Location: " . basename(__FILE__) . "?unidad=$unidad&actividad=$numActividad&mensaje=calificado");
            exit;

        } catch (Exception $e) {
            die("Error al calificar: " . $e->getMessage());
        }
    }

    // --- 2. LÓGICA DE REINICIO ---
    if (isset($_GET['reiniciar_id'])) {
        $reiniciar_id = intval($_GET['reiniciar_id']);
        $nombreAlumno = '';
        
        $stmtNom = $conn->prepare("SELECT U.nombres, U.apellido_paterno, A.nocontrol 
                                   FROM usuarios U 
                                   INNER JOIN alumnos A ON U.id_usuario = A.id_usuario 
                                   WHERE U.id_usuario = ?");
        $stmtNom->bind_param("i", $reiniciar_id);
        $stmtNom->execute();
        $resultNom = $stmtNom->get_result();
        
        $nocontrol = null;
        if ($rowData = $resultNom->fetch_assoc()) {
            $nombreAlumno = $rowData['nombres'] . ' ' . $rowData['apellido_paterno'];
            $nocontrol = $rowData['nocontrol']; 
        }
        $stmtNom->close();

        try {
            // A. Poner Calificación en NULL (De la columna de la UNIDAD)
            $stmtCalif = $conn->prepare("UPDATE alumnos_actividad SET $columnaCalificacion = NULL WHERE id_usuario = ?");
            $stmtCalif->bind_param("i", $reiniciar_id);
            $stmtCalif->execute();
            $stmtCalif->close();
            
            // B. Poner Bit de entregado en 0 (De la columna de la UNIDAD)
            $stmtEntregado = $conn->prepare("UPDATE actividad_entregado SET $columnaActividadEntregado = 0 WHERE id_usuario = ?");
            $stmtEntregado->bind_param("i", $reiniciar_id);
            $stmtEntregado->execute();
            $stmtEntregado->close();
            
            // C. Borrar archivos físicos
            if (!empty($nocontrol)) {
                $rutaBase = $_SERVER['DOCUMENT_ROOT'] . "/assets/code_alumnos/actividades/unidad_" . $unidad . "/" . $nocontrol . "/";
                if (is_dir($rutaBase)) {
                    $patron = $rutaBase . "*" . $identificadorActividad . "*.*"; 
                    $archivos = glob($patron);
                    if ($archivos) {
                        foreach ($archivos as $archivo) {
                            if (is_file($archivo)) unlink($archivo);
                        }
                    }
                }
            }

            header("Location: " . basename(__FILE__) . "?unidad=$unidad&actividad=$numActividad&mensaje=reiniciado&alumno=" . urlencode($nombreAlumno));
            exit;
            
        } catch (mysqli_sql_exception $e) {
             die("Error crítico al reiniciar: " . $e->getMessage());
        }
    }

    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/styles/style_calificacion_alumnos.php'; 

    // SQL Dinámico usando la columna correcta
    $sql = "SELECT 
                A.id_usuario, A.nocontrol, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar,
                AA.$columnaCalificacion AS calificacion, 
                AE.$columnaActividadEntregado AS actividad_entregada
            FROM alumnos A
            INNER JOIN usuarios U ON A.id_usuario = U.id_usuario
            LEFT JOIN alumnos_actividad AA ON A.id_usuario = AA.id_usuario
            LEFT JOIN actividad_entregado AE ON A.id_usuario = AE.id_usuario
            ORDER BY U.apellido_paterno, U.apellido_materno, U.nombres";
            
    $result = $conn->query($sql);
    if (!$result) die("Error en la consulta: " . $conn->error);
?>

<style>
    .hover-shadow { transition: box-shadow 0.3s; }
    .hover-shadow:hover { box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    .calif-aprobatoria { color: #198754; font-weight: bold; } 
    .calif-reprobatoria { color: #dc3545; font-weight: bold; } 
</style>

<main class="flex-fill">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">📝 Calificaciones - Unidad <?= $unidad ?></h1>
            <a href="menu_actividades.php?unidad=<?= $unidad ?>" class="btn btn-outline-secondary d-none d-md-inline-block">
                <i class="bi bi-arrow-left"></i> Regresar
            </a>
        </div>
        
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="buscador" class="form-control" placeholder="Buscar alumno...">
                    </div>
                </div>
                <div class="list-group">
                    <?php if ($result->num_rows === 0): ?>
                        <div class="alert alert-info text-center">No hay alumnos registrados.</div>
                    <?php else: ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php
                            $nombre = htmlspecialchars($row['nombres'] . ' ' . $row['apellido_paterno']);
                            $nocontrol = htmlspecialchars($row['nocontrol'] ?? 'S/N');
                            $id_usuario = intval($row['id_usuario']);
                            
                            $entregadoBit = intval($row['actividad_entregada'] ?? 0); 
                            $calificacion = $row['calificacion']; 

                            $badgeClass = 'bg-secondary';
                            $estadoTexto = 'Pendiente';
                            $califTexto = "—";
                            $archivosEncontradosJSON = '[]'; 
                            $archivosExisten = false;

                            if ($nocontrol !== 'S/N') {
                                $rutaDir = $_SERVER['DOCUMENT_ROOT'] . "/assets/code_alumnos/actividades/unidad_" . $unidad . "/" . $nocontrol . "/";
                                $rutaUrlBase = "/assets/code_alumnos/actividades/unidad_" . $unidad . "/" . $nocontrol . "/";
                                
                                if (is_dir($rutaDir)) {
                                    $archivosFisicos = array_diff(scandir($rutaDir), array('.', '..'));
                                    $listaArchivos = [];
                                    if ($archivosFisicos) {
                                        foreach ($archivosFisicos as $archivo) {
                                            if(is_file($rutaDir . $archivo)){
                                                $listaArchivos[] = [
                                                    'nombre' => $archivo,
                                                    'url' => $rutaUrlBase . $archivo
                                                ];
                                            }
                                        }
                                    }
                                    if (count($listaArchivos) > 0) {
                                        $archivosExisten = true;
                                        $archivosEncontradosJSON = htmlspecialchars(json_encode($listaArchivos), ENT_QUOTES, 'UTF-8');
                                    }
                                }
                            }

                            if (is_numeric($calificacion)) {
                                $claseCalif = ($calificacion < 70) ? 'calif-reprobatoria' : 'calif-aprobatoria';
                                $califTexto = "<span class='$claseCalif'>" . htmlspecialchars($calificacion) . "</span>";
                                $badgeClass = 'bg-primary'; 
                                $estadoTexto = 'Calificado';
                            } elseif ($entregadoBit === 1 || $archivosExisten) {
                                $badgeClass = 'bg-success';
                                $estadoTexto = 'Entregado';
                            } else {
                                $badgeClass = 'bg-warning text-dark';
                                $estadoTexto = 'Sin entrega';
                            }
                            ?>

                            <div class="list-group-item d-flex justify-content-between align-items-center p-3 hover-shadow alumno-item">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="/assets/images/avatar/<?= htmlspecialchars($row['avatar']) ?>" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <h5 class="mb-0"><?= $nombre ?></h5>
                                        <small class="text-muted"><?= $nocontrol ?></small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-4">
                                    <div class="text-end">
                                        <div class="small text-muted">Estado</div>
                                        <span class="badge rounded-pill <?= $badgeClass ?>"><?= $estadoTexto ?></span>
                                    </div>
                                    <div class="text-end" style="min-width: 60px;">
                                        <div class="small text-muted">Calif</div>
                                        <div class="fs-5"><?= $califTexto ?></div>
                                    </div>
                                    
                                    <div class="btn-group">
                                        <?php if ($archivosExisten): ?>
                                            <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalArchivos" data-alumno="<?= $nombre ?>" data-archivos="<?= $archivosEncontradosJSON ?>" title="Ver archivos">
                                                <i class="bi bi-folder2-open"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-outline-secondary btn-sm" disabled>
                                                <i class="bi bi-folder-x"></i>
                                            </button>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCalificar" data-id="<?= $id_usuario ?>" data-alumno="<?= $nombre ?>" data-calificacion-actual="<?= is_numeric($calificacion) ? $calificacion : '' ?>" title="Asignar Calificación">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <?php if ($archivosExisten || $entregadoBit === 1 || is_numeric($calificacion)): ?>
                                            <a href="<?= basename(__FILE__) ?>?unidad=<?= $unidad ?>&actividad=<?= $numActividad ?>&reiniciar_id=<?= $id_usuario ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar todo?');" title="Reiniciar">
                                               <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <a href="menu_actividades.php?unidad=<?= $unidad ?>" class="btn btn-outline-secondary d-md-none mt-4 w-100">
            <i class="bi bi-arrow-left"></i> Regresar
        </a>
    </div>
</main>

<?php include_once __DIR__ . '/../code_general/footer.php'; ?>

<div class="modal fade" id="modalArchivos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">📂 Archivos de <span id="modalNombreAlumno" class="fw-bold"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div id="listaArchivosContenedor" class="list-group"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCalificar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <form method="POST" action="">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Calificar Unidad <?= $unidad ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             <input type="hidden" name="accion_calificar" value="1">
             <input type="hidden" name="id_usuario" id="input_id_usuario">
             
             <div class="mb-3 text-center">
                 <p class="mb-1">Alumno:</p>
                 <h6 id="label_nombre_alumno" class="fw-bold text-primary"></h6>
             </div>

             <div class="mb-3">
                 <label for="input_calificacion" class="form-label fw-bold">Asignar Calificación (0-100):</label>
                 <div class="input-group input-group-lg">
                     <input type="number" class="form-control text-center fw-bold" name="calificacion" id="input_calificacion" min="0" max="100" required placeholder="0">
                     <span class="input-group-text">pts</span>
                 </div>
                 <div id="feedback_calificacion" class="mt-2 text-center fw-bold small"></div>
             </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>

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
    const modalArchivos = document.getElementById('modalArchivos');
    modalArchivos.addEventListener('show.bs.modal', event => {
        const boton = event.relatedTarget;
        const nombre = boton.getAttribute('data-alumno');
        const archivosJSON = boton.getAttribute('data-archivos');
        let archivos = [];
        try { archivos = JSON.parse(archivosJSON); } catch (e) {}
        
        const modalTitle = modalArchivos.querySelector('#modalNombreAlumno');
        const container = modalArchivos.querySelector('#listaArchivosContenedor');
        modalTitle.textContent = nombre;
        container.innerHTML = ''; 

        if (!archivos || archivos.length === 0) {
            container.innerHTML = `<div class="text-center py-3 text-muted">No hay archivos físicos.</div>`;
        } else {
            archivos.forEach(archivo => {
                const link = document.createElement('a');
                link.href = archivo.url;
                link.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
                link.target = '_blank'; 
                
                let icon = 'bi-file-earmark';
                if(archivo.nombre.match(/\.pdf$/i)) icon = 'bi-file-earmark-pdf text-danger';
                else if(archivo.nombre.match(/\.(jpg|png)$/i)) icon = 'bi-file-earmark-image text-primary';
                else if(archivo.nombre.match(/\.(zip|rar)$/i)) icon = 'bi-file-earmark-zip text-warning';
                else if(archivo.nombre.match(/\.(doc|docx)$/i)) icon = 'bi-file-word text-primary';

                link.innerHTML = `<div class="text-truncate me-2"><i class="bi ${icon} me-2"></i> ${archivo.nombre}</div><i class="bi bi-download text-muted"></i>`;
                container.appendChild(link);
            });
        }
    });

    const modalCalificar = document.getElementById('modalCalificar');
    const inputCalif = document.getElementById('input_calificacion');
    const feedback = document.getElementById('feedback_calificacion');

    modalCalificar.addEventListener('show.bs.modal', event => {
        const boton = event.relatedTarget;
        const id = boton.getAttribute('data-id');
        const nombre = boton.getAttribute('data-alumno');
        const actual = boton.getAttribute('data-calificacion-actual');

        document.getElementById('input_id_usuario').value = id;
        document.getElementById('label_nombre_alumno').textContent = nombre;
        inputCalif.value = actual;
        inputCalif.dispatchEvent(new Event('input'));
    });

    inputCalif.addEventListener('input', function() {
        const val = parseInt(this.value);
        if (isNaN(val)) {
            feedback.textContent = "";
            this.classList.remove('text-danger', 'text-success');
            return;
        }
        if (val < 70) {
            feedback.textContent = "Reprobatoria";
            feedback.className = "mt-2 text-center fw-bold small text-danger";
            this.classList.add('text-danger');
            this.classList.remove('text-success');
        } else {
            feedback.textContent = "Aprobatoria";
            feedback.className = "mt-2 text-center fw-bold small text-success";
            this.classList.add('text-success');
            this.classList.remove('text-danger');
        }
    });

    inputCalif.addEventListener('change', function() {
        if(this.value > 100) this.value = 100;
        if(this.value < 0) this.value = 0;
        this.dispatchEvent(new Event('input')); 
    });

    const urlParams = new URLSearchParams(window.location.search);
    const mensaje = urlParams.get('mensaje');
    if (mensaje) {
        const toastEl = document.getElementById('toastExito');
        const toastBody = document.getElementById('toastBody');
        if (mensaje === 'ok' || mensaje === 'reiniciado') {
            const alumno = decodeURIComponent(urlParams.get('alumno') || '');
            toastBody.innerText = `✅ Entrega reiniciada para ${alumno}`;
        } else if (mensaje === 'calificado') {
            toastBody.innerText = `✅ Calificación guardada correctamente.`;
        }
        new bootstrap.Toast(toastEl).show();
        window.history.replaceState({}, document.title, window.location.pathname + "?unidad=<?= $unidad ?>&actividad=<?= $numActividad ?>");
    }

    document.getElementById('buscador').addEventListener('input', function() {
        const filtro = this.value.toLowerCase();
        document.querySelectorAll('.alumno-item').forEach(item => {
            const texto = item.textContent.toLowerCase();
            item.style.display = texto.includes(filtro) ? 'flex' : 'none';
        });
    });
});
</script>
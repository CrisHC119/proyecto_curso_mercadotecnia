<?php
session_start();
ob_start();

// =================================================================================
// INICIO: CONFIGURACIÓN Y LÓGICA DE BASE DE DATOS
// =================================================================================

// --- 1. Conexión a la Base de Datos ---
include_once __DIR__ . '/../../../modelo/conexion.php'; 

$mensajeResultado = '';
$estadoEntrega = 0;
$calificacion = null;
$archivosSubidos = [];

// --- 2. Variables de configuración de la actividad ---
// IMPORTANTE: Define aquí a qué unidad y actividad corresponde esta página.
$idUnidad = 1; 
$numActividad = 1; // El número de la actividad (1, 2, 3, 4, o 5)

// Nombres de las columnas generados dinámicamente
$identificadorActividad = 'U' . $idUnidad . 'A' . $numActividad;
$columnaCalificacion = 'calf_A_' . $numActividad;
$columnaFechaInicial = 'act_' . $numActividad . '_fecha_inicial';
$columnaFechaFinal = 'act_' . $numActividad . '_fecha_final';

// Variables para el control de fechas
$actividadAbierta = false; 
$mensajeEstadoActividad = '';

if (isset($_SESSION['nocontrol']) && !empty($_SESSION['nocontrol'])) {
    $numeroControl = $_SESSION['nocontrol'];
    $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/assets/code_alumnos/actividades/unidad_" . $idUnidad . "/";

    if (!file_exists($directorioDestino)) {
        mkdir($directorioDestino, 0777, true);
    }
    
    // --- 3. Obtener estado actual (LÓGICA ADAPTADA A DOS TABLAS) ---
    try {
        // --- PASO 1: Obtener las fechas de la actividad desde la tabla de fechas ---
        $fechaInicialDB = null;
        $fechaFinalDB = null;

        $stmtFechas = $conn->prepare("SELECT $columnaFechaInicial, $columnaFechaFinal FROM alumnos_actividad_fecha WHERE id_unidad = ?");
        $stmtFechas->bind_param("i", $idUnidad);
        $stmtFechas->execute();
        $resultadoFechas = $stmtFechas->get_result();
        $fechasData = $resultadoFechas->fetch_assoc();
        $stmtFechas->close();

        if ($fechasData) {
            $fechaInicialDB = $fechasData[$columnaFechaInicial];
            $fechaFinalDB = $fechasData[$columnaFechaFinal];
        }

        // --- PASO 2: Obtener la calificación del alumno ---
        $stmtCalificacion = $conn->prepare("SELECT $columnaCalificacion FROM alumnos_actividad WHERE id_usuario = ?");
        $stmtCalificacion->bind_param("s", $numeroControl);
        $stmtCalificacion->execute();
        $resultadoCalificacion = $stmtCalificacion->get_result();
        $calificacionData = $resultadoCalificacion->fetch_assoc();
        
        if ($calificacionData) {
            $calificacion = $calificacionData[$columnaCalificacion];
        }
        $stmtCalificacion->close();

        // --- PASO 3: Verificar archivos subidos para determinar el estado de entrega ---
        $patronBusqueda = $directorioDestino . $numeroControl . "_" . $identificadorActividad . "_*.*";
        $archivosSubidos = glob($patronBusqueda);
        $estadoEntrega = (count($archivosSubidos) > 0); // Entregado si hay al menos un archivo

        // --- PASO 4: Lógica de validación de fechas (igual que antes) ---
        if ($fechaInicialDB === null || $fechaFinalDB === null) {
            $actividadAbierta = false;
            $mensajeEstadoActividad = '<div class="alert alert-warning">Esta actividad aún no ha sido configurada por el profesor. No hay fechas de entrega establecidas.</div>';
        } else {
            $zonaHoraria = new DateTimeZone('America/Mexico_City');
            $fechaActual = new DateTime("now", $zonaHoraria);
            
            $fechaInicial = new DateTime($fechaInicialDB, $zonaHoraria);
            $fechaFinal = new DateTime($fechaFinalDB, $zonaHoraria);
            
            // Opcional: El ajuste de +6 horas se mantiene como lo pediste
            // $fechaInicial->modify('+6 hours');
            // $fechaFinal->modify('+6 hours');

            if ($fechaActual < $fechaInicial) {
                $actividadAbierta = false;
                $mensajeEstadoActividad = '<div class="alert alert-info">La actividad aún no está abierta. Podrás enviar archivos a partir del ' . $fechaInicial->format('d/m/Y \a \l\a\s H:i') . ' hrs.</div>';
            } elseif ($fechaActual > $fechaFinal) {
                $actividadAbierta = false;
                $mensajeEstadoActividad = '<div class="alert alert-danger">La fecha límite para esta actividad ha pasado. La fecha de cierre fue el ' . $fechaFinal->format('d/m/Y \a \l\a\s H:i') . ' hrs.</div>';
            } else {
                $actividadAbierta = true; // La actividad está dentro del período válido
            }
        }

    } catch (mysqli_sql_exception $e) {
        // Manejo de error más genérico para cualquiera de las consultas
        $mensajeResultado = '<div class="alert alert-danger">Error al consultar los datos de la actividad. ' . $e->getMessage() . '</div>';
    }

} else {
    // Usuario no logueado
}


// --- 4. Lógica para ELIMINAR un archivo ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminarArchivo"])) {
    if (!$actividadAbierta) {
        $mensajeResultado = '<div class="alert alert-danger">No se pueden eliminar archivos porque la actividad está cerrada.</div>';
    } elseif (isset($numeroControl)) {
        $archivoAEliminar = basename($_POST['nombreArchivo']);
        $rutaCompletaArchivo = $directorioDestino . $archivoAEliminar;

        if (strpos($archivoAEliminar, $numeroControl . '_') === 0 && file_exists($rutaCompletaArchivo)) {
            if (unlink($rutaCompletaArchivo)) {
                $mensajeResultado = '<div class="alert alert-success">Archivo "' . htmlspecialchars($archivoAEliminar) . '" eliminado correctamente.</div>';
                // Recalcular archivos y estado de entrega
                $archivosSubidos = glob($patronBusqueda);
                $estadoEntrega = (count($archivosSubidos) > 0);
                // YA NO SE ACTUALIZA LA BASE DE DATOS AQUÍ
            } else {
                $mensajeResultado = '<div class="alert alert-danger">No se pudo eliminar el archivo.</div>';
            }
        } else {
            $mensajeResultado = '<div class="alert alert-danger">Acción no permitida o el archivo no existe.</div>';
        }
    }
}

// --- 5. Lógica para SUBIR archivos ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["subirArchivo"])) {
    if (!$actividadAbierta) {
        $mensajeResultado = '<div class="alert alert-danger">No se pueden subir archivos porque la actividad está cerrada.</div>';
    } elseif (isset($numeroControl)) {
        $conteoExistentes = count($archivosSubidos);
        
        if ($calificacion > 0) { // Bloquea si ya está calificado
             $mensajeResultado = '<div class="alert alert-warning">Esta actividad ya ha sido calificada y no se puede modificar.</div>';
        } else if ($conteoExistentes >= 3) {
            $mensajeResultado = '<div class="alert alert-danger">Error: Ya has alcanzado el límite de 3 archivos para esta actividad.</div>';
        } else if (isset($_FILES["archivoActividad"])) {

            if (!is_array($_FILES['archivoActividad']['name'])) {
                $_FILES['archivoActividad']['name'] = [$_FILES['archivoActividad']['name']];
                $_FILES['archivoActividad']['error'] = [$_FILES['archivoActividad']['error']];
                $_FILES['archivoActividad']['size'] = [$_FILES['archivoActividad']['size']];
                $_FILES['archivoActividad']['tmp_name'] = [$_FILES['archivoActividad']['tmp_name']];
            }

            $cantidadAsubir = count($_FILES['archivoActividad']['name']);
            $slotsDisponibles = 3 - $conteoExistentes;

            if ($cantidadAsubir > $slotsDisponibles) {
                 $mensajeResultado = '<div class="alert alert-danger">Error: Solo puedes subir ' . $slotsDisponibles . ' archivo(s) más.</div>';
            } else {
                $resultadosHTML = [];
                $subidasExitosas = 0;

                for ($i = 0; $i < $cantidadAsubir; $i++) {
                    if ($_FILES["archivoActividad"]["error"][$i] == 0) {
                        $nombreOriginal = basename($_FILES["archivoActividad"]["name"][$i]);
                        $nombreNuevoArchivo = $numeroControl . "_" . $identificadorActividad . "_" . $nombreOriginal;
                        $rutaArchivoCompleta = $directorioDestino . $nombreNuevoArchivo;
                        $tipoArchivo = strtolower(pathinfo($rutaArchivoCompleta, PATHINFO_EXTENSION));

                        if (file_exists($rutaArchivoCompleta)) {
                            $resultadosHTML[] = '<div class="alert alert-warning">Omitido: ' . htmlspecialchars($nombreOriginal) . ' ya existe.</div>';
                        } else if ($_FILES["archivoActividad"]["size"][$i] > 5 * 1024 * 1024) {
                            $resultadosHTML[] = '<div class="alert alert-warning">Omitido: ' . htmlspecialchars($nombreOriginal) . ' supera 5MB.</div>';
                        } else if (!in_array($tipoArchivo, ["zip", "pdf", "docx", "pptx"])) {
                            $resultadosHTML[] = '<div class="alert alert-warning">Omitido: ' . htmlspecialchars($nombreOriginal) . ' formato no permitido.</div>';
                        } else if (move_uploaded_file($_FILES["archivoActividad"]["tmp_name"][$i], $rutaArchivoCompleta)) {
                            $resultadosHTML[] = '<div class="alert alert-success">¡Éxito! ' . htmlspecialchars($nombreNuevoArchivo) . ' se ha subido.</div>';
                            $subidasExitosas++;
                        } else {
                            $resultadosHTML[] = '<div class="alert alert-danger">Error al subir ' . htmlspecialchars($nombreOriginal) . '.</div>';
                        }
                    }
                }

                if ($subidasExitosas > 0) {
                    // Recalcular archivos y estado de entrega
                    $archivosSubidos = glob($patronBusqueda);
                    $estadoEntrega = (count($archivosSubidos) > 0);
                    // YA NO SE ACTUALIZA LA BASE DE DATOS AQUÍ
                }
                $mensajeResultado = implode('', $resultadosHTML);
            }
        }
    } else {
        $mensajeResultado = '<div class="alert alert-danger">Error: Debes iniciar sesión para poder subir archivos.</div>';
    }
}
// =================================================================================
// FIN: LÓGICA DE BASE DE DATOS
// =================================================================================

// ... El resto del archivo HTML, HEADERS y JAVASCRIPT permanece exactamente igual ...
// No es necesario cambiar nada a partir de aquí.

$page_1 = '';
include_once __DIR__ . '/../../code_general/navbar.php';
include_once __DIR__ . '/../../styles/style_index.php';

if (!isset($_GET['lang'])) {
    $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
    header("Location: $url");
    exit;
}

$anterior = '../../index_alumnos.php'; 
$siguiente = 'T_1.2.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
<h2 class="text-center mb-4"><?php echo $textos['parrafo_0835']; ?></h2>
        <h3><strong><p class="text-center"><?php echo $textos['parrafo_0844']; ?></p></strong></h3>
        <strong><p class="justificado"><?php echo $textos['parrafo_0845']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0846']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0847']; ?></p>
        <ul class="list-unstyled justificado mt-3">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0848']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0849']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0850']; ?>
            </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0851']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0852']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0853']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0854']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0855']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0856']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0857']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0858']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0859']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0860']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0861']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0862']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0863']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0864']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0865']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0866']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0867']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0868']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0869']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0870']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0871']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0837']; ?></p>
        <ul class="list-unstyled justificado mt-3">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0838']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0839']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0840']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0841']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0842']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0843']; ?></p>

        <div class="card p-3 mb-4 shadow-sm">
            <h5 class="card-title">Estado de tu Entrega</h5>
            <div class="row">
                <div class="col-md-6">
    <p>
        <strong>Estado:</strong>
        <?php if ($estadoEntrega == 1): ?>
            <span class="badge bg-success">Entregado</span>
        <?php else: ?>
            <span class="badge bg-warning text-dark">No Entregado</span>
        <?php endif; ?>
    </p>



                    <p><strong>Calificación:</strong>
                        <?php if ($calificacion !== null && $calificacion > 0): ?>
                            <span class="badge bg-primary"><?php echo htmlspecialchars($calificacion); ?> / 100</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Sin calificar</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <strong>Archivos subidos:</strong>
                    <?php if (!empty($archivosSubidos)): ?>
                        <ul class="list-group">
                            <?php foreach ($archivosSubidos as $archivo): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars(basename($archivo)); ?>
                                    
<?php if (($calificacion == null || $calificacion == 0) && $actividadAbierta): // Solo mostrar botón si no está calificado Y la actividad está abierta ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma; ?>" style="margin: 0;">
            <input type="hidden" name="nombreArchivo" value="<?php echo htmlspecialchars(basename($archivo)); ?>">
            <button type="submit" name="eliminarArchivo" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este archivo?');">
                <i class="fas fa-trash"></i>
            </button>
        </form>
        <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No has subido ningún archivo para esta actividad.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php if (!isset($numeroControl)): // Si no ha iniciado sesión ?>
    <div class="alert alert-warning">Debes <a href="/login.php">iniciar sesión</a> para entregar la actividad.</div>

<?php elseif ($calificacion !== null && $calificacion > 0): // Si ya está calificado ?>
    <div class="alert alert-info">Esta actividad ya ha sido calificada. No se pueden realizar más cambios.</div>

<?php elseif (!$actividadAbierta && isset($numeroControl)): // NUEVO: Si la actividad NO está abierta (pasada, futura o no configurada) ?>
    <?php echo $mensajeEstadoActividad; // Muestra el mensaje que generamos en PHP ?>

<?php else: // Si ha iniciado sesión, no está calificado Y la actividad está abierta, mostrar el formulario ?>
    
        
    <div class="card p-3 mb-4 shadow-sm">
        <h5 class="card-title">Entregar Actividad</h5>
        <p class="card-text text-muted">Puedes subir hasta 3 archivos (.zip, .pdf, .docx, .pptx). Límite de 5MB por archivo.</p>
        
        <form id="uploadForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma; ?>" method="post" enctype="multipart/form-data">
            <input class="form-control" type="file" name="archivoActividad[]" id="archivoActividad" multiple style="display: none;">
            <button type="button" id="btnAnadirArchivo" class="btn btn-secondary mb-3">
                <i class="fas fa-plus me-2"></i>Añadir Archivo(s)
            </button>
            <div id="listaArchivos" class="mb-3"></div>
            <button type="submit" id="btnSubirArchivo" class="btn btn-primary" name="subirArchivo" disabled>
                <i class="fas fa-upload me-2"></i>Subir y Marcar como Entregado
            </button>
        </form>
        
        <?php if (!empty($mensajeResultado)): ?>
            <div class="mt-3">
                <?php echo $mensajeResultado; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

    </div>
    <?php
        include_once __DIR__ . '/../../code_general/tarjeta_curso.php';
    ?>
</div>

<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>

<style>
    /* ... (tus estilos existentes) ... */
    .archivo-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 8px; border: 1px solid #ddd; border-radius: 5px;
        margin-bottom: 5px; background-color: #f9f9f9;
    }
    .archivo-item span { flex-grow: 1; margin-right: 10px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadForm = document.getElementById('uploadForm');
    if (!uploadForm) return;

    const MAX_FILES = 3 - <?php echo count($archivosSubidos); ?>;
    const hiddenFileInput = document.getElementById('archivoActividad');
    const btnAnadirArchivo = document.getElementById('btnAnadirArchivo');
    const btnSubirArchivo = document.getElementById('btnSubirArchivo');
    const listaArchivosContainer = document.getElementById('listaArchivos');

    let fileStore = new DataTransfer();

    btnAnadirArchivo.addEventListener('click', () => {
        hiddenFileInput.click();
    });

    hiddenFileInput.addEventListener('change', () => {
        const nuevosArchivos = hiddenFileInput.files;
        for (const file of nuevosArchivos) {
            if (fileStore.files.length < MAX_FILES) {
                let yaExiste = false;
                for(const f of fileStore.files) {
                    if (f.name === file.name && f.size === file.size) {
                        yaExiste = true;
                        break;
                    }
                }
                if (!yaExiste) fileStore.items.add(file);
            }
        }
        actualizarVistaArchivos();
        hiddenFileInput.value = '';
    });

    function actualizarVistaArchivos() {
        listaArchivosContainer.innerHTML = '';
        if (fileStore.files.length === 0) {
            listaArchivosContainer.innerHTML = '<p class="text-muted">Ningún archivo seleccionado para subir.</p>';
        } else {
            for (let i = 0; i < fileStore.files.length; i++) {
                const file = fileStore.files[i];
                const archivoItem = document.createElement('div');
                archivoItem.className = 'archivo-item';
                const fileName = document.createElement('span');
                fileName.textContent = file.name;
                const btnEliminar = document.createElement('button');
                btnEliminar.type = 'button';
                btnEliminar.className = 'btn btn-danger btn-sm';
                btnEliminar.innerHTML = '&times;';
                btnEliminar.dataset.index = i;
                btnEliminar.addEventListener('click', () => {
                    eliminarArchivo(parseInt(btnEliminar.dataset.index));
                });
                archivoItem.appendChild(fileName);
                archivoItem.appendChild(btnEliminar);
                listaArchivosContainer.appendChild(archivoItem);
            }
        }
        btnSubirArchivo.disabled = fileStore.files.length === 0;
        btnAnadirArchivo.disabled = fileStore.files.length >= MAX_FILES;
        if(MAX_FILES <= 0) btnAnadirArchivo.disabled = true;
    }
    
    function eliminarArchivo(index) {
        const dt = new DataTransfer();
        const files = fileStore.files;
        for (let i = 0; i < files.length; i++) {
            if (i !== index) dt.items.add(files[i]);
        }
        fileStore = dt;
        actualizarVistaArchivos();
    }

    uploadForm.addEventListener('submit', (e) => {
        if (fileStore.files.length === 0) {
            alert('Por favor, selecciona al menos un archivo para subir.');
            e.preventDefault();
            return;
        }
        hiddenFileInput.files = fileStore.files;
    });

    actualizarVistaArchivos();
});
</script>
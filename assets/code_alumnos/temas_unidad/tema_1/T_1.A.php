<?php
session_start();
ob_start();

$mensajeResultado = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["subirArchivo"])) {
    
    if (isset($_SESSION['nocontrol']) && !empty($_SESSION['nocontrol'])) {
        
        $numeroControl = $_SESSION['nocontrol'];
        $identificadorActividad = 'U1A1';
        $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/assets/code_alumnos/actividades/unidad_1/";

        // --- 1. VERIFICACIÓN PREVIA DE ARCHIVOS EXISTENTES ---
        if (!file_exists($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);
        }
        $patronBusqueda = $directorioDestino . $numeroControl . "_" . $identificadorActividad . "_*.*";
        $archivosExistentes = glob($patronBusqueda);
        $conteoExistentes = count($archivosExistentes);

        if ($conteoExistentes >= 3) {
            $mensajeResultado = '<div class="alert alert-danger">Error: Ya has alcanzado el límite de 3 archivos para esta actividad.</div>';
        } 
        // --- FIN DE LA VERIFICACIÓN PREVIA ---

        // Comprueba si se seleccionaron archivos y si no hay mensaje de error previo
        else if (isset($_FILES["archivoActividad"]) && empty($mensajeResultado)) {
            
            // ===== INICIO DE LA CORRECCIÓN =====
            // Si solo se sube un archivo, $_FILES['archivoActividad']['name'] no es un array.
            // Esta comprobación soluciona el error.
            if (!is_array($_FILES['archivoActividad']['name'])) {
                // Si no es un array, lo convertimos en uno para que el código funcione igual
                $_FILES['archivoActividad']['name'] = [$_FILES['archivoActividad']['name']];
                $_FILES['archivoActividad']['error'] = [$_FILES['archivoActividad']['error']];
                $_FILES['archivoActividad']['size'] = [$_FILES['archivoActividad']['size']];
                $_FILES['archivoActividad']['tmp_name'] = [$_FILES['archivoActividad']['tmp_name']];
            }
            // ===== FIN DE LA CORRECCIÓN =====

            $cantidadAsubir = count($_FILES['archivoActividad']['name']);
            $slotsDisponibles = 3 - $conteoExistentes;

            if ($cantidadAsubir > $slotsDisponibles) {
                 $mensajeResultado = '<div class="alert alert-danger">Error: Solo puedes subir ' . $slotsDisponibles . ' archivo(s) más. Has intentado subir ' . $cantidadAsubir . '.</div>';
            } else {
                
                $resultadosHTML = [];

                for ($i = 0; $i < $cantidadAsubir; $i++) {
                    if ($_FILES["archivoActividad"]["error"][$i] == 0) {
                        
                        $nombreOriginal = basename($_FILES["archivoActividad"]["name"][$i]);
                        $nombreNuevoArchivo = $numeroControl . "_" . $identificadorActividad . "_" . $nombreOriginal;
                        $rutaArchivoCompleta = $directorioDestino . $nombreNuevoArchivo;
                        $tipoArchivo = strtolower(pathinfo($rutaArchivoCompleta, PATHINFO_EXTENSION));

                        if (file_exists($rutaArchivoCompleta)) {
                            $resultadosHTML[] = '<div class="alert alert-warning">Omitido: El archivo ' . htmlspecialchars($nombreOriginal) . ' ya existe.</div>';
                        }
                        else if ($_FILES["archivoActividad"]["size"][$i] > 5 * 1024 * 1024) {
                            $resultadosHTML[] = '<div class="alert alert-warning">Omitido: El archivo ' . htmlspecialchars($nombreOriginal) . ' supera el límite de 5MB.</div>';
                        }
                        else if (!in_array($tipoArchivo, ["zip", "pdf", "docx", "pptx"])) {
                            $resultadosHTML[] = '<div class="alert alert-warning">Omitido: El archivo ' . htmlspecialchars($nombreOriginal) . ' tiene un formato no permitido.</div>';
                        }
                        else if (move_uploaded_file($_FILES["archivoActividad"]["tmp_name"][$i], $rutaArchivoCompleta)) {
                            $resultadosHTML[] = '<div class="alert alert-success">¡Éxito! El archivo ' . htmlspecialchars($nombreNuevoArchivo) . ' se ha subido correctamente.</div>';
                        } else {
                            $resultadosHTML[] = '<div class="alert alert-danger">Error al subir ' . htmlspecialchars($nombreOriginal) . '.</div>';
                        }
                    }
                }
                $mensajeResultado = implode('', $resultadosHTML);
            }
        }
    } else {
        $mensajeResultado = '<div class="alert alert-danger">Error: Debes iniciar sesión para poder subir archivos.</div>';
    }
}
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
        <h2 class="text-center mb-4">Actividad 1</h2>

        <div class="card p-3 mb-4 shadow-sm">
            <h5 class="card-title">Entregar Actividad</h5>
            <p class="card-text text-muted">Puedes seleccionar hasta 3 archivos (.zip, .pdf, .docx).</p>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="archivoActividad" class="form-label">Seleccionar archivo(s):</label>
                    <input class="form-control" type="file" name="archivoActividad[]" id="archivoActividad" required multiple>
                </div>
                <button type="submit" class="btn btn-primary" name="subirArchivo">
                    <i class="fas fa-upload me-2"></i>Subir Archivo(s)
                </button>
            </form>
            
            <?php if (!empty($mensajeResultado)): ?>
                <div class="mt-3">
                    <?php echo $mensajeResultado; ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
    <?php
        include_once __DIR__ . '/../../code_general/tarjeta_curso.php';
    ?>
</div>

<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>

<style>
    ul.list-unstyled.justificado li {
        line-height: 1.2;
    }
</style>

<script>
document.getElementById('archivoActividad').addEventListener('change', function(e) {
    if (e.target.files.length > 3) {
        alert('¡Solo puedes seleccionar un máximo de 3 archivos a la vez!');
        // Limpia la selección
        e.target.value = '';
    }
});
</script>
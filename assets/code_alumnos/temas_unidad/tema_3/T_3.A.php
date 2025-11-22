<?php
    session_start();
    ob_start();
    $mensajeResultado = '';
    $anterior = 'T_3.Glosario.php';
    include_once __DIR__ . '/../../../modelo/conexion.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
    
    if (isset($_SESSION['mensajeResultado'])) {
        $mensajeResultado = $_SESSION['mensajeResultado'];
        unset($_SESSION['mensajeResultado']);
    }
    
    $estadoEntrega = 0;
    $calificacion = null;
    $archivosSubidos = [];

    $idUnidad = 3; 
    $numActividad = 2;

    $identificadorActividad = 'U' . $idUnidad . 'A' . $numActividad;

    // --- DEFINICIÓN DE COLUMNAS (CORREGIDO) ---
    // La calificación se toma por UNIDAD
    $columnaCalificacion = 'calf_A_' . $idUnidad; 
    
    $columnaFechaInicial = 'act_' . $numActividad . '_fecha_inicial';
    $columnaFechaFinal = 'act_' . $numActividad . '_fecha_final';
    $columnaActividadEntregado = 'act_unidad_' . $idUnidad;

    $actividadAbierta = false; 
    $mensajeEstadoActividad = '';
    
    $actividadEntregadaBit = 0;

    // --- DATOS DE SESIÓN ---
    $numeroControl = $_SESSION['nocontrol']; // Para carpetas
    $idUsuario = $_SESSION['id_usuario'];    // Para Base de Datos
    
    $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/assets/code_alumnos/actividades/unidad_" . $idUnidad . "/" . $numeroControl . "/";

    if (!file_exists($directorioDestino)) {
        mkdir($directorioDestino, 0777, true);
    }
    try {
        $fechaInicialDB = null;
        $fechaFinalDB = null;

        $idUnidadMaestra = 1;
        
        // 1. Fechas
        $stmtFechas = $conn->prepare("SELECT $columnaFechaInicial, $columnaFechaFinal FROM alumnos_actividad_fecha WHERE id_unidad = ?");
        $stmtFechas->bind_param("i", $idUnidadMaestra);
        $stmtFechas->execute();
        $resultadoFechas = $stmtFechas->get_result();
        $fechasData = $resultadoFechas->fetch_assoc();
        $stmtFechas->close();

        if ($fechasData) {
            $fechaInicialDB = $fechasData[$columnaFechaInicial];
            $fechaFinalDB = $fechasData[$columnaFechaFinal];
        }

        // 2. Calificación (Usando id_usuario)
        $stmtCalificacion = $conn->prepare("SELECT $columnaCalificacion FROM alumnos_actividad WHERE id_usuario = ?");
        $stmtCalificacion->bind_param("i", $idUsuario); // Entero
        $stmtCalificacion->execute();
        $resultadoCalificacion = $stmtCalificacion->get_result();
        $calificacionData = $resultadoCalificacion->fetch_assoc();
        
        if ($calificacionData) {
            $calificacion = $calificacionData[$columnaCalificacion];
        }
        $stmtCalificacion->close();

        // 3. Estado de Entrega (Usando id_usuario)
        $stmtBit = $conn->prepare("SELECT $columnaActividadEntregado FROM actividad_entregado WHERE id_usuario = ?");
        $stmtBit->bind_param("i", $idUsuario); // Entero
        $stmtBit->execute();
        $resultadoBit = $stmtBit->get_result();
        $bitData = $resultadoBit->fetch_assoc();
        
        if ($bitData) {
            $actividadEntregadaBit = $bitData[$columnaActividadEntregado];
        }
        $stmtBit->close();

        // 4. Archivos físicos
        $patronBusqueda = $directorioDestino . $numeroControl . "_" . $identificadorActividad . "_*.*";
        $archivosSubidos = glob($patronBusqueda);
        $estadoEntrega = (count($archivosSubidos) > 0);

        // Lógica de fechas
        if ($fechaInicialDB === null || $fechaFinalDB === null) {
            $actividadAbierta = false;
            $mensajeEstadoActividad = '<div class="alert alert-warning">Esta actividad aún no ha sido configurada por el profesor. No hay fechas de entrega establecidas.</div>';
        } else {
            $zonaHoraria = new DateTimeZone('America/Mexico_City');
            $fechaActual = new DateTime("now", $zonaHoraria);
            
            $fechaInicial = new DateTime($fechaInicialDB, $zonaHoraria);
            $fechaFinal = new DateTime($fechaFinalDB, $zonaHoraria);
            
            if ($fechaActual < $fechaInicial) {
                $actividadAbierta = false;
                $mensajeEstadoActividad = '<div class="alert alert-info">La actividad aún no está abierta. Podrás enviar archivos a partir del ' . $fechaInicial->format('d/m/Y \a \l\a\s H:i') . ' hrs.</div>';
            } elseif ($fechaActual > $fechaFinal) {
                $actividadAbierta = false;
                $mensajeEstadoActividad = '<div class="alert alert-danger">La fecha límite para esta actividad ha pasado. La fecha de cierre fue el ' . $fechaFinal->format('d/m/Y \a \l\a\s H:i') . ' hrs.</div>';
            } else {
                $actividadAbierta = true;
            }
        }

    } catch (mysqli_sql_exception $e) {
        $mensajeResultado = '<div class="alert alert-danger">Error al consultar los datos de la actividad. ' . $e->getMessage() . '</div>';
    }

    // --- CANCELAR ENTREGA ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancelarEntrega"])) {
        if (!$actividadAbierta) {
             $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se puede cancelar la entrega porque la actividad está cerrada por fecha.</div>';
        } elseif ($calificacion > 0) {
             $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se puede cancelar la entrega porque la actividad ya ha sido calificada.</div>';
        } elseif ($actividadEntregadaBit == 1) {
            try {
                // Update usando id_usuario
                $stmtCancelBit = $conn->prepare("UPDATE actividad_entregado SET $columnaActividadEntregado = 0 WHERE id_usuario = ?");
                $stmtCancelBit->bind_param("i", $idUsuario);
                $stmtCancelBit->execute();
                $stmtCancelBit->close();
                $actividadEntregadaBit = 0;
                $_SESSION['mensajeResultado'] = '<div class="alert alert-success">¡Entrega cancelada! Ahora puedes modificar o eliminar tus archivos.</div>';
            } catch (mysqli_sql_exception $e) {
                $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">Error al cancelar la entrega: ' . $e->getMessage() . '</div>';
            }
        } else {
            $_SESSION['mensajeResultado'] = '<div class="alert alert-warning">La actividad no estaba marcada como entregada.</div>';
        }
    }

    // --- ELIMINAR ARCHIVO ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminarArchivo"])) {
        if (!$actividadAbierta) {
            $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se pueden eliminar archivos porque la actividad está cerrada.</div>';
        } elseif ($actividadEntregadaBit == 1 && ($calificacion == null || $calificacion == 0)) { 
             $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se pueden eliminar archivos porque la entrega final ya fue marcada. Primero debe cancelarla.</div>';
        } elseif ($calificacion > 0) {
             $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se pueden eliminar archivos porque la actividad ya fue calificada.</div>';
        } elseif (isset($numeroControl)) {
            $archivoAEliminar = basename($_POST['nombreArchivo']);
            $rutaCompletaArchivo = $directorioDestino . $archivoAEliminar;

            if (strpos($archivoAEliminar, $numeroControl . '_' . $identificadorActividad . '_') === 0 && file_exists($rutaCompletaArchivo)) {
                if (unlink($rutaCompletaArchivo)) {
                    $_SESSION['mensajeResultado'] = '<div class="alert alert-success">Archivo "' . htmlspecialchars($archivoAEliminar) . '" eliminado correctamente.</div>';
                    $archivosSubidos = glob($patronBusqueda);
                    $estadoEntrega = (count($archivosSubidos) > 0);
                    
                    // Si se queda vacío, actualizamos el bit a 0
                    if (count($archivosSubidos) === 0 && $actividadEntregadaBit == 1) {
                        $stmtUpdateBit = $conn->prepare("UPDATE actividad_entregado SET $columnaActividadEntregado = 0 WHERE id_usuario = ?");
                        $stmtUpdateBit->bind_param("i", $idUsuario); // Usando id_usuario
                        $stmtUpdateBit->execute();
                        $stmtUpdateBit->close();
                        $actividadEntregadaBit = 0;
                    }

                } else {
                    $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se pudo eliminar el archivo.</div>';
                }
            } else {
                $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">Acción no permitida o el archivo no existe.</div>';
            }
        }
    }

    // --- SUBIR ARCHIVO ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["subirArchivo"])) {
        if ($actividadEntregadaBit == 1) { 
            $_SESSION['mensajeResultado'] = '<div class="alert alert-warning">La actividad ya ha sido marcada como entregada. Primero debe cancelar la entrega para subir más archivos.</div>';
        } elseif (!$actividadAbierta) {
            $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">No se pueden subir archivos porque la actividad está cerrada.</div>';
        } elseif (isset($numeroControl)) {
            $conteoExistentes = count($archivosSubidos);
            
            if ($calificacion > 0) {
                $_SESSION['mensajeResultado'] = '<div class="alert alert-warning">Esta actividad ya ha sido calificada y no se puede modificar.</div>';
            } else if ($conteoExistentes >= 5) {
                $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">Error: Ya has alcanzado el límite de 5 archivos para esta actividad.</div>';
            } else if (isset($_FILES["archivoActividad"])) {

                if (!is_array($_FILES['archivoActividad']['name'])) {
                    $_FILES['archivoActividad']['name'] = [$_FILES['archivoActividad']['name']];
                    $_FILES['archivoActividad']['error'] = [$_FILES['archivoActividad']['error']];
                    $_FILES['archivoActividad']['size'] = [$_FILES['archivoActividad']['size']];
                    $_FILES['archivoActividad']['tmp_name'] = [$_FILES['archivoActividad']['tmp_name']];
                }

                $cantidadAsubir = count($_FILES['archivoActividad']['name']);
                $slotsDisponibles = 5 - $conteoExistentes;

                if ($cantidadAsubir > $slotsDisponibles) {
                    $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">Error: Solo puedes subir ' . $slotsDisponibles . ' archivo(s) más.</div>';
                } else {
                    $resultadosHTML = [];
                    $subidasExitosas = 0;

                    for ($i = 0; $i < $cantidadAsubir; $i++) {
                        if ($_FILES["archivoActividad"]["error"][$i] == 0) {
                            
                            $nombreOriginal = basename($_FILES["archivoActividad"]["name"][$i]);
                            $tipoArchivoOriginal = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

                            $nombreChequeo = $numeroControl . "_" . $identificadorActividad . "_" . $nombreOriginal;
                            $rutaChequeo = $directorioDestino . $nombreChequeo;

                            if (file_exists($rutaChequeo)) {
                                $resultadosHTML[] = '<div class="alert alert-warning">Omitido: ' . htmlspecialchars($nombreOriginal) . ' ya existe.</div>';
                            
                            } else if ($_FILES["archivoActividad"]["size"][$i] > 8 * 1024 * 1024) { 
                                $resultadosHTML[] = '<div class="alert alert-warning">Omitido: ' . htmlspecialchars($nombreOriginal) . ' supera 8MB.</div>';
                            
                            } else {
                                $extensionesPeligrosas = [
                                    "php", "phtml", "php3", "php4", "php5", "php7", "phps", "phar", 
                                    "asp", "aspx", "cer", "jsp", "cgi", "pl", "py", "sh", 
                                    "htaccess", "htpasswd", "config", "ini",
                                    "exe", "bat", "com", "cmd", "vbs", "js", "jar", "scr", "msi"
                                ];

                                if (in_array($tipoArchivoOriginal, $extensionesPeligrosas)) {
                                    $resultadosHTML[] = '<div class="alert alert-danger">Omitido: ' . htmlspecialchars($nombreOriginal) . ' formato NO permitido.</div>';
                                
                                } else {
                                    $nombreAleatorio = uniqid() . '_' . md5(time() . $nombreOriginal);
                                    $nombreNuevoArchivo = $numeroControl . "_" . $identificadorActividad . "_" . $nombreAleatorio . "." . $tipoArchivoOriginal;
                                    $rutaArchivoCompleta = $directorioDestino . $nombreNuevoArchivo; 

                                    if (move_uploaded_file($_FILES["archivoActividad"]["tmp_name"][$i], $rutaArchivoCompleta)) {
                                        $resultadosHTML[] = '<div class="alert alert-success">¡Éxito! ' . htmlspecialchars($nombreOriginal) . ' se ha subido.</div>';
                                        $subidasExitosas++;
                                    } else {
                                        $resultadosHTML[] = '<div class="alert alert-danger">Error al subir ' . htmlspecialchars($nombreOriginal) . '.</div>';
                                    }
                                }
                            }
                        }
                    } 
                    if ($subidasExitosas > 0) {
                        $archivosSubidos = glob($patronBusqueda);
                        $estadoEntrega = (count($archivosSubidos) > 0);

                        // Insert/Update usando id_usuario
                        $stmtUpdateBit = $conn->prepare("INSERT INTO actividad_entregado (id_usuario, $columnaActividadEntregado) VALUES (?, 1) ON DUPLICATE KEY UPDATE $columnaActividadEntregado = 1");
                        $stmtUpdateBit->bind_param("i", $idUsuario);
                        $stmtUpdateBit->execute();
                        $stmtUpdateBit->close();
                        $actividadEntregadaBit = 1; 
                    }
                    $_SESSION['mensajeResultado'] = implode('', $resultadosHTML);
                }
            }
        } else {
            $_SESSION['mensajeResultado'] = '<div class="alert alert-danger">Error: Debes iniciar sesión para poder subir archivos.</div>';
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ob_end_clean(); 
        
        $urlRedirect = htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma;
        header("Location: " . $urlRedirect);
        exit;
    }
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['parrafo_0903_1']; ?></h2>
        <h3><strong><p class="text-center"><?php echo $textos['parrafo_0903']; ?></p></strong></h3>
        <strong><p class="justificado"><?php echo $textos['parrafo_0874']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0904']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0876']; ?></p>
        <ul class="list-unstyled justificado mt-3">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0905']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0906']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0907']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0908']; ?>
            </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0851']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0909']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0910']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0911']; ?></p>
        <ul class="list-unstyled justificado mt-3">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0912']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0913']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0914']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0915']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0916']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0917']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0918']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0919']; ?></p>
            </li>
            <p class="justificado"><?php echo $textos['parrafo_0920']; ?></p>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0921']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0922']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0923']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0924']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0925']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0926']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0927']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0928']; ?></p>
            </li>
            <li class="mb-3">
                <strong><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0929']; ?></strong>
                <p class="justificado"><?php echo $textos['parrafo_0930']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0931']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0932']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0933']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0934']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0935']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0936']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0937']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0938']; ?></p>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0939']; ?>
                <p class="justificado"><?php echo $textos['parrafo_0940']; ?></p>
            </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0857']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0941']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0942']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0943']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0944']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0945']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0946']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0947']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0865']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0948']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0867']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0949']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0869']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0950']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0951']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0952']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0953']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0954']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0841']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0955']; ?> <?php echo $textos['parrafo_0956']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0957']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0958']; ?> <?php echo $textos['parrafo_0959']; ?></p>
        <ul class="list-unstyled justificado mt-3">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0960']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0961']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0962']; ?>
            </li>
        </ul>
        <div class="card p-3 p-md-4 mb-4 shadow-sm">
            <h5 class="card-title mb-3"><?php echo $textos['estado_entrega']; ?></h5>
                <div class="status-bar mb-3">
                    <div class="stat-item">
                        <span class="stat-label"><?php echo $textos['estado']; ?></span>
                        <?php if ($estadoEntrega == 1): ?>
                            <span class="stat-value text-success">
                                <i class="fas fa-check-circle me-2"></i><?php echo $textos['entregado']; ?>
                            </span>
                        <?php else: ?>
                            <span class="stat-value text-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $textos['no_entregado']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label"><?php echo $textos['calificacion']; ?></span>
                        <?php if ($calificacion !== null && $calificacion > 0): ?>
                            <span class="stat-value text-primary">                            
                                <i class="fas fa-award me-2"></i><?php echo htmlspecialchars($calificacion); ?> / 100
                            </span>                            
                        <?php else: ?>                            
                            <span class="stat-value text-muted">                            
                                <i class="fas fa-hourglass-half me-2"></i><?php echo $textos['sin_calificar']; ?>                            
                            </span>                            
                        <?php endif; ?>                            
                    </div>                    
                </div>                    
                <hr><h6 class="mb-2"><strong><?php echo $textos['archivos_subidos']; ?>    </strong></h6>
                <?php if (!empty($archivosSubidos)): ?>
                    <ul class="list-group list-group-flush" id="listaArchivosCargadosPreviamente">
                        <?php
                        foreach ($archivosSubidos as $archivo):
                            $nombreArchivoBase = basename($archivo);
                            $rutaWeb = str_replace($_SERVER['DOCUMENT_ROOT'], '', $archivo);
                            $rutaWeb = str_replace(DIRECTORY_SEPARATOR, '/', $rutaWeb);
                        ?>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-1">
                            <a href="<?php echo htmlspecialchars($rutaWeb); ?>"
                            target="_blank"
                            Lrel="noopener noreferrer"
                            class="nombre-archivo-lista"
                            style="text-decoration: none; color: inherit;">
                                <i class="fas fa-file-alt text-secondary me-2"></i>
                                <?php echo htmlspecialchars($nombreArchivoBase); ?>
                            </a>
                            <?php if (($calificacion == null || $calificacion == 0) && $actividadAbierta && $actividadEntregadaBit == 0): ?>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma; ?>" style="margin: 0;">
                                    <input type="hidden" name="nombreArchivo" value="<?php echo htmlspecialchars($nombreArchivoBase); ?>">
                                    <button type="submit" name="eliminarArchivo" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo $textos['eliminar_archivo_aviso']; ?>');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted"><?php echo $textos['sin_archivos']; ?></p>
                <?php endif; ?>  
            </div>
            <?php if (!isset($numeroControl)): ?>
                <div class="alert alert-warning">Debes <a href="/login.php">iniciar sesión</a> para entregar la actividad.</div>
            <?php elseif ($calificacion !== null && $calificacion > 0): ?>
                <div class="alert alert-info"><?php echo $textos['aviso_entrega']; ?></div>
            <?php elseif (!$actividadAbierta && isset($numeroControl)): ?>
                <?php echo $mensajeEstadoActividad; ?>
            <?php elseif ($actividadEntregadaBit == 1): ?>
                <div class="card p-3 mb-4 shadow-sm text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center mb-3" role="alert">
                        <i class="fas fa-check-double fa-2x me-3"></i>
                        <div>
                            <strong>¡Actividad Entregada!</strong> La actividad fue marcada como entregada.
                        </div>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma; ?>" style="margin: 0;">
                        <input type="hidden" name="cancelarEntrega" value="1">
                        <button type="submit" class="btn btn-warning w-100" onclick="return confirm('¿Estás seguro de que deseas CANCELAR la entrega? Esto te permitirá editar o borrar archivos.');">
                            <i class="fas fa-undo me-2"></i>Cancelar Entrega
                        </button>
                    </form>
                </div>
            <?php else:  ?>
            <div class="card p-3 mb-4 shadow-sm">
                <h5 class="card-title"><?php echo $textos['entregar_actividad']; ?></h5>
                <p class="card-text text-muted"><?php echo $textos['aviso_tamaño_archivo']; ?></p>
                <form id="uploadForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?lang=' . $idioma; ?>" method="post" enctype="multipart/form-data" novalidate>
                    <input class="form-control" type="file" name="archivoActividad[]" id="archivoActividad" multiple style="display: none;">
                    <div id="dropZone" class="drop-zone">  
                        <span class="drop-zone__prompt">  
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i><br>
                            <?php echo $textos['arrastra_archivo_1']; ?><strong><?php echo $textos['arrastra_archivo_2']; ?></strong>
                        </span>     
                    </div>       
                    <div id="listaArchivos" class="mb-3 mt-3"></div>         
                    <button type="submit" id="btnSubirArchivo" class="btn btn-primary w-100" name="subirArchivo" disabled>      
                        <i class="fas fa-upload me-2"></i><?php echo $textos['marcar_entrega']; ?>
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
            include __DIR__ . '/../../code_general/tarjeta_curso.php';
        ?>
    </div>
<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>

<style>
    .archivo-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 8px; border: 1px solid #ddd; border-radius: 5px;
        margin-bottom: 5px; background-color: #f9f9f9;
    }
    .archivo-item span { 
        flex-grow: 1; margin-right: 10px; 
    }
    .list-group-item .nombre-archivo-lista {
        flex: 1;
        word-break: break-all;
        overflow-wrap: break-word;
        min-width: 0;
        margin-right: 15px; 
    }
    .list-group-item form {
        flex-shrink: 0;
    }
    .drop-zone {
        border: 2px dashed #ccc;
        border-radius: 8px;
        padding: 40px;
        text-align: center;
        background-color: #f9f9f9;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .drop-zone.is-dragover {
        background-color: #e0f0ff;
        border-color: #0d6efd;
    }
    .drop-zone__prompt {
        color: #666;
        font-size: 1.1rem;
    }
    .archivo-item {
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        padding: 10px 12px; 
        border: 1px solid #ddd; 
        border-radius: 5px;
        margin-bottom: 8px; 
        background-color: #fff;
    }
    body.light-mode #mainContent .card {
        background-color: #2d3748;
        color: #f5f5f5;           
        border: 1px solid #4a5568;
    }
    body.light-mode #mainContent .card .card-title {
        color: #ffffff; 
    }
    body.light-mode #mainContent .card .text-muted {
        color: #adb5bd !important;
    }
    body.light-mode #mainContent .card hr {
        border-top: 1px solid #4a5568;
    }
    body.light-mode #mainContent .drop-zone {
        background-color: #3a475a;
        border-color: #5a677a;
    }
    body.light-mode #mainContent .drop-zone__prompt {
        color: #c0c0c0;
    }
    body.light-mode #mainContent .drop-zone.is-dragover {
        background-color: #4a5568;
        border-color: #7a8ba0;
    }
    body.light-mode #mainContent .archivo-item {
        background-color: #3a475a;
        border-color: #5a677a;
        color: #f5f5f5;
    }
    body.light-mode #mainContent .card .stat-label {
        color: #adb5bd;
    }
    body.light-mode #mainContent .card .stat-value {
        color: #f5f5f5; 
    }
    body.light-mode #mainContent .card .stat-value.text-warning {
        color: #ffc107 !important; 
    }
    @media (max-width: 767.98px) {
        #mainContent .card h5.card-title {
            font-size: 1.0rem;
        }
        #mainContent .card .card-text, 
        #mainContent .card .stat-label,
        #mainContent .card .stat-value,
        #mainContent .card h6,          
        #mainContent .card .text-muted,
        #mainContent .card .alert {      
            font-size: 0.8rem;
        }
        #mainContent .card .drop-zone__prompt {
            font-size: 0.85rem;
        }
        #mainContent .card .archivo-item {
            font-size: 0.8rem;
        }
    }
    body.light-mode #mainContent #listaArchivosCargadosPreviamente {
        background-color: #2d3748; 
        border: 1px solid #4a5568;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
    }
    body.light-mode #mainContent #listaArchivosCargadosPreviamente h6 {
        color: #ffffff; 
        margin-bottom: 10px;
    }
    body.light-mode #mainContent #listaArchivosCargadosPreviamente .list-group-item {
        background-color: #3a475a;
        border: 1px solid #5a677a;
        color: #f5f5f5;
        margin-bottom: 5px;
        border-radius: 5px;
    }
    body.light-mode #mainContent #listaArchivosCargadosPreviamente .list-group-item i {
        color: #adb5bd; 
    }
    body.light-mode #mainContent #listaArchivosCargadosPreviamente .list-group-item .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }
    body.light-mode #mainContent #listaArchivosCargadosPreviamente .list-group-item .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    @media (max-width: 767.98px) {
        #mainContent #listaArchivosCargadosPreviamente h6 {
            font-size: 1rem;
        }
        #mainContent #listaArchivosCargadosPreviamente .list-group-item {
            font-size: 0.55rem;
            padding: 8px 10px; 
        }
        #mainContent #listaArchivosCargadosPreviamente .list-group-item .btn-danger {
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadForm = document.getElementById('uploadForm');
        if (!uploadForm) {
            const btnCancelar = document.querySelector('button[name="cancelarEntrega"]');
            if (btnCancelar) {
                const dropZone = document.getElementById('dropZone');
                if(dropZone) {
                    dropZone.style.pointerEvents = 'none';
                }
            }
            return;
        }

        const dropZone = document.getElementById('dropZone');
        const hiddenFileInput = document.getElementById('archivoActividad');
        const btnSubirArchivo = document.getElementById('btnSubirArchivo');
        const listaArchivosContainer = document.getElementById('listaArchivos');
        
        const MAX_FILES = 5 - <?php echo count($archivosSubidos); ?>;
        
        let fileStore = new DataTransfer();
        
        const actividadEntregadaBit = <?php echo $actividadEntregadaBit; ?>;
        const calificacion = <?php echo $calificacion === null ? 'null' : (float)$calificacion; ?>;

        if (actividadEntregadaBit == 1 || (calificacion !== null && calificacion > 0)) {
            if (dropZone) dropZone.style.pointerEvents = 'none';
            if (btnSubirArchivo) {
                 btnSubirArchivo.disabled = true;
                 btnSubirArchivo.textContent = "Entrega Final Marcada";
            }
            if (dropZone && dropZone.querySelector('.drop-zone__prompt')) {
                 dropZone.querySelector('.drop-zone__prompt').innerHTML = '<i class="fas fa-lock fa-3x text-danger mb-3"></i><br>La entrega final está marcada. No se permiten más archivos.';
            }
            return; 
        }

        dropZone.addEventListener('click', () => {
            hiddenFileInput.click();
        });

        hiddenFileInput.addEventListener('change', () => {
            handleFiles(hiddenFileInput.files);
            hiddenFileInput.value = '';
        });

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('is-dragover');
        });
        
        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('is-dragover');
        });
        
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('is-dragover');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        function handleFiles(nuevosArchivos) {
            for (const file of nuevosArchivos) {
                if (fileStore.files.length < MAX_FILES) {
                    let yaExiste = false;
                    for(const f of fileStore.files) {
                        if (f.name === file.name && f.size === file.size) {
                            yaExiste = true;
                            break;
                        }
                    }
                    if (!yaExiste) {
                        fileStore.items.add(file);
                    }
                }
            }
            actualizarVistaArchivos();
        }

        function actualizarVistaArchivos() {
            listaArchivosContainer.innerHTML = ''; 
            
            if (fileStore.files.length === 0) {
            } else {
                for (let i = 0; i < fileStore.files.length; i++) {
                    const file = fileStore.files[i];
                    const archivoItem = document.createElement('div');
                    archivoItem.className = 'archivo-item';
                    
                    const fileIcon = document.createElement('i');
                    fileIcon.className = 'fas fa-file-alt text-secondary me-2';
                    
                    const fileName = document.createElement('span');
                    fileName.className = 'nombre-archivo-lista';
                    fileName.textContent = file.name;
                    
                    const btnEliminar = document.createElement('button');
                    btnEliminar.type = 'button';
                    btnEliminar.className = 'btn btn-danger btn-sm';
                    btnEliminar.innerHTML = '&times;';
                    btnEliminar.dataset.index = i;
                    btnEliminar.addEventListener('click', () => {
                        eliminarArchivo(parseInt(btnEliminar.dataset.index));
                    });
                    
                    archivoItem.appendChild(fileIcon);
                    archivoItem.appendChild(fileName);
                    archivoItem.appendChild(btnEliminar);
                    listaArchivosContainer.appendChild(archivoItem);
                }
            }
            
            btnSubirArchivo.disabled = fileStore.files.length === 0;
            
            if (fileStore.files.length >= MAX_FILES) {
                dropZone.style.display = 'none'; 
            } else {
                dropZone.style.display = 'block';
            }
        }
        
        function eliminarArchivo(index) {
            const dt = new DataTransfer();
            const files = fileStore.files;
            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
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
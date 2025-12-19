<?php
    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../../index.php");
        exit;
    }
    $page_6 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/conexion.php'; 
    $id_profesor = $_SESSION['id_usuario'];
    $avatar = $_SESSION['avatar'] ?? 'default.png';
    $institutos_path = __DIR__ . '/../json/institutos.json'; 
    $institutos = file_exists($institutos_path) ? json_decode(file_get_contents($institutos_path), true) : [];
    $profesor_data = null;
    $stmt = $conn->prepare("SELECT nombres, apellido_paterno, apellido_materno, campus FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_profesor);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        $profesor_data = $resultado->fetch_assoc();
    }
    $stmt->close();
    $valores_unidades = [];
    $stmt_valores = $conn->prepare("SELECT id_unidad, examen_valor, actividad_valor, asistencia_valor, proyecto_final_valor FROM alumnos_valores_calificar WHERE id_unidad BETWEEN 1 AND 5 ORDER BY id_unidad");
    if ($stmt_valores) {
        $stmt_valores->execute();
        $resultado_valores = $stmt_valores->get_result();
        while ($fila = $resultado_valores->fetch_assoc()) {
            $valores_unidades[$fila['id_unidad']] = $fila;
        }
        $stmt_valores->close();
    }

$alumnos = [];
    $sql_alumnos = "SELECT a.nocontrol, u.nombres, u.apellido_paterno, u.apellido_materno 
                    FROM alumnos a
                    JOIN usuarios u ON a.id_usuario = u.id_usuario
                    WHERE u.id_tipo_usuario = 3
                    ORDER BY u.apellido_paterno, u.apellido_materno, u.nombres";
    
    $stmt_alumnos = $conn->prepare($sql_alumnos);
    if ($stmt_alumnos) {
        $stmt_alumnos->execute();
        $resultado_alumnos = $stmt_alumnos->get_result();
        while ($fila_alumno = $resultado_alumnos->fetch_assoc()) {
            $alumnos[] = $fila_alumno;
        }
        $stmt_alumnos->close();
    }
    $timer_data = [
        'timer_profesor_min' => 20,
        'timer_alumno_min' => 20   
    ];

    $conn->query("INSERT INTO timer_login (id, timer_profesor, timer_alumno) VALUES (1, 1200000, 1200000) ON DUPLICATE KEY UPDATE id=id");

    $stmt_timer = $conn->prepare("SELECT timer_profesor, timer_alumno FROM timer_login WHERE id = 1");
    if ($stmt_timer) {
        $stmt_timer->execute();
        $resultado_timer = $stmt_timer->get_result();
        if ($resultado_timer->num_rows > 0) {
            $fila_timer = $resultado_timer->fetch_assoc();
            $timer_data['timer_profesor_min'] = $fila_timer['timer_profesor'] / 60000;
            $timer_data['timer_alumno_min'] = $fila_timer['timer_alumno'] / 60000;
        }
        $stmt_timer->close();
    }

    if ($profesor_data === null) {
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }
    $nombre_completo = htmlspecialchars($profesor_data['nombres'] . ' ' . $profesor_data['apellido_paterno']);
    $num1 = rand(1, 9);
    $num2 = rand(1, 9);
    $_SESSION['captcha_answer'] = $num1 + $num2;
?>
<style>
    body {
        background-color: #f8f9fa;
        color: #212529;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .card {
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #dee2e6;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .form-control {
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #ced4da;
    }
     .form-control:focus {
        background-color: #ffffff;
        color: #212529;
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
    }
    .form-control::placeholder {
        color: #6c757d;
    }
    .form-floating > label {
        color: #6c757d; 
    }
    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
    }
    .text-muted {
        color: #6c757d !important;
    }
    .modal-content {
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #dee2e6;
    }
    .modal-header,
    .modal-footer {
        border-bottom-color: #dee2e6;
        border-top-color: #dee2e6;
    }
    .btn-close {
        filter: none;
    }
    body.light-mode {
        background-color: #212529;
        color: #f8f9fa;
    }
    body.light-mode .card {
        background-color: #343a40;
        color: #f8f9fa;
        border: 1px solid #495057;
    }
    body.light-mode .card-header {
        background-color: #495057;
        border-bottom: 1px solid #495057;
    }
    body.light-mode .form-control {
        background-color: #495057;
        color: #f8f9fa;
        border: 1px solid #6c757d;
    }
    body.light-mode .form-control:focus {
        background-color: #495057;
        color: #f8f9fa;
    }
    body.light-mode .form-control:-webkit-autofill,
    body.light-mode .form-control:-webkit-autofill:hover, 
    body.light-mode .form-control:-webkit-autofill:focus, 
    body.light-mode .form-control:-webkit-autofill:active  {
        -webkit-box-shadow: 0 0 0 30px #495057 inset !important;
        -webkit-text-fill-color: #f8f9fa !important;
        caret-color: #f8f9fa;
    }
    body.light-mode .form-control::placeholder {
        color: #adb5bd;
    }
    body.light-mode .form-floating > label {
        color: #adb5bd;
    }
    body.light-mode .alert-success {
        background-color: #198754;
        color: #ffffff;
    }
    body.light-mode .alert-danger {
        background-color: #dc3545;
        color: #ffffff;
    }
    body.light-mode .text-muted {
        color: #adb5bd !important;
    }
    body.light-mode .modal-content {
        background-color: #343a40;
        color: #f8f9fa;
        border: 1px solid #495057;
    }
    body.light-mode .modal-header, 
    body.light-mode .modal-footer {
        border-bottom-color: #495057;
        border-top-color: #495057;
    }
    body.light-mode .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .ui-autocomplete {
        z-index: 1056;
    }
    .ui-autocomplete {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
    }
    .ui-menu-item .ui-menu-item-wrapper {
        color: #212529;
    }
    .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
        background-color: #0d6efd;
        color: #ffffff;
    }
    body.light-mode .ui-autocomplete {
        background-color: #343a40;
        border: 1px solid #495057;
    }
    body.light-mode .ui-menu-item .ui-menu-item-wrapper {
        color: #f8f9fa;
    }
    body.light-mode .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
        background-color: #0d6efd;
        color: #ffffff;
    }
    body.light-mode .form-floating > label {
        background-color: transparent !important;
        color: #ffffff !important;
    }
    body.light-mode .form-floating > .form-control:focus ~ label,
    body.light-mode .form-floating > .form-control:not(:placeholder-shown) ~ label {
        background-color: transparent !important;
        color: #ffffff !important;
    }
    body.light-mode .form-floating label::before,
    body.light-mode .form-floating label::after {
        background: none !important;
    }
</style>
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container my-5 ajustes-page">          
            <h1 class="mb-4"><i class="bi bi-gear-fill"></i> Ajustes Generales</h1>
            <?php
                if (isset($_SESSION['success_ajustes'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>' . $_SESSION['success_ajustes'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    unset($_SESSION['success_ajustes']);
                }
                if (isset($_SESSION['error_ajustes'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>' . $_SESSION['error_ajustes'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    unset($_SESSION['error_ajustes']);
                }
            ?>
            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-person-fill-gear"></i> Modificar Datos del Profesor</h5>
                        </div>
                        <div class="card-body">
                            <form action="../modelo/login_profesor/ajustes_controller.php" method="POST" id="ajustesForm">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombreProfesor" name="nombreProfesor" placeholder="" value="<?php echo htmlspecialchars($profesor_data['nombres']); ?>" required>
                                    <label for="nombreProfesor">Nombre(s)</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="apaternoProfesor" name="apaternoProfesor" placeholder="" value="<?php echo htmlspecialchars($profesor_data['apellido_paterno']); ?>" required>
                                            <label for="apaternoProfesor">Apellido Paterno</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="amaternoProfesor" name="amaternoProfesor" placeholder="" value="<?php echo htmlspecialchars($profesor_data['apellido_materno']); ?>" required>
                                            <label for="amaternoProfesor">Apellido Materno</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="campus_autocompletado_profesor" placeholder="Escribe tu campus..." value="" required>
                                    <label for="campus_autocompletado_profesor">Campus</label>
                                    <input type="hidden" id="campusProfesor" name="campusProfesor" value="<?php echo htmlspecialchars($profesor_data['campus']); ?>">
                                </div>
                                <hr class="my-4">
                                <p class="small text-muted">Para cambiar tu contraseña, completa los siguientes campos. De lo contrario, déjalos vacíos.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="nuevaContrasena" name="nuevaContrasena" placeholder="Nueva Contraseña (Opcional)">
                                            <label for="nuevaContrasena">Nueva Contraseña (Opcional)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena" placeholder="Confirmar Contraseña (Opcional)">
                                            <label for="confirmarContrasena">Confirmar Contraseña</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" id="btnGuardarCambiosProfesor" disabled>
                                        <i class="bi bi-save-fill"></i> Guardar Cambios
                                    </button>
                                </div>
                                </form>
                            </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-image-fill"></i> Avatar del Perfil</h5>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center p-4">
                            
                            <img src="/assets/images/avatar/<?php echo htmlspecialchars($avatar); ?>" 
                                alt="Avatar de <?php echo $nombre_completo; ?>" 
                                class="img-fluid rounded-circle mb-3 shadow-sm" 
                                id="avatarPreviewMain" 
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #dee2e6;">
                            
                            <h5 class="card-title mb-1"><?php echo $nombre_completo; ?></h5>
                            <p class="card-text text-muted mb-3">Profesor</p>
                            
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAvatarProfesor">
                                <i class="bi bi-camera-fill me-1"></i> Cambiar Avatar
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-journal-check"></i> Valores de Calificación por Unidad</h5>
                        </div>
                        <div class="card-body">
                            <form action="../modelo/login_profesor/valores_calificacion_controller.php" method="POST" id="valoresForm">
                                <p class="small text-muted">
                                    Define el peso porcentual del examen y las actividades para cada unidad. <strong>La suma de ambos debe ser 100.</strong>
                                </p>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php
                                        $examen_val = $valores_unidades[$i]['examen_valor'] ?? null;
                                        $actividad_val = $valores_unidades[$i]['actividad_valor'] ?? null;
                                        $asistencia_val = $valores_unidades[$i]['asistencia_valor'] ?? null; 
                                        $proyecto_val = $valores_unidades[$i]['proyecto_final_valor'] ?? null; 

                                        $examen_display = $examen_val !== null ? htmlspecialchars($examen_val) : '';
                                        $actividad_display = $actividad_val !== null ? htmlspecialchars($actividad_val) : '';
                                        $asistencia_display = $asistencia_val !== null ? htmlspecialchars($asistencia_val) : '';
                                        $proyecto_display = $proyecto_val !== null ? htmlspecialchars($proyecto_val) : ''; 
                                    ?>
                                    <h6 class="mt-4">Unidad <?php echo $i; ?></h6>
                                    
                                    <div class="row g-2"> <div class="col-sm-6 col-md">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="examen_unidad_<?php echo $i; ?>" name="valores[<?php echo $i; ?>][examen]" placeholder="Valor Examen (%)" value="<?php echo $examen_display; ?>" min="0" max="100">
                                                <label for="examen_unidad_<?php echo $i; ?>">Valor Examen (%)</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 col-md">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="actividad_unidad_<?php echo $i; ?>" name="valores[<?php echo $i; ?>][actividad]" placeholder="Valor Actividades (%)" value="<?php echo $actividad_display; ?>" min="0" max="100">
                                                <label for="actividad_unidad_<?php echo $i; ?>">Valor Actividades (%)</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="asistencia_unidad_<?php echo $i; ?>" name="valores[<?php echo $i; ?>][asistencia]" placeholder="Asistencia (%)" value="<?php echo $asistencia_display; ?>" min="0" max="100">
                                                <label for="asistencia_unidad_<?php echo $i; ?>">Asistencia (%)</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="proyecto_final_unidad_<?php echo $i; ?>" name="valores[<?php echo $i; ?>][proyecto_final]" placeholder="Proyecto (%)" value="<?php echo $proyecto_display; ?>" min="0" max="100">
                                                <label for="proyecto_final_unidad_<?php echo $i; ?>">Proyecto (%)</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md d-flex align-items-center justify-content-sm-center justify-content-md-center">
                                            <h5 class="my-2 my-md-0">
                                                <span class="badge bg-secondary" id="suma_unidad_<?php echo $i; ?>">Suma: 0%</span>
                                            </h5>
                                        </div>

                                    </div> <?php endfor; ?>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4" id="btnGuardarValores">
                                        <i class="bi bi-save-fill"></i> Guardar Valores de Calificación
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-clock-fill"></i> Configurar Tiempo de Inactividad</h5>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <p class="text-center">Configura el tiempo (en minutos) tras el cual se cerrará la sesión por inactividad.</p>
                            <form action="../modelo/login_profesor/timer_controller.php" method="POST" id="timerForm" class="flex-fill d-flex flex-column justify-content-center">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="timer_alumno" name="timer_alumno" placeholder="Tiempo inactividad Alumnos (Minutos):" value="<?php echo htmlspecialchars($timer_data['timer_alumno_min']); ?>" min="1" max="120" required>
                                    <label for="timer_alumno">Tiempo inactividad Alumnos (Minutos):</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="timer_profesor" name="timer_profesor" placeholder="Tiempo inactividad Profesor (Minutos):" value="<?php echo htmlspecialchars($timer_data['timer_profesor_min']); ?>" min="1" max="120" required>
                                    <label for="timer_profesor">Tiempo inactividad Profesor (Minutos):</label>
                                </div>
                                <div class="text-center mt-auto">
                                    <button type="submit" class="btn btn-primary" id="btnGuardarTimer" disabled>
                                        <i class="bi bi-save-fill"></i> Guardar Cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-download"></i> Descargar Material</h5>
                        </div>
                        <div class="card-body d-flex flex-column gap-2 p-4">
                            <p class="text-muted small mb-2">Descargas rápidas de tus reportes actuales.</p>
                            <a href="download_pdf/exportar_alumnos_pdf.php" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Lista de Alumnos
                            </a>
                            <a href="download_pdf/exportar_calificaciones_act_pdf.php" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Calif. Actividades
                            </a>
                            <a href="download_pdf/exportar_calificaciones_examen_pdf.php" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Calif. Examen
                            </a>
                            <a href="download_pdf/exportar_calificaciones_pdf.php" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Calif. Finales
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm h-100 border-danger">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> Zona de Eliminación</h5>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4 text-center">
                                <h5 class="card-title text-danger mt-2">Borrar datos de Alumnos</h5>
                                <p class="card-text text-muted small">
                                    Esta acción archiva los datos actuales y borra todo los datos.
                                </p>
                                <button type="button" class="btn btn-danger btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#modalReiniciarCiclo">
                                    <i class="bi bi-radioactive"></i> Iniciar Proceso de Borrado
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalReiniciarCiclo" tabindex="-1" aria-labelledby="modalReiniciarCicloLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-danger">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalReiniciarCicloLabel">
                                    <i class="bi bi-shield-exclamation"></i> Confirmar Reinicio de Ciclo
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-light border mb-4">
                                    <h6 class="alert-heading fw-bold text-dark"><i class="bi bi-cloud-arrow-down"></i> Paso 1: Archivos a respaldar</h6>
                                    <p class="mb-2 small text-muted">Estos son los archivos que se descargarán automáticamente al confirmar.</p>
                                    <div class="row g-2" id="listaDescargas">
                                        <div class="col-md-6">
                                            <a href="download_pdf/respaldar_alumnos.php" target="_blank" class="btn btn-outline-secondary w-100 btn-sm download-trigger"><i class="bi bi-download"></i>  Lista de Alumnos</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="download_pdf/exportar_calificaciones_act_pdf.php" target="_blank" class="btn btn-outline-secondary w-100 btn-sm download-trigger"><i class="bi bi-download"></i>  Calif. Actividades</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="download_pdf/exportar_calificaciones_examen_pdf.php" target="_blank" class="btn btn-outline-secondary w-100 btn-sm download-trigger"><i class="bi bi-download"></i>  Calif. Exámenes</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="download_pdf/exportar_calificaciones_pdf.php" target="_blank" class="btn btn-outline-secondary w-100 btn-sm download-trigger"><i class="bi bi-download"></i>  Calif. Finales</a>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="fw-bold text-danger"><i class="bi bi-database-down"></i> Paso 2: Verificación de Seguridad</h6>
                                <p class="text-muted small">
                                    Para ejecutar esta acción, escribe tu contraseña y la palabra clave <strong>ELIMINARTODO</strong>.
                                </p>
                                <form action="../modelo/login_profesor/reiniciar_ciclo_controller.php" method="POST" id="formReiniciarCiclo">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="passwordConfirmarReinicio" name="password_confirmacion" placeholder="Contraseña" required>
                                        <label for="passwordConfirmarReinicio">Ingresa tu contraseña actual</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="passwordConfirmarReinicio2" name="password_confirmacion_2" placeholder="Confirmar Contraseña" required>
                                        <label for="passwordConfirmarReinicio2">Confirma tu contraseña</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-danger text-danger fw-bold" 
                                            id="txtPalabraClave" 
                                            name="palabra_clave" 
                                            placeholder="ELIMINARTODO" 
                                            autocomplete="off" 
                                            onpaste="return false;" 
                                            ondrop="return false;"
                                            required>
                                        <label for="txtPalabraClave" class="text-danger">Escribe exactamente: ELIMINARTODO</label>
                                        <div class="form-text text-muted">No es posible copiar y pegar este texto.</div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnConfirmarReinicio" disabled>
                                    <i class="bi bi-trash-fill"></i> Confirmar y Descargar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
    <div class="modal fade" id="confirmAjustesModal" tabindex="-1" aria-labelledby="confirmAjustesModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmAjustesModalLabel"><i class="bi bi-shield-lock-fill"></i> Confirmar Cambios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Para guardar los cambios, por favor ingresa tu contraseña actual y resuelve la verificación.</p>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="antiguaContrasena" name="antiguaContrasena" placeholder="Antigua Contraseña" required form="ajustesForm">
                        <label for="antiguaContrasena">Contraseña Actual (Obligatoria)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="captcha" name="captcha" placeholder="Resuelve la suma" required form="ajustesForm">
                        <label for="captcha">Verificación: ¿Cuánto es <?php echo $num1; ?> + <?php echo $num2; ?>?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="ajustesForm">
                        <i class="bi bi-save-fill"></i> Confirmar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAvatarProfesor" tabindex="-1" aria-labelledby="modalAvatarProfesorLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="../modelo/login_profesor/avatar_controller.php" enctype="multipart/form-data" id="avatarForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAvatarProfesorLabel">Actualizar Avatar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Selecciona una nueva imagen para tu perfil (Max. 2MB).</p>
                        
                        <img id="previewAvatarModal" class="img-fluid rounded-circle d-none" 
                            alt="Vista previa del nuevo avatar" 
                            style="width: 200px; height: 200px; object-fit: cover; margin-bottom: 1.5rem; border: 3px solid #dee2e6;">

                        <input type="file" name="nuevo_avatar" class="form-control" 
                            accept="image/png, image/jpeg, image/gif" 
                            required id="inputAvatarFile">
                            
                        <div class="text-danger small mt-2" id="avatarError" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnSubirAvatar" disabled>
                            <i class="bi bi-upload"></i> Subir Avatar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
<?php
    include_once __DIR__ . '/scripts/script_menu_ajustes_1.php';
?>
<script>
    $(document).ready(function() {
        const $passInput = $('#passwordConfirmarReinicio');
        const $passInputConfirm = $('#passwordConfirmarReinicio2'); 
        const $keywordInput = $('#txtPalabraClave');
        const $btnConfirmar = $('#btnConfirmarReinicio');
        const palabraRequerida = "ELIMINARTODO";

        function validarReinicio() {
            const pass = $passInput.val();
            const passConfirm = $passInputConfirm.val(); 
            const palabra = $keywordInput.val();

            const contrasenasCoinciden = (pass.length > 0) && (pass === passConfirm);
            const palabraCorrecta = (palabra === palabraRequerida);

            if (contrasenasCoinciden && palabraCorrecta) {
                $btnConfirmar.prop('disabled', false);
                $keywordInput.removeClass('border-danger text-danger').addClass('border-success text-success');
                $passInputConfirm.addClass('is-valid').removeClass('is-invalid');
                $passInput.removeClass('is-invalid');
            } else {
                $btnConfirmar.prop('disabled', true);
                
                if (!palabraCorrecta && palabra.length > 0) {
                     $keywordInput.removeClass('border-success text-success').addClass('border-danger text-danger');
                } else if(palabraCorrecta) {
                     $keywordInput.removeClass('border-danger text-danger').addClass('border-success text-success');
                }

                if(passConfirm.length > 0 && !contrasenasCoinciden) {
                    $passInputConfirm.addClass('is-invalid').removeClass('is-valid');
                } else {
                    $passInputConfirm.removeClass('is-invalid');
                }
            }
        }

        $passInput.on('input', function() { $(this).removeClass('is-invalid'); validarReinicio(); });
        $passInputConfirm.on('input', validarReinicio);
        $keywordInput.on('input keyup', validarReinicio);


        $btnConfirmar.click(async function(e) {
            e.preventDefault();
            
            if ($keywordInput.val() !== palabraRequerida) return;

            const textoOriginal = $(this).html();
            $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verificando...');

            try {
                const response = await fetch('/assets/modelo/login_profesor/verificar_password.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ password: $passInput.val() })
                });

                const data = await response.json();

                if (data.success) {
                    $btnConfirmar.html('<i class="bi bi-check-circle"></i> Verificado');
                    $btnConfirmar.removeClass('btn-danger').addClass('btn-success');

                    alert("Credenciales verificadas. Iniciando descargas de seguridad...");
                    
                    $('.download-trigger').each(function(index) {
                        let url = $(this).attr('href');
                        setTimeout(function() {
                            window.open(url, '_blank');
                        }, index * 800);
                    });

                    setTimeout(() => {
                         $('#formReiniciarCiclo').submit();
                    }, 4000); 

                } else {
                    alert("Error: " + (data.message || "La contraseña no coincide con la base de datos."));
                    
                    $(this).prop('disabled', false).html(textoOriginal);
                    
                    $passInput.addClass('is-invalid');
                    $passInputConfirm.addClass('is-invalid');
                }

            } catch (error) {
                console.error('Error:', error);
                alert("Error de conexión al verificar la contraseña.");
                $(this).prop('disabled', false).html(textoOriginal);
            }
        });
    });
</script>
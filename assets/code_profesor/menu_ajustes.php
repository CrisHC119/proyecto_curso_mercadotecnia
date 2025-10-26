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
    $stmt_valores = $conn->prepare("SELECT id_unidad, examen_valor, actividad_valor FROM alumnos_valores_calificar WHERE id_unidad BETWEEN 1 AND 5 ORDER BY id_unidad");
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
    // --- FIN NUEVO ---

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
            </div> <div class="row">
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
                                        $examen_display = $examen_val !== null ? htmlspecialchars($examen_val) : '';
                                        $actividad_display = $actividad_val !== null ? htmlspecialchars($actividad_val) : '';
                                    ?>
                                    <h6 class="mt-4">Unidad <?php echo $i; ?></h6>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-floating">
                                                <input type="number" class="form-control mb-4" id="examen_unidad_<?php echo $i; ?>" name="valores[<?php echo $i; ?>][examen]" placeholder="Valor Examen (%)" value="<?php echo $examen_display; ?>" min="0" max="100">
                                                <label for="examen_unidad_<?php echo $i; ?>">Valor Examen (%)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-floating">
                                                <input type="number" class="form-control mb-4" id="actividad_unidad_<?php echo $i; ?>" name="valores[<?php echo $i; ?>][actividad]" placeholder="Valor Actividades (%)" value="<?php echo $actividad_display; ?>" min="0" max="100">
                                                <label for="actividad_unidad_<?php echo $i; ?>">Valor Actividades (%)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center justify-content-start">
                                            <h5 class="mb-3"><span class="badge bg-secondary" id="suma_unidad_<?php echo $i; ?>">Suma: 0%</span></h5>
                                        </div>
                                    </div>
                                <?php endfor; ?>
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
                <div class="col-lg-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-download"></i> Descargar Material</h5>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                            <p>Genera reportes y descarga listas de tus alumnos.</p>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalListaAlumnos">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Ver y Descargar Lista de Alumnos
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
    <div class="modal fade" id="modalListaAlumnos" tabindex="-1" aria-labelledby="modalListaAlumnosLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalListaAlumnosLabel"><i class="bi bi-people-fill"></i> Lista de Alumnos Registrados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>La siguiente tabla contiene todos los alumnos registrados. Puedes descargar esta lista como un PDF usando el botón al final.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tabla-lista-alumnos">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>No. Control</th> <th>Nombre(s)</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($alumnos)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay alumnos registrados.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($alumnos as $alumno): ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo htmlspecialchars($alumno['nocontrol']); ?></td> <td><?php echo htmlspecialchars($alumno['nombres']); ?></td>
                                            <td><?php echo htmlspecialchars($alumno['apellido_paterno']); ?></td>
                                            <td><?php echo htmlspecialchars($alumno['apellido_materno']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btnDescargarAlumnosPDF" <?php echo empty($alumnos) ? 'disabled' : ''; ?>>
                        <i class="bi bi-file-earmark-pdf-fill"></i> Descargar PDF
                    </button>
                </div>
            </div>
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


<script>
    const institutos = <?php echo json_encode($institutos); ?>;
    const etiquetas = Object.keys(institutos).map(clave => ({
        label: institutos[clave],
        value: clave
    }));
    function sinTildes(texto) {
        if (typeof texto !== 'string') return '';
        return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }
    $(function () {
        const $botonGuardar = $('#btnGuardarCambiosProfesor');
        const modalAjustes = new bootstrap.Modal(document.getElementById('confirmAjustesModal'));
        const valoresIniciales = {
            nombre: "<?php echo htmlspecialchars($profesor_data['nombres']); ?>",
            apaterno: "<?php echo htmlspecialchars($profesor_data['apellido_paterno']); ?>",
            amaterno: "<?php echo htmlspecialchars($profesor_data['apellido_materno']); ?>",
            campus: "<?php echo htmlspecialchars($profesor_data['campus']); ?>"
        };
        function verificarCambios() {
            const nombreActual = $('#nombreProfesor').val();
            const apaternoActual = $('#apaternoProfesor').val();
            const amaternoActual = $('#amaternoProfesor').val();
            const campusActual = $('#campusProfesor').val();
            const nuevaPassActual = $('#nuevaContrasena').val();
            const confirmarPassActual = $('#confirmarContrasena').val();
            const datosPersonalesCambiados = 
                nombreActual !== valoresIniciales.nombre ||
                apaternoActual !== valoresIniciales.apaterno ||
                amaternoActual !== valoresIniciales.amaterno ||
                campusActual !== valoresIniciales.campus;
            const contrasenaCambiada = nuevaPassActual !== '' || confirmarPassActual !== '';
            $botonGuardar.prop('disabled', !(datosPersonalesCambiados || contrasenaCambiada));
        }
        $('#nombreProfesor, #apaternoProfesor, #amaternoProfesor, #nuevaContrasena, #confirmarContrasena').on('input', verificarCambios);
        $("#campus_autocompletado_profesor").autocomplete({
            source: function (request, response) {
                const termino = sinTildes(request.term);
                const resultados = etiquetas.filter(item => sinTildes(item.label).includes(termino));
                response(resultados);
            },
            minLength: 1,
            select: function (event, ui) {
                $("#campus_autocompletado_profesor").val(ui.item.label); 
                $("#campusProfesor").val(ui.item.value);
                verificarCambios();
                return false;
            },
        });
        const claveActual = $("#campusProfesor").val();
        if (claveActual && institutos[claveActual]) {
            $("#campus_autocompletado_profesor").val(institutos[claveActual]);
        }
        $("#campus_autocompletado_profesor").on('input', function() {
            const textoVisible = $(this).val().trim();
            const match = etiquetas.find(item => sinTildes(item.label) === sinTildes(textoVisible));
            if (match) {
                $("#campusProfesor").val(match.value);
            } else {
                $("#campusProfesor").val("");
            }
            verificarCambios();
        });
        $botonGuardar.on('click', function() {
            const nombre = $('#nombreProfesor').val().trim();
            const apaterno = $('#apaternoProfesor').val().trim();
            const amaterno = $('#amaternoProfesor').val().trim();
            const nombreCampus = $("#campus_autocompletado_profesor").val().trim();
            const claveCampus = $("#campusProfesor").val().trim();
            if (nombre === '' || apaterno === '' || amaterno === '') {
                 alert("Por favor, completa todos los campos de nombre y apellidos.");
                 if (nombre === '') $('#nombreProfesor').focus();
                 else if (apaterno === '') $('#apaternoProfesor').focus();
                 else $('#amaternoProfesor').focus();
                 return;
            }
            if (nombreCampus === "") {
                 alert("Por favor, ingresa el nombre de tu campus.");
                 $("#campus_autocompletado_profesor").focus();
                 return;
            }
            if (claveCampus === "") {
                 alert("El campus '" + nombreCampus + "' no es válido. Por favor, selecciónelo de la lista desplegable.");
                 $("#campus_autocompletado_profesor").focus();
                 return;
            }
            modalAjustes.show();
        });
        
        // --- Lógica para el modal de Avatar ---
        const modalAvatarEl = document.getElementById('modalAvatarProfesor');
        const inputAvatarFile = document.getElementById('inputAvatarFile');
        // ... (resto de tu código de avatar sin cambios) ...
        function resetAvatarModal() {
            // ... (tu código) ...
        }
        modalAvatarEl.addEventListener('show.bs.modal', resetAvatarModal);
        inputAvatarFile.addEventListener('change', function() {
            // ... (tu código de validación de avatar) ...
        });

        // --- Lógica para el formulario de Valores de Calificación ---
        function actualizarSumaUnidad(unidadId) {
            const $examenInput = $('#examen_unidad_' + unidadId);
            const $actividadInput = $('#actividad_unidad_' + unidadId);
            const $sumaBadge = $('#suma_unidad_' + unidadId);
            const examenValStr = $examenInput.val();
            const actividadValStr = $actividadInput.val();
            if (examenValStr === '' && actividadValStr === '') {
                 $sumaBadge.text('Suma: N/A');
                 $sumaBadge.removeClass('bg-success bg-danger').addClass('bg-secondary');
                 return;
            }
            if (examenValStr === '' || actividadValStr === '') {
                 $sumaBadge.text('Suma: N/A');
                 $sumaBadge.removeClass('bg-success bg-secondary').addClass('bg-danger');
                 return;
            }
            const examenVal = parseInt(examenValStr) || 0;
            const actividadVal = parseInt(actividadValStr) || 0;
            const suma = examenVal + actividadVal;
            $sumaBadge.text('Suma: ' + suma + '%');
            if (suma === 100) {
                $sumaBadge.removeClass('bg-secondary bg-danger').addClass('bg-success');
            } else {
                $sumaBadge.removeClass('bg-secondary bg-success').addClass('bg-danger');
            }
        }

        /**
         * --- NUEVA FUNCIÓN ---
         * Valida todos los campos de calificación y habilita/deshabilita el botón de guardar.
         */
        function validarTodosLosValores() {
            const $botonValores = $('#btnGuardarValores');
            let todoValido = true; // Asumimos que todo está bien al inicio

            for (let i = 1; i <= 5; i++) {
                const examenVal = $('#examen_unidad_' + i).val();
                const actividadVal = $('#actividad_unidad_' + i).val();

                // Caso 1: Ambos vacíos (Válido)
                if (examenVal === '' && actividadVal === '') {
                    continue; // Pasa a la siguiente unidad
                }

                // Caso 2: Uno vacío, otro no (Inválido)
                if ((examenVal === '' && actividadVal !== '') || (examenVal !== '' && actividadVal === '')) {
                    todoValido = false;
                    break; // Encontramos un error, no es necesario seguir
                }
                
                // Caso 3: Ambos llenos (Validar suma)
                // Usamos || 0 por si el usuario borra y deja un campo no numérico (aunque el input type=number ayuda)
                const suma = (parseInt(examenVal) || 0) + (parseInt(actividadVal) || 0);
                if (suma !== 100) {
                    todoValido = false;
                    break; // Encontramos un error, no es necesario seguir
                }
            }
            
            // Habilita el botón si 'todoValido' es true, lo deshabilita si es false
            $botonValores.prop('disabled', !todoValido);
        }

        // --- MODIFICADO ---
        // Bucle para inicializar y asignar listeners
        for (let i = 1; i <= 5; i++) {
            actualizarSumaUnidad(i); // Actualiza el badge al cargar
            
            // Asigna el listener de 'input'
            $('#examen_unidad_' + i + ', #actividad_unidad_' + i).on('input', function() {
                actualizarSumaUnidad(i);   // Actualiza el badge
                validarTodosLosValores();  // Valida y actualiza el botón
            });
        }
        
        // --- AÑADIDO ---
        // Ejecuta la validación una vez al cargar la página
        // para establecer el estado inicial correcto del botón
        validarTodosLosValores();

        // Validación de submit (como doble chequeo, aunque el botón debería estar deshabilitado)
        $('#valoresForm').on('submit', function(e) {
            let allValid = true;
            let firstErrorUnit = -1;
            for (let i = 1; i <= 5; i++) {
                const $examenInput = $('#examen_unidad_' + i);
                const $actividadInput = $('#actividad_unidad_' + i);
                const examenVal = $examenInput.val();
                const actividadVal = $actividadInput.val();
                if (examenVal === '' && actividadVal === '') {
                    continue;
                }
                if ((examenVal === '' && actividadVal !== '') || (examenVal !== '' && actividadVal === '')) {
                    allValid = false;
                    firstErrorUnit = i;
                    alert('Error en Unidad ' + i + ': Debe completar AMBOS valores (Examen y Actividades) o dejar AMBOS vacíos.');
                    break;
                }
                const suma = parseInt(examenVal) + parseInt(actividadVal);
                if (suma !== 100) {
                    allValid = false;
                    firstErrorUnit = i;
                    alert('Error en Unidad ' + i + ': La suma de los valores debe ser 100. Actualmente suma ' + suma + '%.');
                    break;
                }
            }
            if (!allValid) {
                e.preventDefault();
                if (firstErrorUnit !== -1) {
                    $('#examen_unidad_' + firstErrorUnit).focus();
                }
            }
        });
document.getElementById("btnDescargarAlumnosPDF").addEventListener("click", function () {
    try {
        const doc = new jsPDF();

        doc.text("Lista de Alumnos", 14, 20);

        doc.autoTable({
            html: '#tabla-lista-alumnos',
            startY: 30,
            styles: { fontSize: 10, cellPadding: 2 },
            headStyles: { fillColor: [52, 58, 64] }
        });

        doc.save("lista_alumnos.pdf");
    } catch (error) {
        console.error("Error al generar el PDF:", error);
        alert("Hubo un error al generar el PDF. Ver consola para más detalles.");
    }
});


        // --- FIN NUEVO ---
    });
</script>

</body>
</html>

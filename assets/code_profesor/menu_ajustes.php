<?php
    $page_6 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/conexion.php'; 
?>
<style>
    /* =================================================================== */
    /* ESTILOS PARA LA PÁGINA DE AJUSTES                     */
    /* Usando la clase contenedora ".ajustes-page" para evitar conflictos */
    /* =================================================================== */

    /* --- MODO CLARO (ESTILOS BASE DENTRO DE .ajustes-page) --- */
    .ajustes-page .card, 
    .ajustes-page .list-group-item {
        background-color: #ffffff;
        border-color: #dee2e6;
        color: #212529;
    }
    .ajustes-page .form-control {
        background-color: #fff;
        color: #212529;
        border-color: #ced4da;
    }
    .ajustes-page .form-floating > label {
        color: #6c757d;
    }
    .ajustes-page .list-group-item-action:hover {
        background-color: #f8f9fa;
    }
    
    /* --- MODO OSCURO (CUANDO BODY TIENE .dark-mode) --- */
    body.dark-mode .ajustes-page .card,
    body.dark-mode .ajustes-page .list-group-item {
        background-color: #2c2c2f;
        border-color: #444;
        color: #f1f1f1;
    }
    body.dark-mode .ajustes-page .card-header, 
    body.dark-mode .ajustes-page .card-footer {
        border-color: #444;
    }
    body.dark-mode .ajustes-page .list-group-item-action:hover {
        background-color: #3a3a3e;
    }
    body.dark-mode .ajustes-page .form-floating .form-control {
        background-color: #3a3a3e;
        color: #f1f1f1;
        border-color: #555;
    }
    body.dark-mode .ajustes-page .form-floating > label {
        color: #aaa;
    }
    body.dark-mode .ajustes-page .card.bg-danger {
        background-color: #5c1a22;
        border-color: #82202d;
    }
    
    /* --- MODAL DE ALTO CONTRASTE (Siempre oscuro, sin cambios) --- */
    .modal-content {
        background-color: #343a40; 
        color: #f1f1f1;
        border: 1px solid #555;
    }
    .modal-header, .modal-footer {
        border-color: #555; 
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100) brightness(200); 
    }
</style>
</head>

<body class="d-flex flex-column min-vh-100">

    <main class="flex-fill">
<div class="container my-5 ajustes-page">            
            <h1 class="mb-4">
                <i class="bi bi-gear-fill"></i> Ajustes Generales</h1>

            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-person-fill-gear"></i> Modificar Datos del Profesor</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombreProfesor" placeholder="">
                                    <label for="nombreProfesor">Nombre Completo</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="apaternoProfesor" placeholder="">
                                            <label for="apaternoProfesor">Apellido Paterno</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="amaternoProfesor" placeholder="">
                                            <label for="amaternoProfesor">Apellido Materno</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="emailProfesor" placeholder="">
                                    <label for="emailProfesor">Correo Electrónico</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="antiguaContrasena" placeholder="Nueva Contraseña">
                                    <label for="antiguaContrasena">Antigua Contraseña</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="nuevaContrasena" placeholder="Nueva Contraseña">
                                            <label for="nuevaContrasena">Nueva Contraseña (Opcional)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="confirmarContrasena" placeholder="Confirmar Contraseña">
                                            <label for="confirmarContrasena">Confirmar Contraseña (Opcional)</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-file-earmark-arrow-down-fill"></i> Exportar Datos</h5>
                        </div>
                        <div class="card-body">
                            <p>Genera reportes en PDF con los datos del ciclo actual.</p>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-file-earmark-person-fill me-2"></i>Reporte de Calificaciones Unidad 1</div>
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-file-earmark-person-fill me-2"></i>Reporte de Calificaciones Unidad 2</div>
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-file-earmark-person-fill me-2"></i>Reporte de Calificaciones Unidad 3</div>
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-file-earmark-person-fill me-2"></i>Reporte de Calificaciones Unidad 4</div>
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-file-earmark-person-fill me-2"></i>Reporte de Calificaciones Unidad 5</div>
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-file-earmark-person-fill me-2"></i>Reporte de Calificaciones General</div>
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-people-fill me-2"></i>Lista General de Alumnos</div>
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card text-white bg-danger border-danger shadow-lg">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> Zona de Peligro</h5>
                </div>
                <div class="card-body">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1"><strong>Reiniciar Ciclo del Curso</strong></p>
                            <p class="mb-md-0 small">Esta acción borrará permanentemente todos los datos de alumnos, calificaciones y progreso. No se puede deshacer.</p>
                        </div>
                        <button type="button" class="btn btn-light fw-bold mt-2 mt-md-0 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#confirmResetModal">
                            <i class="bi bi-trash3-fill"></i> Reiniciar Ciclo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="confirmResetModal" tabindex="-1" aria-labelledby="confirmResetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmResetModalLabel"><i class="bi bi-exclamation-triangle-fill"></i> Confirmación Requerida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está absolutamente seguro de que desea reiniciar el ciclo del curso?</p>
                    <p class="fw-bold text-danger">Esta acción borrará TODOS los datos de forma permanente. Es irreversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Sí, entiendo el riesgo, reiniciar</button>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

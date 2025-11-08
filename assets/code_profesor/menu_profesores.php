<?php
    $page_4 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/login_profesor/verificar_profesor.php';
    include_once __DIR__ . '/styles/style_menu_alumnos.php'; 
    $instituto_data = json_decode(file_get_contents(__DIR__ . '/../json/institutos.json'), true);
?>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-4 mb-5">
            <div class="d-md-flex justify-content-md-between align-items-md-center mb-4">
                <h1 class="h2 mb-0 text-center text-md-start mb-3 mb-md-0">
                    <i class="bi bi-person-workspace me-2"></i><?php echo $textos['personal_academico']; ?> 
                    <span class="badge bg-secondary align-middle"><?php echo $result->num_rows; ?></span>
                </h1>
                <?php if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] == 1): ?>
                <div class="text-center">         <button type="button" class="btn btn-primary w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#agregarPersonalModal">
                        <i class="bi bi-person-plus-fill me-2"></i><?php echo $textos['agregar_personal']; ?>
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador" class="form-control" placeholder="<?php echo $textos['buscador_profesor']; ?>">
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 g-4">
                <?php while ($usuario = $result->fetch_assoc()): ?>
                <?php
                    $clave_campus = $usuario['campus'];
                    $nombre_instituto = $instituto_data[$clave_campus] ?? $textos['no_instituto'];
                    $rol_badge_class = ($usuario['id_tipo_usuario'] == 1) ? 'bg-danger' : 'bg-info';
                    
                    $fecha_registro_formateada = 'No disponible';
                    if (!empty($usuario['fecha_registro'])) {
                        try {
                            $fecha_obj = new DateTime($usuario['fecha_registro']);
                            $fecha_registro_formateada = $fecha_obj->format('d/m/Y'); 
                        } catch (Exception $e) {
                            error_log("Error al formatear fecha: " . $e->getMessage());
                        }
                    }
                ?>
                <div class="col">
                    <div class="card shadow-sm h-100 usuario-card"> 
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-4 text-center mb-3 mb-sm-0">
                                    <img src="/assets/images/avatar/<?php echo htmlspecialchars($usuario['avatar']); ?>" class="avatar-card rounded-circle" alt="Avatar">
                                </div>
                                <div class="col-12 col-sm-8 text-center text-sm-start"> <h4 class="card-title mb-1"><?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellido_paterno']); ?></h4>
                                    <span class="badge <?php echo $rol_badge_class; ?> mb-2"><?php echo $usuario['rol']; ?></span>
                                    <p class="text-body-secondary mb-0">ID: <?php echo $usuario['id_usuario']; ?></p>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-building me-2 text-body-secondary"></i><?php echo $textos['instituto']; ?></span>
                                <strong><?php echo $nombre_instituto; ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><i class="bi bi-calendar-check me-2 text-body-secondary"></i><?php echo $textos['fecha_registro']; ?></span>
                                <strong><?php echo $fecha_registro_formateada; ?></strong>
                            </li>
                        </ul>
                        <div class="card-footer text-end border-0 pt-3">
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                data-bs-toggle="modal" 
                                data-bs-target="#detallesPersonalModal"
                                data-avatar="<?php echo htmlspecialchars($usuario['avatar']); ?>"
                                data-nombre-completo="<?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellido_paterno'] . ' ' . $usuario['apellido_materno']); ?>"
                                data-rol="<?php echo htmlspecialchars($usuario['rol']); ?>"
                                data-id-tipo-usuario="<?php echo htmlspecialchars($usuario['id_tipo_usuario']); ?>"
                                data-rol-class="<?php echo $rol_badge_class; ?>"
                                data-instituto="<?php echo htmlspecialchars($nombre_instituto); ?>"
                                data-id-usuario="<?php echo htmlspecialchars($usuario['id_usuario']); ?>"
                                data-fecha-registro="<?php echo htmlspecialchars($fecha_registro_formateada); ?>">
                                <i class="bi bi-person-vcard"></i> <?php echo $textos['ver_detalles']; ?>
                            </button>
                            <?php if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] == 1): ?>
                                <?php 
                                    if ($usuario['id_tipo_usuario'] != 1 && $usuario['id_usuario'] != $_SESSION['id_usuario']): 
                                ?>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarEliminarModal" data-id="<?php echo $usuario['id_usuario']; ?>">
                                    <i class="bi bi-trash-fill"></i> <?php echo $textos['eliminar']; ?>
                                </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    <div class="modal fade" id="agregarPersonalModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formAgregarPersonal" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarModalLabel"><?php echo $textos['agregar_new_personal']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted"><?php echo $textos['aviso_new_personal']; ?></p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nombres" class="form-label"><?php echo $textos['nombre']; ?></label>
                                <input type="text" class="form-control" name="nombres" id="nombres" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="apellido_paterno" class="form-label"><?php echo $textos['a_paterno']; ?></label>
                                <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="apellido_materno" class="form-label"><?php echo $textos['a_materno']; ?></label>
                                <input type="text" class="form-control" name="apellido_materno" id="apellido_materno">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="matricula_personal" class="form-label"><?php echo $textos['login_matricula']; ?></label>
                                <input type="text" class="form-control" name="matricula_personal" id="matricula_personal" maxlength="40" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_provisional" class="form-label"><?php echo $textos['pass']; ?></label>
                                <input type="password" class="form-control" name="password_provisional" id="password_provisional" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="campus" class="form-label"><?php echo $textos['instituto']; ?></label>
                                <select class="form-select" name="campus" id="campus" required>
                                    <option value="" selected disabled><?php echo $textos['seleccionar_campus']; ?></option>
                                    <?php foreach ($instituto_data as $clave => $nombre): ?>
                                        <option value="<?php echo htmlspecialchars($clave); ?>"><?php echo htmlspecialchars($nombre); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="id_tipo_usuario" class="form-label"><?php echo $textos['rol_usuario']; ?></label>
                                <select class="form-select" name="id_tipo_usuario" id="id_tipo_usuario" required>
                                    <option value="2" selected><?php echo $textos['profesor']; ?></option>
                                    <option value="1"><?php echo $textos['admin']; ?></option>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="text-danger"><?php echo $textos['autorizar_admin']; ?></h6>
                        <p class="text-muted small"><?php echo $textos['aviso_autorizar_admin']; ?></p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="admin_password_crear" class="form-label"><?php echo $textos['pass_admin_requerida']; ?></label>
                                <input type="password" class="form-control" name="admin_password" id="admin_password_crear" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="admin_password_confirm_crear" class="form-label"><?php echo $textos['confirmar_pass']; ?></label>
                                <input type="password" class="form-control" id="admin_password_confirm_crear" required>
                            </div>
                        </div>
                        <div id="agregarError" class="text-danger mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cancelar']; ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo $textos['agregar_usuario']; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEliminar" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel"><?php echo $textos['confirmar_eliminacion']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong><?php echo $textos['atencion']; ?></strong> <?php echo $textos['confirmar_eliminar_usuario']; ?>
                        </div>
                        <input type="hidden" name="id_usuario_eliminar" id="id_usuario_eliminar">
                        <div class="mb-3">
                            <label for="admin_password" class="form-label"><?php echo $textos['pass_admin_requerida']; ?></label>
                            <input type="password" class="form-control" name="admin_password" id="admin_password" required>
                        </div>
                        <div id="eliminarError" class="text-danger mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cancelar']; ?></button>
                        <button type="submit" class="btn btn-danger"><?php echo $textos['confirmar_eliminacion']; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detallesPersonalModal" tabindex="-1" aria-labelledby="detallesPersonalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallesPersonalModalLabel"><i class="bi bi-person-vcard me-2"></i><?php echo $textos['detalle_personal']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modalIdUsuarioOculto" value="">     
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img id="modalAvatarPersonal" src="" class="img-fluid rounded-circle" alt="Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h3 id="modalNombreCompletoPersonal" class="mb-1"></h3>
                            <span id="modalRolPersonal" class="badge fs-6 mb-3"></span>
                            <p class="mb-2"><strong class="me-2"><?php echo $textos['instituto']; ?>:</strong><span id="modalInstitutoPersonal"></span></p>
                            <p class="mb-2"><strong class="me-2"><?php echo $textos['id_usuario']; ?></strong><span id="modalIdUsuarioPersonal"></span></p>
                            <p class="mb-0"><strong class="me-2"><?php echo $textos['fecha_registro']; ?>:</strong><span id="modalFechaRegistroPersonal"></span></p>                    </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            <button type="button" class="btn btn-success d-none" id="btnPromoverAdmin">
                                <i class="bi bi-arrow-up-circle me-1"></i> <?php echo $textos['promover_admin']; ?>
                            </button>
                            <button type="button" class="btn btn-warning d-none" id="btnDegradarProfesor">
                                <i class="bi bi-arrow-down-circle me-1"></i> <?php echo $textos['degradar_profesor']; ?>
                            </button>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cerrar']; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once __DIR__ . '/../code_general/footer.php'; ?>
<?php include_once __DIR__ . '/scripts/script_menu_profesores.php'; ?>
<?php include_once __DIR__ . '/styles/style_menu_profesores.php'; ?>
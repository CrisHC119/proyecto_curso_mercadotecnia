<?php
$page_4 = 'active';
include_once __DIR__ . '/code_general/navbar.php';
include_once __DIR__ . '/../modelo/conexion.php';
include_once __DIR__ . '/styles/style_menu_alumnos.php';
$instituto_data = json_decode(file_get_contents(__DIR__ . '/../json/institutos.json'), true);
$sql = "
SELECT 
    U.id_usuario, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar, U.id_tipo_usuario, U.campus,
    -- Asignamos el nombre del rol según el id_tipo_usuario
    CASE U.id_tipo_usuario
        WHEN 1 THEN 'Administrador'
        WHEN 2 THEN 'Profesor'
        ELSE 'Desconocido'
    END AS rol
FROM usuarios U
WHERE U.id_tipo_usuario IN (1, 2)
ORDER BY U.id_tipo_usuario, U.nombres;
";
$result = $conn->query($sql);
?>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0"><i class="bi bi-person-workspace me-2"></i>Personal Académico <span class="badge bg-secondary align-middle"><?php echo $result->num_rows; ?></span></h1>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarPersonalModal">
                    <i class="bi bi-person-plus-fill me-2"></i>Agregar Personal
                </button>
            </div>
        </div>
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador" class="form-control" placeholder="Buscar por nombre, rol...">
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 g-4">
                <?php while ($usuario = $result->fetch_assoc()): ?>
                    <?php
                        $clave_campus = $usuario['campus'];
                        $nombre_instituto = $instituto_data[$clave_campus] ?? $textos['no_instituto'];
                        
                        $rol_badge_class = ($usuario['id_tipo_usuario'] == 1) ? 'bg-danger' : 'bg-info';
                    ?>
                    <div class="col">
                        <div class="card shadow-sm h-100 usuario-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12 col-sm-4 text-center mb-3 mb-sm-0">
                                        <img src="/assets/images/avatar/<?php echo htmlspecialchars($usuario['avatar']); ?>" class="avatar-card rounded-circle" alt="Avatar">
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <h4 class="card-title mb-1"><?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellido_paterno']); ?></h4>
                                        <span class="badge <?php echo $rol_badge_class; ?> mb-2"><?php echo $usuario['rol']; ?></span>
                                        <p class="text-body-secondary mb-0">ID de Usuario: <?php echo $usuario['id_usuario']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="bi bi-building me-2 text-body-secondary"></i><?php echo $textos['instituto']; ?></span>
                                    <strong><?php echo $nombre_instituto; ?></strong>
                                </li>
                                </ul>
                            <div class="card-footer text-end border-0 pt-3">
                                <a href="/assets/code/admin/ver_detalles_personal.php?id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-person-vcard"></i> <?php echo $textos['ver_detalles']; ?>
                                </a>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarEliminarModal" data-id="<?php echo $usuario['id_usuario']; ?>">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    </main> <div class="modal fade" id="agregarPersonalModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formAgregarPersonal" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Nuevo Personal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Complete los datos del nuevo usuario.</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres" id="nombres" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_provisional" class="form-label">Contraseña Provisional</label>
                            <input type="password" class="form-control" name="password_provisional" id="password_provisional" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="campus" class="form-label">Campus/Instituto</label>
                            <select class="form-select" name="campus" id="campus" required>
                                <option value="" selected disabled>Seleccione un campus...</option>
                                <?php foreach ($instituto_data as $clave => $nombre): ?>
                                    <option value="<?php echo htmlspecialchars($clave); ?>"><?php echo htmlspecialchars($nombre); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_tipo_usuario" class="form-label">Rol del Usuario</label>
                            <select class="form-select" name="id_tipo_usuario" id="id_tipo_usuario" required>
                                <option value="2" selected>Profesor</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                    </div>
                    
                    <hr class="my-4">

                    <h6 class="text-danger">Autorización del Administrador</h6>
                    <p class="text-muted small">Para confirmar la creación, ingrese su contraseña actual.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="admin_password_crear" class="form-label">Su Contraseña</label>
                            <input type="password" class="form-control" name="admin_password" id="admin_password_crear" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin_password_confirm_crear" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="admin_password_confirm_crear" required>
                        </div>
                    </div>

                    <div id="agregarError" class="text-danger mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    </div>
    <?php include_once __DIR__ . '/../code_general/footer.php'; ?>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Script del buscador (sin cambios, pero ahora busca en .usuario-card) ---
    const removeAccents = (str) => str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    const buscador = document.getElementById('buscador');
    if (buscador) {
        buscador.addEventListener('input', function() {
            const query = removeAccents(this.value);
            document.querySelectorAll('.usuario-card').forEach(card => {
                const text = removeAccents(card.innerText);
                card.closest('.col').style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    // --- Script para el Modal de Eliminación (adaptado) ---
    const eliminarModalEl = document.getElementById('confirmarEliminarModal');
    if (eliminarModalEl) {
        eliminarModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const usuarioId = button.getAttribute('data-id');
            eliminarModalEl.querySelector('#id_usuario_eliminar').value = usuarioId;
            // Limpiar campos al abrir
            eliminarModalEl.querySelector('#admin_password').value = '';
            eliminarModalEl.querySelector('#eliminarError').textContent = '';
        });
    }

    // --- Listener para el envío del formulario de eliminación (adaptado) ---
    const formEliminar = document.getElementById('formEliminar');
    if (formEliminar) {
        formEliminar.addEventListener('submit', function(event) {
            event.preventDefault();
            const errorDiv = document.getElementById('eliminarError');
            const formData = new FormData(event.target);
            
            // CAMBIO: Apuntar a un script genérico de eliminación en el backend
            fetch('/assets/modelo/login_profesor/eliminar_usuario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Usuario eliminado correctamente.');
                    const usuarioCard = document.querySelector(`button[data-id='${formData.get('id_usuario_eliminar')}']`).closest('.col');
                    if (usuarioCard) {
                        usuarioCard.remove();
                    }
                    bootstrap.Modal.getInstance(eliminarModalEl).hide();
                } else {
                    errorDiv.textContent = data.message || 'Ocurrió un error.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorDiv.textContent = 'Error de conexión con el servidor.';
            });
        });
    }
    const agregarModalEl = document.getElementById('agregarPersonalModal');
    const formAgregar = document.getElementById('formAgregarPersonal');

    if (formAgregar) {
        agregarModalEl.addEventListener('hidden.bs.modal', function() {
            formAgregar.reset();
            document.getElementById('agregarError').textContent = '';
        });

        formAgregar.addEventListener('submit', function(event) {
            event.preventDefault();
            const errorDiv = document.getElementById('agregarError');
            errorDiv.textContent = ''; 

            const adminPass1 = document.getElementById('admin_password_crear').value;
            const adminPass2 = document.getElementById('admin_password_confirm_crear').value;

            if (adminPass1 !== adminPass2) {
                errorDiv.textContent = 'Las contraseñas de autorización no coinciden.';
                return;
            }

            const formData = new FormData(event.target);
            fetch('/assets/modelo/login_profesor/agregar_personal.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Personal agregado correctamente.');
                    bootstrap.Modal.getInstance(agregarModalEl).hide();
                    location.reload();
                } else {
                    errorDiv.textContent = data.message || 'Ocurrió un error al agregar el usuario.';
                }
            })
            .catch(error => {
                console.error('Error en fetch:', error);
                errorDiv.textContent = 'Error de conexión con el servidor.';
            });
        });
    }
});
</script>
</body>
</html>
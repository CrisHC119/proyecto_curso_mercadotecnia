<?php
include_once __DIR__ . '/code_general/navbar.php';
include_once __DIR__ . '/../modelo/conexion.php';
$instituto_data = json_decode(file_get_contents(__DIR__ . '/../json/institutos.json'), true);
$sql = "
SELECT 
    U.id_usuario, U.nombres, U.apellido_paterno, U.apellido_materno, U.avatar, U.id_tipo_usuario,
    A.nocontrol AS matricula, A.semestre, A.horas_U1, A.horas_U2, A.horas_U3, A.horas_U4, A.horas_U5,
    U.campus, 'Estudiante' AS rol
FROM usuarios U
INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
";
$result = $conn->query($sql);
?>
<style>
    /* Estilos (sin cambios) */
    :root { --bs-body-bg: #1c1c1e; --bs-body-color: #ffffff; }
    .card { background-color: #2c2c2e; border-color: rgba(255, 255, 255, 0.15); }
    .list-group-item { background-color: transparent; border-color: rgba(255, 255, 255, 0.15); }
    .card-footer { background-color: transparent; }
    .form-control, .input-group-text { background-color: #2c2c2e; border-color: rgba(255, 255, 255, 0.2); color: #fff; }
    .form-control::placeholder { color: #8e8e93; }
    .btn-outline-primary { --bs-btn-color: #0d6efd; --bs-btn-border-color: #0d6efd; --bs-btn-hover-bg: #0d6efd; --bs-btn-hover-border-color: #0d6efd; }
    .btn-outline-danger { --bs-btn-color: #dc3545; --bs-btn-border-color: #dc3545; --bs-btn-hover-bg: #dc3545; --bs-btn-hover-border-color: #dc3545; }
    .avatar-card { width: 100px; height: 100px; object-fit: cover; }
    body.light-mode { --bs-body-bg: #f8f9fa; --bs-body-color: #212529; }
    body.light-mode .card, body.light-mode .list-group-item { background-color: #ffffff; border-color: #dee2e6; }
    body.light-mode .form-control, body.light-mode .input-group-text { background-color: #fff; border-color: #ced4da; color: #212529; }
    body.light-mode .form-control::placeholder { color: #6c757d; }
</style>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-4 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2"><i class="bi bi-people-fill me-2"></i><?php echo $textos['lista_alumnos']; ?> <span class="badge bg-secondary align-middle"><?php echo $result->num_rows; ?></span></h1>
            </div>
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador" class="form-control" placeholder="<?php echo $textos['buscar_alumno']; ?>">
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 g-4">
                <?php while ($alumno = $result->fetch_assoc()): ?>
                    <?php
                    $clave = $alumno['campus'];
                    $nombre_instituto = $instituto_data[$clave] ?? $textos['no_instituto'];
                    $totalMinutos = array_sum(array_map('intval', [$alumno['horas_U1'], $alumno['horas_U2'], $alumno['horas_U3'], $alumno['horas_U4'], $alumno['horas_U5']]));
                    $horas = floor($totalMinutos / 60);
                    $minutos = $totalMinutos % 60;
                    $totalHorasTexto = sprintf('%d:%02d Horas', $horas, $minutos);
                    ?>
                    <div class="col">
                        <div class="card shadow-sm h-100 alumno-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12 col-sm-4 text-center mb-3 mb-sm-0">
                                        <img src="/assets/images/avatar/<?php echo htmlspecialchars($alumno['avatar']); ?>" class="avatar-card rounded-circle" alt="Avatar">
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <h4 class="card-title mb-1"><?php echo htmlspecialchars($alumno['nombres'] . ' ' . $alumno['apellido_paterno']); ?></h4>
                                        <span class="badge bg-success mb-2"><?php echo $alumno['rol']; ?></span>
                                        <p class="text-body-secondary mb-0"><?php echo $textos['login_matricula']; ?>: <?php echo $alumno['matricula']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="bi bi-building me-2 text-body-secondary"></i><?php echo $textos['instituto']; ?></span>
                                    <strong><?php echo $nombre_instituto; ?></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="bi bi-bar-chart-steps me-2 text-body-secondary"></i><?php echo $textos['semestre']; ?></span>
                                    <strong><?php echo $alumno['semestre'] ?: 'N/A'; ?></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="bi bi-clock-fill me-2 text-body-secondary"></i><?php echo $textos['total_de_horas']; ?></span>
                                    <strong class="text-primary"><?php echo $totalHorasTexto; ?></strong>
                                </li>
                            </ul>
                            <div class="card-footer text-end border-0 pt-3">
                                <a href="/assets/code/profesor/lost_page_profesor.php?id=<?php echo $alumno['id_usuario']; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-person-vcard"></i> <?php echo $textos['ver_detalles']; ?>
                                </a>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarExpulsionModal" data-id="<?php echo $alumno['id_usuario']; ?>">
                                    <i class="bi bi-person-x-fill"></i> <?php echo $textos['expulsar_alumno']; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>

    <div class="modal fade" id="confirmarExpulsionModal" tabindex="-1" aria-labelledby="expulsionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formExpulsar" method="post"> <div class="modal-header">
                        <h5 class="modal-title" id="expulsionModalLabel">Confirmar Expulsión</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>¡Atención!</strong> Esta acción es irreversible. El registro del alumno será eliminado.
                        </div>
                        <input type="hidden" name="id_usuario_expulsar" id="id_usuario_expulsar">
                        <div class="mb-3">
                            <label for="profesor_password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="profesor_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="profesor_password_confirm" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="profesor_password_confirm" required>
                        </div>
                        <div id="expulsionError" class="text-danger mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Confirmar Expulsión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../code_general/footer.php'; ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- Script del buscador ---
            const removeAccents = (str) => str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
            const buscador = document.getElementById('buscador');
            if (buscador) {
                buscador.addEventListener('input', function() {
                    const query = removeAccents(this.value);
                    document.querySelectorAll('.alumno-card').forEach(card => {
                        const text = removeAccents(card.innerText);
                        card.closest('.col').style.display = text.includes(query) ? '' : 'none';
                    });
                });
            }

            // --- Script para el Modal de Expulsión ---
            const expulsionModalEl = document.getElementById('confirmarExpulsionModal');
            if (expulsionModalEl) {
                expulsionModalEl.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const alumnoId = button.getAttribute('data-id');
                    expulsionModalEl.querySelector('#id_usuario_expulsar').value = alumnoId;
                    expulsionModalEl.querySelector('#profesor_password').value = '';
                    expulsionModalEl.querySelector('#profesor_password_confirm').value = '';
                    expulsionModalEl.querySelector('#expulsionError').textContent = '';
                });
            }

            // --- Listener para el envío del formulario de expulsión ---
            const formExpulsar = document.getElementById('formExpulsar');
            if (formExpulsar) {
                formExpulsar.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const errorDiv = document.getElementById('expulsionError');
                    const pass1 = document.getElementById('profesor_password').value;
                    const pass2 = document.getElementById('profesor_password_confirm').value;

                    if (pass1 !== pass2) {
                        errorDiv.textContent = 'Las contraseñas no coinciden.';
                        return;
                    }

                    const formData = new FormData(event.target);
                    // Usar la ruta correcta a tu modelo
                    fetch('/assets/modelo/login_profesor/expulsar_alumno.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Alumno expulsado correctamente.');
                            const alumnoCard = document.querySelector(`button[data-id='${formData.get('id_usuario_expulsar')}']`).closest('.col');
                            if (alumnoCard) {
                                alumnoCard.remove();
                            }
                            bootstrap.Modal.getInstance(expulsionModalEl).hide();
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
        });
    </script>
</body>
</html>
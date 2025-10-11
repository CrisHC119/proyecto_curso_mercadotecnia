<?php
    $page_3 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/login_profesor/verificar_alumnos.php';
    include_once __DIR__ . '/styles/style_menu_alumnos.php';
    $instituto_data = json_decode(file_get_contents(__DIR__ . '/../json/institutos.json'), true);
?>
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
                            <button type="button" class="btn btn-outline-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detallesAlumnoModal"
                                data-avatar="<?php echo htmlspecialchars($alumno['avatar']); ?>"
                                data-nombre="<?php echo htmlspecialchars($alumno['nombres']); ?>"
                                data-apaterno="<?php echo htmlspecialchars($alumno['apellido_paterno']); ?>"
                                data-amaterno="<?php echo htmlspecialchars($alumno['apellido_materno']); ?>"
                                data-instituto="<?php echo htmlspecialchars($nombre_instituto); ?>"
                                data-semestre="<?php echo htmlspecialchars($alumno['semestre'] ?: 'N/A'); ?>"
                                data-total-horas="<?php echo htmlspecialchars($totalHorasTexto); ?>"
                                data-u1="<?php echo htmlspecialchars($alumno['calf_1'] ?? 'N/A'); ?>"
                                data-u2="<?php echo htmlspecialchars($alumno['calf_2'] ?? 'N/A'); ?>"
                                data-u3="<?php echo htmlspecialchars($alumno['calf_3'] ?? 'N/A'); ?>"
                                data-u4="<?php echo htmlspecialchars($alumno['calf_4'] ?? 'N/A'); ?>"
                                data-u5="<?php echo htmlspecialchars($alumno['calf_5'] ?? 'N/A'); ?>">
                                <i class="bi bi-person-vcard"></i> <?php echo $textos['ver_detalles']; ?>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarExpulsionModal" data-id="<?php echo $alumno['id_usuario']; ?>">
                                <i class="bi bi-person-x-fill"></i> <?php echo $textos['expulsar_alumno']; ?>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
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
    <div class="modal fade" id="detallesAlumnoModal" tabindex="-1" aria-labelledby="detallesAlumnoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallesAlumnoModalLabel"><i class="bi bi-person-vcard me-2"></i><?php echo $textos['detalles_estudiante']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img id="modalAvatar" src="" class="img-fluid rounded-circle" alt="Avatar del Alumno" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h3 id="modalNombreCompleto" class="mb-1"></h3>
                            <p class="mb-2"><strong class="me-2"><?php echo $textos['instituto']; ?>:</strong><span id="modalInstituto"></span></p>
                            <p class="mb-2"><strong class="me-2"><?php echo $textos['semestre']; ?></strong><span id="modalSemestre"></span></p>
                            <p class="mb-0"><strong class="me-2"><?php echo $textos['total_de_horas']; ?>:</strong><span id="modalTotalHoras" class="badge bg-primary fs-6"></span></p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class="mb-3"><?php echo $textos['calificacion_unidad']; ?></h5>
                    <div class="row text-center">
                        <div class="col">
                            <div class="fw-bold"><?php echo $textos['unidad_1']; ?></div>
                            <div class="progress mt-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 25px;">
                                <div id="modalProgressU1" class="progress-bar fw-bold" style="width: 0%">0</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="fw-bold"><?php echo $textos['unidad_2']; ?></div>
                            <div class="progress mt-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 25px;">
                                <div id="modalProgressU2" class="progress-bar fw-bold" style="width: 0%">0</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="fw-bold"><?php echo $textos['unidad_3']; ?></div>
                            <div class="progress mt-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 25px;">
                                <div id="modalProgressU3" class="progress-bar fw-bold" style="width: 0%">0</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="fw-bold"><?php echo $textos['unidad_4']; ?></div>
                            <div class="progress mt-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 25px;">
                                <div id="modalProgressU4" class="progress-bar fw-bold" style="width: 0%">0</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="fw-bold"><?php echo $textos['unidad_5']; ?></div>
                            <div class="progress mt-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 25px;">
                                <div id="modalProgressU5" class="progress-bar fw-bold" style="width: 0%">0</div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
</div></main>

<?php include_once __DIR__ . '/../code_general/footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        // Pega esto dentro de tu script, después del código del buscador
const detallesModalEl = document.getElementById('detallesAlumnoModal');
if (detallesModalEl) {
    // --- Función para obtener el color de la calificación ---
    const getGradeColorClass = (grade) => {
        if (grade < 70) return 'bg-danger';   // Reprobado
        if (grade < 90) return 'bg-warning';  // Regular
        return 'bg-success';                  // Excelente
    };

    detallesModalEl.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const modal = this;

        // --- Actualizar Información General (sin cambios) ---
        const avatar = button.dataset.avatar;
        const nombreCompleto = `${button.dataset.nombre} ${button.dataset.apaterno} ${button.dataset.amaterno}`;
        modal.querySelector('#modalAvatar').src = `/assets/images/avatar/${avatar}`;
        modal.querySelector('#modalNombreCompleto').textContent = nombreCompleto;
        modal.querySelector('#modalInstituto').textContent = button.dataset.instituto;
        modal.querySelector('#modalSemestre').textContent = button.dataset.semestre;
        modal.querySelector('#modalTotalHoras').textContent = button.dataset.totalHoras;

        // --- Actualizar Barras de Progreso de Calificaciones ---
        for (let i = 1; i <= 5; i++) {
            const grade = parseInt(button.dataset['u' + i]) || 0;
            const progressBar = modal.querySelector('#modalProgressU' + i);
            
            // Actualizar texto y ancho de la barra
            progressBar.textContent = grade;
            progressBar.style.width = grade + '%';
            progressBar.setAttribute('aria-valuenow', grade);

            // Actualizar color de la barra
            progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
            progressBar.classList.add(getGradeColorClass(grade));
        }
    });
}

    </script>
</body>
</html>
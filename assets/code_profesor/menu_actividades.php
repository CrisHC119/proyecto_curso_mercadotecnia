<?php
    $page_8 = 'active'; 
    
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/styles/style_menu_examenes.php';
    include_once __DIR__ . '/scripts/script_mostrar_fecha.php';
    require_once '../modelo/conexion.php';

    // Lógica para el idioma
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma; 
        header("Location: $url");
        exit;
    }
    date_default_timezone_set('America/Monterrey');

    // --- CAMBIO: OBTENER TODAS LAS FECHAS DESDE LA FILA MAESTRA (ID=1) ---
    $id_fila_maestra = 1; // Según tu imagen e instrucciones, todo está en el ID 1
    
    $sql_fechas = "SELECT * FROM alumnos_actividad_fecha WHERE id_unidad = ?";
    $stmt_fechas = $conn->prepare($sql_fechas);
    $stmt_fechas->bind_param("i", $id_fila_maestra);
    $stmt_fechas->execute();
    $result_fechas = $stmt_fechas->get_result();
    
    $fechas_unidades = []; // Array para organizar las fechas
    
    if ($row = $result_fechas->fetch_assoc()) {
        // Recorremos del 1 al 5 para llenar el array mapeando las columnas de tu tabla
        for ($k = 1; $k <= 5; $k++) {
            // Tu tabla tiene columnas: act_1_fecha_inicial, act_2_fecha_inicial, etc.
            $col_inicio = 'act_' . $k . '_fecha_inicial';
            $col_fin    = 'act_' . $k . '_fecha_final';
            
            $fechas_unidades[$k] = [
                'disponible' => $row[$col_inicio] ?? null,
                'limite'     => $row[$col_fin] ?? null
            ];
        }
    }
    $stmt_fechas->close();
    // --- FIN DEL CAMBIO ---

    // Textos (sin cambios importantes aquí)
    $textos['unidad_titulo'] = 'Unidad'; 
    $textos['ver_unidad'] = 'Ver Unidad';
    $textos['modificar_fecha'] = $textos['modificar_fecha'] ?? 'Modificar Fecha';
    $textos['asignar_fecha_actividad'] = 'Asignar Fecha a la Unidad'; 
    
    $textos['confirmar_reinicio_fecha_act'] = $textos['confirmar_reinicio_fecha_act'] ?? '¿Estás seguro de reiniciar las fechas?';
    $textos['actualizar_fecha_act_exito'] = 'La fecha de la unidad se ha actualizado correctamente.';
    $textos['reiniciar_fecha_act_exito'] = 'La fecha de la unidad ha sido reiniciada correctamente.';
    
    $textos['fecha_inicio'] = $textos['fecha_inicio'] ?? 'Fecha de Inicio';
    $textos['fecha_fin'] = $textos['fecha_fin'] ?? 'Fecha de Finalización';
    $textos['guardar'] = $textos['guardar'] ?? 'Guardar';
    $textos['cancelar'] = $textos['cancelar'] ?? 'Cancelar';
    $textos['valor'] = $textos['valor'] ?? 'Valor';
    $textos['disponible'] = $textos['disponible'] ?? 'Disponible';
    $textos['error_fecha_inicio_vacia'] = $textos['error_fecha_inicio_vacia'] ?? 'La fecha de inicio es requerida.';
    $textos['error_fecha_fin_vacia'] = $textos['error_fecha_fin_vacia'] ?? 'La fecha de finalización es requerida.';
    $textos['error_fecha_fin_anterior'] = $textos['error_fecha_fin_anterior'] ?? 'La fecha de finalización debe ser posterior a la de inicio.';

    function mostrarRangoFechas($fecha_inicio_str, $fecha_fin_str) {
        if (!$fecha_inicio_str) {
            return "<span class='text-muted'>No asignada</span>";
        }
        try {
            $inicio_dt = new DateTime($fecha_inicio_str);
            $inicio_formato = $inicio_dt->format('d/m/Y H:i');
            if (!$fecha_fin_str) {
                return "Desde: " . $inicio_formato;
            } else {
                $fin_dt = new DateTime($fecha_fin_str);
                if ($inicio_dt->format('Y-m-d') === $fin_dt->format('Y-m-d')) {
                    return $inicio_dt->format('d/m/Y') . " de " . $inicio_dt->format('H:i') . " a " . $fin_dt->format('H:i');
                } else {
                    return "Del: " . $inicio_formato . " al " . $fin_dt->format('d/m/Y H:i');
                }
            }
        } catch (Exception $e) {
            return "<span class='text-danger'>Fecha inválida</span>";
        }
    }
?>
<div class="container mt-4 px-2">
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ <?php echo $textos['actualizar_fecha_act_exito']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="card-container">
    <?php 
        // Bucle para las 5 Unidades
        for ($i = 1; $i <= 5; $i++): 
            // Extraemos del array que preparamos arriba
            $fecha_inicio = $fechas_unidades[$i]['disponible'] ?? null;
            $fecha_fin = $fechas_unidades[$i]['limite'] ?? null;
            
            $ahora = new DateTime();
            $periodo_activo = false;
            $disabled = false;

            if ($fecha_inicio) {
                 try {
                    $inicio_dt = new DateTime($fecha_inicio);
                    if ($ahora >= $inicio_dt) {
                        $periodo_activo = true; 
                    }
                 } catch (Exception $e) {}
            }
    ?>
    <div class="card-menu mb-3 <?php echo $disabled ? 'opacity-50' : ''; ?>">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <i class="bi bi-journal-bookmark-fill"></i> <h5 class="d-inline ms-2"><?php echo $textos['unidad_titulo']; ?> <?php echo $i; ?></h5>
            </div>
        </div>
        
        <p class="mb-1">📘 <?php echo $textos['valor']; ?> <strong>100 pts</strong></p>
        
        <p>📅 <?php echo $textos['disponible']; ?> <?php echo mostrarRangoFechas($fecha_inicio, $fecha_fin); ?></p> 
        
        <div class="btn-group btn-group-sm mt-3" role="group">
            
            <a href="ver_actividades.php?unidad=<?php echo $i; ?>&actividad=1" 
               class="btn btn-outline-primary <?php echo $disabled ? 'disabled' : ''; ?>">
                <i class="bi bi-eye-fill me-1"></i> <?php echo $textos['ver_unidad']; ?> 
            </a>

            <button class="btn btn-primary <?php echo $disabled ? 'disabled' : ''; ?>" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalFecha" 
                    onclick="prepararModal(1, <?php echo $i; ?>, '<?php echo $fecha_inicio; ?>', '<?php echo $fecha_fin; ?>')">
                <i class="bi bi-calendar-event me-1"></i> <?php echo $textos['modificar_fecha']; ?>
            </button>
        </div>
    </div>
    <?php endfor; ?>
    </div>

    <div class="text-center my-4">
        <a href="index_profesor.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i>Volver al menú principal
        </a>
    </div>
</div>

<div class="modal fade" id="modalFecha" tabindex="-1" aria-labelledby="modalFechaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formFecha"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFechaLabel"><?php echo $textos['asignar_fecha_actividad']; ?> - Unidad <span id="modalUnidadTitulo"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_unidad" id="modal_id_unidad">              
                    <input type="hidden" name="id_actividad" id="modal_id_actividad">
                    
                    <div class="mb-3">
                        <label for="fecha_disponible" class="form-label">📅 <?php echo $textos['fecha_inicio']; ?>:</label>
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="fecha_disponible" id="fecha_disponible">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setStartToNow()">Ahora</button>
                        </div>
                        <div id="fechaDisponibleError" class="text-danger mt-1 small"></div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_limite" class="form-label">🏁 <?php echo $textos['fecha_fin']; ?>:</label>
                        <input type="datetime-local" class="form-control" name="fecha_limite" id="fecha_limite">
                        <div id="fechaLimiteError" class="text-danger mt-1 small"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <button type="button" onclick="solicitarPassword('reiniciar')" class="btn btn-danger btn-sm">Reiniciar Fechas</button>
                    </div>
                    <div>
                        <button type="button" onclick="solicitarPassword('guardar')" class="btn btn-success"><?php echo $textos['guardar']; ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cancelar']; ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalConfirmacionExito" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalConfirmacionExitoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmacionExitoLabel">¡Acción Completada!</h5> 
            </div>
            <div class="modal-body text-center p-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <p class="mt-3 fs-5" id="modalConfirmacionMensaje">La fecha se ha actualizado correctamente.</p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="location.reload()">Aceptar</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formPassword">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPasswordLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>Para completar esta acción, por favor ingresa tu contraseña.</p>
                    <input type="hidden" name="id_unidad" id="password_id_unidad">           
                    <input type="hidden" name="id_actividad" id="password_id_actividad">
                    <input type="hidden" name="fecha_disponible" id="password_fecha_disponible">
                    <input type="hidden" name="fecha_limite" id="password_fecha_limite"> 
                    <input type="hidden" name="accion" id="password_accion">
                    
                    <div class="mb-3">
                        <label for="profesor_password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="profesor_password" required>
                    </div>
                    <div id="passwordError" class="text-danger mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const modalFechaElement = document.getElementById('modalFecha');
    const inputFechaDisponible = document.getElementById('fecha_disponible');
    const inputFechaLimite = document.getElementById('fecha_limite');
    const errDisponible = document.getElementById('fechaDisponibleError');
    const errLimite = document.getElementById('fechaLimiteError');
    const modalUnidadTitulo = document.getElementById('modalUnidadTitulo');
    
    function formatDateTimeLocal(date) {
        if (!date) return '';
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    function getMinDateTime() {
        const now = new Date();
        now.setSeconds(0, 0); 
        return formatDateTimeLocal(now);
    }
    
    // CAMBIO CRÍTICO EN JS: Recibe (idFilaBD, numeroUnidadReal, ...)
    function prepararModal(idFilaBD, numeroUnidadReal, fechaInicioActual, fechaFinActual) {
        // idFilaBD siempre será 1 según tu configuración
        document.getElementById('modal_id_unidad').value = idFilaBD; 
        // numeroUnidadReal (1-5) sirve para que el PHP sepa qué columna actualizar (act_X_fecha...)
        document.getElementById('modal_id_actividad').value = numeroUnidadReal; 
        
        // Mostramos visualmente al usuario qué unidad está editando
        modalUnidadTitulo.textContent = numeroUnidadReal; 
        
        errDisponible.textContent = '';
        errLimite.textContent = '';

        const minDateTime = getMinDateTime();
        inputFechaDisponible.min = minDateTime;
        inputFechaLimite.min = minDateTime;

        inputFechaDisponible.value = fechaInicioActual && fechaInicioActual !== '0000-00-00 00:00:00' ? fechaInicioActual.replace(' ', 'T').slice(0, 16) : minDateTime;
        inputFechaLimite.value = fechaFinActual && fechaFinActual !== '0000-00-00 00:00:00' ? fechaFinActual.replace(' ', 'T').slice(0, 16) : '';
        
        if (inputFechaDisponible.value) {
            inputFechaLimite.min = inputFechaDisponible.value;
        }
    }

    inputFechaDisponible.addEventListener('change', function() {
        if (inputFechaDisponible.value) {
            inputFechaLimite.min = inputFechaDisponible.value;
            if (inputFechaLimite.value && inputFechaLimite.value < inputFechaDisponible.value) {
                inputFechaLimite.value = '';
            }
        } else {
            inputFechaLimite.min = getMinDateTime();
        }
    });

    function setStartToNow() {
        const nowFormatted = getMinDateTime();
        inputFechaDisponible.value = nowFormatted;
        inputFechaDisponible.dispatchEvent(new Event('change'));
    }

    function solicitarPassword(accion) {
        if (accion === 'reiniciar') {
            if (!confirm('<?php echo $textos['confirmar_reinicio_fecha_act']; ?>')) {
                return; 
            }
        }

        const modalFechaInstance = bootstrap.Modal.getInstance(modalFechaElement);
        const modalPassword = new bootstrap.Modal(document.getElementById('modalPassword'));

        const idUnidad = document.getElementById('modal_id_unidad').value;
        const idActividad = document.getElementById('modal_id_actividad').value;
        const fechaInicio = inputFechaDisponible.value;
        const fechaFin = inputFechaLimite.value;
        
        errDisponible.textContent = '';
        errLimite.textContent = '';
        let valid = true;

        if (accion === 'guardar') {
            if (!fechaInicio) {
                errDisponible.textContent = '<?php echo $textos['error_fecha_inicio_vacia']; ?>';
                valid = false;
            }
            if (!fechaFin) {
                errLimite.textContent = '<?php echo $textos['error_fecha_fin_vacia']; ?>';
                valid = false;
            }
            if (fechaInicio && fechaFin && fechaFin <= fechaInicio) {
                errLimite.textContent = '<?php echo $textos['error_fecha_fin_anterior']; ?>';
                valid = false;
            }
            const minAllowed = getMinDateTime();
            if (fechaInicio && fechaInicio < minAllowed) {
                 try {
                    const startDate = new Date(fechaInicio);
                    const minDate = new Date(minAllowed);
                    if ((startDate.getTime() + 60000) < minDate.getTime()) { 
                        errDisponible.textContent = 'La fecha de inicio no puede ser en el pasado.';
                        valid = false;
                    }
                 } catch(e) {}
            }
        }
        
        if (!valid) return; 

        document.getElementById('password_id_unidad').value = idUnidad;
        document.getElementById('password_id_actividad').value = idActividad;
        document.getElementById('password_fecha_disponible').value = fechaInicio;
        document.getElementById('password_fecha_limite').value = fechaFin;
        document.getElementById('password_accion').value = accion;
        document.getElementById('profesor_password').value = '';
        document.getElementById('passwordError').textContent = '';

        if (modalFechaInstance) modalFechaInstance.hide();
        modalPassword.show();
    }

    document.getElementById('formPassword').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        const errorDiv = document.getElementById('passwordError');
        const modalPasswordEl = document.getElementById('modalPassword');
        const modalConfirmacionEl = document.getElementById('modalConfirmacionExito');
        const confirmacionMsg = document.getElementById('modalConfirmacionMensaje');

        fetch('../modelo/login_profesor/actualizar_fecha_actividad.php', { 
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modalPasswordInstance = bootstrap.Modal.getInstance(modalPasswordEl);
                if (modalPasswordInstance) {
                    modalPasswordInstance.hide();
                }
                const accionRealizada = formData.get('accion');
                if (accionRealizada === 'reiniciar') {
                    confirmacionMsg.textContent = '<?php echo $textos['reiniciar_fecha_act_exito']; ?>';
                } else {
                    confirmacionMsg.textContent = '<?php echo $textos['actualizar_fecha_act_exito']; ?>';
                }
                const modalConfirmacionInstance = bootstrap.Modal.getOrCreateInstance(modalConfirmacionEl);
                modalConfirmacionInstance.show();
            } else {
                errorDiv.textContent = data.message || 'Ocurrió un error.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorDiv.textContent = 'Error de conexión con el servidor.';
        });
    });
</script>

<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
</body>
</html>
<?php
    $page_5 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/styles/style_menu_examenes.php';
    include_once __DIR__ . '/scripts/script_mostrar_fecha.php';
    require_once '../modelo/conexion.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    date_default_timezone_set('America/Monterrey');

    $sql = "SELECT id_examen, fecha_disponible, fecha_limite FROM examen_unidad WHERE id_examen BETWEEN 1 AND 5";
    $result = $conn->query($sql);
    $fechas_examenes = []; 
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fechas_examenes[$row['id_examen']] = [
                'disponible' => $row['fecha_disponible'], 
                'limite'     => $row['fecha_limite']
            ];
        }
    }
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
            ✅ <?php echo $textos['actualizar_fecha_examen_exito']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>
    <div class="card-container">
    <?php 
        $totalAlumnos = 0;
        $totalRes = $conn->query("SELECT COUNT(*) AS total FROM alumnos");
        if ($totalRes) {
            $totalAlumnos = $totalRes->fetch_assoc()['total'];
        }
        $realizados = [];
        for ($u = 1; $u <= 5; $u++) {
            $res = $conn->query("SELECT COUNT(*) AS hechos FROM alumnos_calificacion WHERE examen_U$u = 1");
            $realizados[$u] = ($res && $res->num_rows > 0) ? $res->fetch_assoc()['hechos'] : 0;
        }
        for ($i = 1; $i <= 5; $i++): 
            $fecha_inicio = $fechas_examenes[$i]['disponible'] ?? null;
            $fecha_fin = $fechas_examenes[$i]['limite'] ?? null;
            $ahora = new DateTime();
            $periodo_activo = false;
            $periodo_pasado = false;
            $disabled = false;
            if ($fecha_inicio && $fecha_fin) {
                try {
                    $inicio_dt = new DateTime($fecha_inicio);
                    $fin_dt = new DateTime($fecha_fin);
                    if ($ahora >= $inicio_dt && $ahora < $fin_dt) {
                        $periodo_activo = true;
                    } elseif ($ahora >= $fin_dt) {
                        $periodo_pasado = true;
                    }
                } catch (Exception $e) {}
            } elseif ($fecha_inicio) {
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
                <i class="bi bi-journal-text"></i>
                <h5 class="d-inline ms-2"><?php echo $textos['unidad']; ?> <?php echo $i; ?></h5>
            </div>
        </div>
        <p class="mb-1">📘 <?php echo $textos['valor']; ?> <strong>100 pts</strong></p>
        <p>📅 <?php echo $textos['disponible']; ?> <?php echo mostrarRangoFechas($fecha_inicio, $fecha_fin); ?></p>        
        <p>🧑‍🎓 <?php echo $textos['completado_por']; ?> <strong><?php echo $realizados[$i]; ?> <?php echo $textos['de']; ?> <?php echo $totalAlumnos; ?></strong></p>
        <div class="btn-group btn-group-sm mt-3" role="group">
            <a href="calificacion_alumnos.php?unidad=<?php echo $i; ?>" 
                class="btn btn-outline-primary <?php echo $disabled ? 'disabled' : ''; ?>">
                <i class="bi bi-people-fill me-1 icon-calificaciones"></i>  <?php echo $textos['ver_calificaciones']; ?> 
            </a>
            <a href="modificar_examen.php?unidad=<?php echo $i; ?>" 
                class="btn btn-outline-primary <?php echo $disabled ? 'disabled' : ''; ?>">
                <i class="bi bi-book me-1 icon-calificaciones"></i> <?php echo $textos['modificar_examen']; ?> 
            </a>
            <button class="btn btn-primary <?php echo $disabled ? 'disabled' : ''; ?>" 
                     data-bs-toggle="modal" 
                     data-bs-target="#modalFecha" 
                     onclick="prepararModal(<?php echo $i; ?>, '<?php echo $fecha_inicio; ?>', '<?php echo $fecha_fin; ?>')">
                 <i class="bi bi-calendar-event me-1"></i> <?php echo $textos['cambiar_fecha']; ?> 
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
              <h5 class="modal-title" id="modalFechaLabel"><?php echo $textos['asignar_fecha_examen']; ?> Unidad <span id="modalUnidadTitulo"></span></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id_examen" id="modal_id_examen">
              
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
                <p class="mt-3 fs-5" id="modalConfirmacionMensaje">La fecha del examen se ha actualizado correctamente.</p> 
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
    <input type="hidden" name="id_examen" id="password_id_examen">
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
// Function to open the password modal
    function solicitarPassword(accion) {
        // --- Confirmation for Reset ---
        if (accion === 'reiniciar') {
            if (!confirm('<?php echo $textos['confirmar_reinicio_fecha']; ?>')) {
                return; 
            }
        }

        // --- Get Modal Instances (Ensure they are correctly referenced) ---
        // It's safer to get the instance right when needed, especially if modals open/close
        const modalFechaEl = document.getElementById('modalFecha'); 
        const modalFechaInstance = bootstrap.Modal.getInstance(modalFechaEl);
        const modalPasswordEl = document.getElementById('modalPassword');
        // Don't create new instance here yet, just get reference
        
        // --- Get Values ---
        const idExamen = document.getElementById('modal_id_examen').value;
        const fechaInicio = inputFechaDisponible.value;
        const fechaFin = inputFechaLimite.value;
        
        // --- Clear Previous Errors ---
        errDisponible.textContent = '';
        errLimite.textContent = '';
        document.getElementById('passwordError').textContent = ''; // Also clear password error
        
        let valid = true;

        // --- Validation Logic ---
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
            
            // --- Stricter Check for Past Date ---
            // Convert minDateTime string (YYYY-MM-DDTHH:mm) to comparable value
            const minAllowedStr = getMinDateTime(); 
            // Only compare if fechaInicio has a value
            if (fechaInicio && fechaInicio < minAllowedStr) {
                // Check seconds difference to allow setting time very close to 'now'
                try {
                    const startDate = new Date(fechaInicio);
                    const minDate = new Date(minAllowedStr);
                    // Allow a small grace period (e.g., 60 seconds) in case of minor delays
                    if ((startDate.getTime() + 60000) < minDate.getTime()) { 
                         errDisponible.textContent = 'La fecha de inicio no puede ser en el pasado.'; 
                         valid = false;
                    }
                } catch(e) { /* Handle potential invalid date format during comparison */ }
            }
        }
        
        // --- If Validation Fails, STOP ---
        if (!valid) {
             console.log("Validation failed. Stopping."); // Add console log for debugging
             return; 
        }

        // --- Validation Passed, Prepare Password Modal ---
        console.log("Validation passed. Preparing password modal."); // Debug log

        // Populate hidden fields in password modal
        document.getElementById('password_id_examen').value = idExamen;
        document.getElementById('password_fecha_disponible').value = fechaInicio; 
        document.getElementById('password_fecha_limite').value = fechaFin;       
        document.getElementById('password_accion').value = accion;
        document.getElementById('profesor_password').value = ''; // Clear password field

        // --- Hide Date Modal and Show Password Modal ---
        if (modalFechaInstance) {
            console.log("Hiding date modal."); // Debug log
            modalFechaInstance.hide();
        }
        
        // Ensure password modal exists and get/create instance *before* showing
        if (modalPasswordEl) {
             console.log("Showing password modal."); // Debug log
             const modalPasswordInstance = bootstrap.Modal.getOrCreateInstance(modalPasswordEl);
             modalPasswordInstance.show();
        } else {
             console.error("Password modal element not found!"); // Error if modal HTML is missing
        }
    }
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
    
    function prepararModal(id, fechaInicioActual, fechaFinActual) {
        document.getElementById('modal_id_examen').value = id;
        modalUnidadTitulo.textContent = id;
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
            if (!confirm('<?php echo $textos['confirmar_reinicio_fecha']; ?>')) {
                return; 
            }
        }

        const modalFechaInstance = bootstrap.Modal.getInstance(modalFechaElement);
        const modalPassword = new bootstrap.Modal(document.getElementById('modalPassword'));

        const idExamen = document.getElementById('modal_id_examen').value;
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
                 errDisponible.textContent = 'La fecha de inicio no puede ser en el pasado.';
                 valid = false;
             }
        }
        
        if (!valid) return; 

        document.getElementById('password_id_examen').value = idExamen;
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
        const modalPasswordEl = document.getElementById('modalPassword'); // Get reference
        const modalConfirmacionEl = document.getElementById('modalConfirmacionExito'); // Get reference
        const confirmacionMsg = document.getElementById('modalConfirmacionMensaje'); // Get reference to message p

        fetch('../modelo/login_profesor/actualizar_fecha_seguro.php', { /* Ensure path is correct */
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // --- SUCCESS: Hide password modal, show confirmation ---
                
                // 1. Hide Password Modal
                const modalPasswordInstance = bootstrap.Modal.getInstance(modalPasswordEl);
                if (modalPasswordInstance) {
                    modalPasswordInstance.hide();
                }

                // 2. Set Confirmation Message (Optional - based on action)
                const accionRealizada = formData.get('accion'); // Get the action performed
                if (accionRealizada === 'reiniciar') {
                     confirmacionMsg.textContent = 'La fecha del examen ha sido reiniciada correctamente.';
                } else {
                     confirmacionMsg.textContent = 'La fecha del examen se ha actualizado correctamente.';
                }

                // 3. Show Confirmation Modal
                const modalConfirmacionInstance = bootstrap.Modal.getOrCreateInstance(modalConfirmacionEl);
                modalConfirmacionInstance.show();

                // NO location.reload() here - it happens when user clicks "Aceptar"

            } else {
                // --- FAILURE: Show error in password modal ---
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
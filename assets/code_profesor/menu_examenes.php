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
            <i class="bi bi-arrow-left-circle me-2"></i><?php echo $textos['volver_menu']; ?> 
        </a>
    </div>
</div>
<div class="modal fade" id="modalFecha" tabindex="-1" aria-labelledby="modalFechaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formFecha"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFechaLabel"><?php echo $textos['asignar_fecha_examen']; ?> <?php echo $textos['unidad']; ?> <span id="modalUnidadTitulo"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_examen" id="modal_id_examen">
                    <div class="mb-3">
                        <label for="fecha_disponible" class="form-label">📅 <?php echo $textos['fecha_inicio']; ?>:</label>
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="fecha_disponible" id="fecha_disponible">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setStartToNow()"><?php echo $textos['ahora']; ?></button>
                        </div>
                        <div id="fechaDisponibleError" class="text-danger mt-1 small"></div>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_limite" class="form-label">🏁 <?php echo $textos['fecha_fin']; ?>:</label>
                        <input type="datetime-local" class="form-control" name="fecha_limite" id="fecha_limite">
                        <div id="fechaLimiteError" class="text-danger mt-1 small"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between"><div>
                <button type="button" onclick="solicitarPassword('reiniciar')" class="btn btn-danger btn-sm"><?php echo $textos['reiniciar_fechas']; ?></button>
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
                <h5 class="modal-title" id="modalConfirmacionExitoLabel"><?php echo $textos['accion_completada']; ?></h5> 
            </div>
            <div class="modal-body text-center p-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <p class="mt-3 fs-5" id="modalConfirmacionMensaje"><?php echo $textos['fecha_actualizada']; ?></p> 
                </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="location.reload()"><?php echo $textos['aceptar']; ?></button> 
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formPassword">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPasswordLabel"><?php echo $textos['confirmar_accion']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $textos['aviso_pass']; ?></p>
                    <input type="hidden" name="id_examen" id="password_id_examen">
                    <input type="hidden" name="fecha_disponible" id="password_fecha_disponible">
                    <input type="hidden" name="fecha_limite" id="password_fecha_limite"> 
                    <input type="hidden" name="accion" id="password_accion">
                    <div class="mb-3">
                        <label for="profesor_password" class="form-label"><?php echo $textos['password']; ?></label>
                        <input type="password" class="form-control" name="password" id="profesor_password" required>
                    </div>
                    <div id="passwordError" class="text-danger mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cancelar']; ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo $textos['confirmar']; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
    include_once __DIR__ . '/scripts/script_menu_examenes.php';
    include_once __DIR__ . '/../code_general/footer.php';
?>
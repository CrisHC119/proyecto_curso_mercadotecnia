<?php
    $page_2 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/conexion.php'; 
    include_once __DIR__ . '/styles/style_calificaciones.php';
    $sql = "
        SELECT
            U.id_usuario, U.nombres, U.apellido_paterno, U.avatar,
            A.nocontrol,
            C.calf_1 AS unidad_1,
            C.calf_2 AS unidad_2,
            C.calf_3 AS unidad_3,
            C.calf_4 AS unidad_4,
            C.calf_5 AS unidad_5,
            
            AA.calf_A_1 AS act_1,
            AA.calf_A_2 AS act_2,
            AA.calf_A_3 AS act_3,
            AA.calf_A_4 AS act_4,
            AA.calf_A_5 AS act_5

        FROM usuarios U
        INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
        LEFT JOIN alumnos_calificacion C ON U.id_usuario = C.id_usuario
        LEFT JOIN alumnos_actividad AA ON U.id_usuario = AA.id_usuario
        WHERE U.id_tipo_usuario = 3
        ORDER BY U.apellido_paterno, U.nombres;
    ";
    $result = $conn->query($sql);

    $pesos_unidades = [];
    $sql_pesos = "SELECT id_unidad, examen_valor, actividad_valor FROM alumnos_valores_calificar WHERE id_unidad BETWEEN 1 AND 5";
    $result_pesos = $conn->query($sql_pesos);
    
    if ($result_pesos && $result_pesos->num_rows > 0) {
        while ($fila = $result_pesos->fetch_assoc()) {
            $pesos_unidades[$fila['id_unidad']] = [
                'examen' => $fila['examen_valor'],
                'actividad' => $fila['actividad_valor']
            ];
        }
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $pesos_unidades[$i] = ['examen' => 50, 'actividad' => 50]; 
        }
    }
?>

<main class="flex-fill">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0"><i class="bi bi-journal-check me-2"></i>Calificaciones</h1>
        </div>

        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="buscador" class="form-control" placeholder="Buscar Alumnos">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col"><?php echo $textos['alumnos']; ?></th>
                                <th scope="col">U1</th>
                                <th scope="col">U2</th>
                                <th scope="col">U3</th>
                                <th scope="col">U4</th>
                                <th scope="col">U5</th>
                                <th scope="col"><?php echo $textos['calificacion_final']; ?></th>
                            </tr>
                        </thead>
                        <tbody id="tabla-calificaciones">
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($alumno = $result->fetch_assoc()): ?>
                                    <tr class="alumno-row">
                                        
                                        <td data-label="<?php echo $textos['alumnos']; ?>" class="alumno-info">
                                            <div class="d-flex align-items-center">
                                                <img src="/assets/images/avatar/<?php echo htmlspecialchars($alumno['avatar']); ?>" alt="Avatar" class="rounded-circle avatar-calif me-3">
                                                <div>
                                                    <h6 class="mb-0"><?php echo htmlspecialchars($alumno['nombres'] . ' ' . $alumno['apellido_paterno']); ?></h6>
                                                    <small class="text-body-secondary"><?php echo $textos['login_matricula'] ?? 'No. Control'; ?>: <?php echo htmlspecialchars($alumno['nocontrol']); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                            $calificaciones_finales_unidades = [];
                                            $suma_para_promedio = 0;
                                            $unidades_calificadas = 0;

                                            for ($i = 1; $i <= 5; $i++) {
                                                $calif_examen = $alumno['unidad_' . $i] ?? null;
                                                $calif_actividad = $alumno['act_' . $i] ?? null;
                                                $pesos = $pesos_unidades[$i] ?? ['examen' => 50, 'actividad' => 50];

                                                if ($calif_examen === null && $calif_actividad === null) {
                                                    $calificaciones_finales_unidades[$i] = null;
                                                } else {
                                                    $examen_temp = floatval($calif_examen ?? 0);
                                                    $actividad_temp = floatval($calif_actividad ?? 0);
                                                    
                                                    $parcial = ($examen_temp * ($pesos['examen'] / 100.0)) + ($actividad_temp * ($pesos['actividad'] / 100.0));
                                                    $calif_unidad_final = round($parcial);
                                                    
                                                    $calificaciones_finales_unidades[$i] = $calif_unidad_final;
                                                    $suma_para_promedio += $calif_unidad_final;
                                                    $unidades_calificadas++;
                                                }
                                            }
                                            
                                            foreach ($calificaciones_finales_unidades as $i => $calif) {
                                                if ($calif !== null) {
                                                    $clase_color = $calif >= 70 ? 'calif-aprobado' : 'calif-reprobado';
                                                    
                                                    echo "<td data-label='U{$i}' class='{$clase_color}'>" . htmlspecialchars($calif) . "</td>";
                                                } else {
                                                    echo "<td data-label='U{$i}' class='sin-calificar'>—</td>";
                                                }
                                            }

                                            $promedio = ($unidades_calificadas > 0) ? ($suma_para_promedio / $unidades_calificadas) : 0;
                                            $promedio_final = number_format($promedio, 1);
                                            $clase_promedio = $promedio_final >= 70 ? 'calif-aprobado' : 'calif-reprobado';
                                            
                                            echo "<td data-label='Final' class='calif-final {$clase_promedio}'>{$promedio_final}</td>";
                                        ?>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4"><?php echo $textos['no_hay_alumnos']; ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/assets/code_profesor/scripts/menu_calificaciones.js"></script>

<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
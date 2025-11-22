<?php
    $page_3 = 'active';
    include_once __DIR__ . '/code_general/navbar.php'; 
    include_once __DIR__ . '/../modelo/login_alumno/verificar_calificacion.php';
    include_once __DIR__ . '/styles/style_calificacion.php';

    if (!isset($_GET['lang']) && isset($idioma)) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    } elseif (!isset($idioma)) {
        echo "Error: Idioma no definido."; exit;
    }

    function mostrar_calificacion($valor, $textos, $es_parcial = false) {
        if ($valor === null) {
            $texto_mostrar = $es_parcial ? $textos['pendiente'] : $textos['no_registrado'];
            return "<span class='calificacion-pendiente'>" . $texto_mostrar . "</span>";
        } elseif ($valor < 70) {
            return "<span class='calificacion-reprobada'>" . $valor . "</span>";
        } else {
            return "<span class='calificacion-aprobada'>" . $valor . "</span>";
        }
    }
?>
<main class="flex-fill container my-5">
    <h2 class="mb-5 text-center"><?php echo $textos['calificacion_unidad']; ?></h2>
    <div class="row g-4">
        <div class="col-12 col-lg-8"> 
            <div class="row g-4 justify-content-center">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="col-12 col-md-10 d-flex justify-content-center"> 
                    <div class="card shadow-sm card-calificacion" style="width: 100%;">
                        <div class="card-body p-4">
                            <h5 class="card-title text-center mb-3"><?php echo $textos['tema_' . $i]; ?></h5>

                            <div class="d-flex justify-content-around text-center calificacion-split my-4">
                                <div>
                                    <span class="calificacion-label"><?php echo $textos['examen']; ?></span>
                                    <?php
                                        $valor_examen = $calificaciones_raw['calf_' . $i] ?? null;
                                        echo mostrar_calificacion($valor_examen, $textos, false);
                                    ?>
                                </div>
                                <div>
                                    <span class="calificacion-label"><?php echo $textos['actividad']; ?></span>
                                    <?php
                                        $valor_actividad = $calificaciones_raw['calf_A_' . $i] ?? null;
                                        echo mostrar_calificacion($valor_actividad, $textos, false);
                                    ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-around text-center calificacion-split my-4">
                                <div>
                                    <span class="calificacion-label"><?php echo $textos['asistencia']; ?></span>
                                    <?php
                                        $valor_asistencia = $calificaciones_raw['calf_Asis_' . $i] ?? null;
                                        echo mostrar_calificacion($valor_asistencia, $textos, false);
                                    ?>
                                </div>
                                <div>
                                    <span class="calificacion-label"><?php echo $textos['proyecto_final_label']; ?></span>
                                    <?php
                                        $valor_proyecto_final = $calificaciones_raw['calf_PF_' . $i] ?? null;
                                        echo mostrar_calificacion($valor_proyecto_final, $textos, false);
                                    ?>
                                </div>
                            </div>
                            
                            <hr>

                            <div class="text-center mt-3">
                                <span class="calificacion-label"><?php echo $textos['calificacion_parcial']; ?></span>
                                <div class="calificacion-valor-parcial mt-1"> 
                                    <?php
                                        $valor_parcial = $grades_parciales[$i] ?? null;
                                        echo mostrar_calificacion($valor_parcial, $textos, true);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?> 

                <div class="col-12 col-md-10 d-flex justify-content-center mt-4 d-lg-none"> 
                    <div id="rubrica-abajo" class="card shadow-sm card-calificacion" style="width: 100%;">
                        <div class="card-header text-center fw-bold small text-uppercase">
                             <?php echo $textos['rubrica']; ?>
                        </div>
                        <div class="card-body p-2">
                            <table class="table table-sm table-borderless caption-top mb-0"> 
                                <caption class="text-center px-2 small text-muted"><?php echo $textos['porcentaje_avance']; ?></caption>
                                <thead class="small text-uppercase">
                                    <tr>
                                        <th scope="col" class="ps-2"><?php echo $textos['unidad'] ?? 'Un.'; ?></th>
                                        <th scope="col" class="text-center"><?php echo $textos['test']; ?></th>
                                        <th scope="col" class="text-center"><?php echo $textos['actividadP']; ?></th>
                                        <th scope="col" class="text-center"><?php echo $textos['asistenciaP']; ?></th> <th scope="col" class="text-center pe-2"><?php echo $textos['proyecto_final_P']; ?></th> </tr>
                                </thead>
                                <tbody class="small align-middle">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php $pesos = $pesos_unidades[$i] ?? ['examen' => '?', 'actividad' => '?', 'asistencia' => '?', 'proyecto_final' => '?']; ?>
                                        <tr>
                                            <td class="ps-2 fw-bold"><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $pesos['examen']; ?>%</td>
                                            <td class="text-center"><?php echo $pesos['actividad']; ?>%</td>
                                            <td class="text-center"><?php echo $pesos['asistencia']; ?>%</td> <td class="text-center pe-2"><?php echo $pesos['proyecto_final']; ?>%</td> </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-12 col-lg-4 d-none d-lg-block">
            <div id="rubrica-flotante" class="card shadow-sm card-calificacion card-rubrica-flotante">
                <div class="card-header text-center fw-bold small text-uppercase">
                    <?php echo $textos['rubrica']; ?>
                </div>
                <div class="card-body p-2">
                    <table class="table table-sm table-striped table-hover caption-top mb-0"> 
                        <caption class="text-center px-2 small text-muted"><?php echo $textos['porcentaje_avance']; ?></caption>
                        <thead class="small text-uppercase">
                            <tr>
                                <th scope="col" class="ps-2"><?php echo $textos['unidad'] ?? 'Un.'; ?></th>
                                <th scope="col" class="text-center"><?php echo $textos['test']; ?></th>
                                <th scope="col" class="text-center"><?php echo $textos['actividadP']; ?></th>
                                <th scope="col" class="text-center"><?php echo $textos['asistenciaP']; ?></th> 
                                <th scope="col" class="text-center pe-2"><?php echo $textos['proyecto_final_P']; ?></th> 
                            </tr>
                        </thead>
                        <tbody class="small align-middle">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php $pesos = $pesos_unidades[$i] ?? ['examen' => '?', 'actividad' => '?', 'asistencia' => '?', 'proyecto_final' => '?']; ?>
                                <tr>
                                    <td class="ps-2 fw-bold"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $pesos['examen']; ?>%</td>
                                    <td class="text-center"><?php echo $pesos['actividad']; ?>%</td>
                                    <td class="text-center"><?php echo $pesos['asistencia']; ?>%</td> 
                                    <td class="text-center pe-2"><?php echo $pesos['proyecto_final']; ?>%</td> 
                                </tr>
                            <?php endfor; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main> 
<?php
    include_once __DIR__ . '/../code_general/footer.php';
    ob_end_flush();
?>
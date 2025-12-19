<?php
    // tarjeta_curso.php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/login_alumno/verificar_examen_fecha.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/code_alumnos/styles/style_temas.php';
?>
<div class="tarjeta-curso">
    <h2 class="text-center mb-3"><?php echo $textos['temario']; ?></h2>
    <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>
    <div class="list-group tema-lista-custom">
        <a href="/assets/code_alumnos/index_alumnos.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item titulo-tema text-decoration-none text-reset">
            <i class="bi bi-book me-2"></i><?php echo $textos['tema_1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1_introduccion.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-info-circle-fill me-2"></i><?php echo $textos['introduccion']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-globe2 me-2"></i></i><?php echo $textos['tema_1.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-people-fill me-2"></i><?php echo $textos['tema_1.2.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-diagram-3 me-2"></i><?php echo $textos['tema_1.2.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-currency-dollar me-2"></i><?php echo $textos['tema_1.2.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-search me-2"></i><?php echo $textos['tema_1.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-laptop me-2"></i><?php echo $textos['tema_1.4']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-exclamation-triangle me-2"></i><?php echo $textos['tema_1.5']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-palette me-2"></i><?php echo $textos['tema_1.6']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.7.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_1.7']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.A.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u1']; ?></a>
        <?php
        $urlDestino_U1 = '/assets/code_alumnos/temas_unidad/tema_1/T_1_confirmar_examen.php?lang=' . $_SESSION['idioma'];
        $linkHref_U1 = '#';
        $extraClass_U1 = 'disabled'; 
        if (!$examenRealizado_U1 && !empty($fechaDisponible_U1) && !empty($fechaLimite_U1)) {
            $zona = new DateTimeZone('America/Monterrey');
            $ahora = new DateTime('now', $zona);
            $inicio_U1 = new DateTime($fechaDisponible_U1, $zona);
            $fin_U1 = new DateTime($fechaLimite_U1, $zona);
            if ($ahora >= $inicio_U1 && $ahora <= $fin_U1) {
                $linkHref_U1 = $urlDestino_U1;
                $extraClass_U1 = ''; 
            }
        }
        ?>
        <a href="<?php echo $linkHref_U1; ?>"
           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $extraClass_U1; ?>"
           id="link-examen-1">
           <div>
                <i class="bi bi-book me-2"></i>
                <?php 
                    echo $textos['test_u1']; 
                    if ($examenRealizado_U1) { 
                        echo " <span class='badge bg-success rounded-pill'>Realizado</span>";
                    }
                ?>
           </div>
           <span class="badge bg-light text-dark fw-normal">
                <i class="bi bi-calendar-event me-1"></i>
                <?php echo mostrarEstadoFecha($fechaDisponible_U1, $fechaLimite_U1); ?>
           </span>
        </a>
    </div>
    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>
    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-diagram-3-fill me-2"></i><?php echo $textos['tema_2']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2_introduccion.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-info-circle-fill me-2"></i><?php echo $textos['introduccion']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-lightbulb-fill me-2"></i><?php echo $textos['tema_2.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-ui-checks-grid me-2"></i><?php echo $textos['tema_2.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-building me-2"></i><?php echo $textos['tema_2.2.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-person-badge me-2"></i><?php echo $textos['tema_2.2.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-bank me-2"></i><?php echo $textos['tema_2.2.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-bar-chart-line me-2"></i><?php echo $textos['tema_2.2.4']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_2.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.A.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u2']; ?></a>
        <?php
        $urlDestino_U2 = '/assets/code_alumnos/temas_unidad/tema_2/T_2_confirmar_examen.php?lang=' . $_SESSION['idioma'];
        $linkHref_U2 = '#';
        $extraClass_U2 = 'disabled'; 
        if (!$examenRealizado_U2 && !empty($fechaDisponible_U2) && !empty($fechaLimite_U2)) {
            $zona = new DateTimeZone('America/Monterrey');
            $ahora = new DateTime('now', $zona);
            $inicio_U2 = new DateTime($fechaDisponible_U2, $zona);
            $fin_U2 = new DateTime($fechaLimite_U2, $zona);

            if ($ahora >= $inicio_U2 && $ahora <= $fin_U2) {
                $linkHref_U2 = $urlDestino_U2;
                $extraClass_U2 = ''; 
            }
        }
        ?>

        <a href="<?php echo $linkHref_U2; ?>"
           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $extraClass_U2; ?>"
           id="link-examen-2">
           <div>
                <i class="bi bi-book me-2"></i>
                <?php 
                    echo $textos['test_u2']; 
                    if ($examenRealizado_U2) { 
                        echo " <span class='badge bg-success rounded-pill'>Realizado</span>";
                    }
                ?>
           </div>
           <span class="badge bg-light text-dark fw-normal">
                <i class="bi bi-calendar-event me-1"></i>
                <?php echo mostrarEstadoFecha($fechaDisponible_U2, $fechaLimite_U2); ?>
           </span>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-cpu-fill me-2"></i><?php echo $textos['tema_3']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3_introduccion.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-info-circle-fill me-2"></i><?php echo $textos['introduccion']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-wifi me-2"></i><?php echo $textos['tema_3.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-phone me-2"></i><?php echo $textos['tema_3.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-gear-wide-connected me-2"></i><?php echo $textos['tema_3.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-telephone-fill me-2"></i><?php echo $textos['tema_3.4']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_3.5']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-person-lines-fill me-2"></i><?php echo $textos['tema_3.6']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.7.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-person-video3 me-2"></i><?php echo $textos['tema_3.7']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.8.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_3.8']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.A.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u3']; ?></a>

        <?php
        $urlDestino_U3 = '/assets/code_alumnos/temas_unidad/tema_3/T_3_confirmar_examen.php?lang=' . $_SESSION['idioma'];
        
        $linkHref_U3 = '#';
        $extraClass_U3 = 'disabled'; 

        if (!$examenRealizado_U3 && !empty($fechaDisponible_U3) && !empty($fechaLimite_U3)) {
            $zona = new DateTimeZone('America/Monterrey');
            $ahora = new DateTime('now', $zona);
            $inicio_U3 = new DateTime($fechaDisponible_U3, $zona);
            $fin_U3 = new DateTime($fechaLimite_U3, $zona);

            if ($ahora >= $inicio_U3 && $ahora <= $fin_U3) {
                $linkHref_U3 = $urlDestino_U3;
                $extraClass_U3 = ''; 
            }
        }
        ?>
        <a href="<?php echo $linkHref_U3; ?>"
           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $extraClass_U3; ?>"
           id="link-examen-3">
           <div>
                <i class="bi bi-book me-2"></i>
                <?php 
                    echo $textos['test_u3']; 
                    if ($examenRealizado_U3) { 
                        echo " <span class='badge bg-success rounded-pill'>Realizado</span>";
                    }
                ?>
           </div>
           <span class="badge bg-light text-dark fw-normal">
                <i class="bi bi-calendar-event me-1"></i>
                <?php echo mostrarEstadoFecha($fechaDisponible_U3, $fechaLimite_U3); ?>
           </span>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-shield-lock-fill me-2"></i><?php echo $textos['tema_4']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4_introduccion.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-info-circle-fill me-2"></i><?php echo $textos['introduccion']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-text me-2"></i><?php echo $textos['tema_4.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-pencil-square me-2"></i><?php echo $textos['tema_4.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-diagram-3-fill me-2"></i><?php echo $textos['tema_4.2.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-journal-check me-2"></i><?php echo $textos['tema_4.2.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-arrow-repeat me-2"></i><?php echo $textos['tema_4.2.4']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-shield-shaded me-2"></i><?php echo $textos['tema_4.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-emoji-neutral-fill me-2"></i><?php echo $textos['tema_4.4']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $textos['tema_4.5']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.5.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-hdd-network-fill me-2"></i><?php echo $textos['tema_4.5.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.5.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-bug-fill me-2"></i><?php echo $textos['tema_4.5.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_4.6']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_4.G']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.A.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u4']; ?></a>

        <?php
        $urlDestino_U4 = '/assets/code_alumnos/temas_unidad/tema_4/T_4_confirmar_examen.php?lang=' . $_SESSION['idioma'];
        
        $linkHref_U4 = '#';
        $extraClass_U4 = 'disabled'; 

        if (!$examenRealizado_U4 && !empty($fechaDisponible_U4) && !empty($fechaLimite_U4)) {
            $zona = new DateTimeZone('America/Monterrey');
            $ahora = new DateTime('now', $zona);
            $inicio_U4 = new DateTime($fechaDisponible_U4, $zona);
            $fin_U4 = new DateTime($fechaLimite_U4, $zona);

            if ($ahora >= $inicio_U4 && $ahora <= $fin_U4) {
                $linkHref_U4 = $urlDestino_U4;
                $extraClass_U4 = ''; 
            }
        }
        ?>
        <a href="<?php echo $linkHref_U4; ?>"
           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $extraClass_U4; ?>"
           id="link-examen-4">
           <div>
                <i class="bi bi-book me-2"></i>
                <?php 
                    echo $textos['test_u4']; 
                    if ($examenRealizado_U4) { 
                        echo " <span class='badge bg-success rounded-pill'>Realizado</span>";
                    }
                ?>
           </div>
           <span class="badge bg-light text-dark fw-normal">
                <i class="bi bi-calendar-event me-1"></i>
                <?php echo mostrarEstadoFecha($fechaDisponible_U4, $fechaLimite_U4); ?>
           </span>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-graph-up-arrow me-2"></i><?php echo $textos['tema_5_alt']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5_introduccion.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-info-circle-fill me-2"></i><?php echo $textos['introduccion']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-lightbulb me-2"></i><?php echo $textos['tema_5.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-tools me-2"></i><?php echo $textos['tema_5.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-diagram-3 me-2"></i><?php echo $textos['tema_5.3']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.3.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-database-check me-2"></i><?php echo $textos['tema_5.3.1']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.3.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5"><i class="bi bi-speedometer2 me-2"></i><?php echo $textos['tema_5.3.2']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-bar-chart-fill me-2"></i><?php echo $textos['tema_5.4']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_5.5']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_5.G']; ?></a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.A.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action"><i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u5']; ?></a>
        
        <?php
        $urlDestino_U5 = '/assets/code_alumnos/temas_unidad/tema_5/T_5_confirmar_examen.php?lang=' . $_SESSION['idioma'];
        
        $linkHref_U5 = '#';
        $extraClass_U5 = 'disabled'; 

        if (!$examenRealizado_U5 && !empty($fechaDisponible_U5) && !empty($fechaLimite_U5)) {
            $zona = new DateTimeZone('America/Monterrey');
            $ahora = new DateTime('now', $zona);
            $inicio_U5 = new DateTime($fechaDisponible_U5, $zona);
            $fin_U5 = new DateTime($fechaLimite_U5, $zona);

            if ($ahora >= $inicio_U5 && $ahora <= $fin_U5) {
                $linkHref_U5 = $urlDestino_U5;
                $extraClass_U5 = ''; 
            }
        }
        ?>

        <a href="<?php echo $linkHref_U5; ?>"
           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $extraClass_U5; ?>"
           id="link-examen-5">
           <div>
                <i class="bi bi-book me-2"></i>
                <?php 
                    echo $textos['test_u5']; 
                    if ($examenRealizado_U5) { 
                        echo " <span class='badge bg-success rounded-pill'>Realizado</span>";
                    }
                ?>
           </div>
           <span class="badge bg-light text-dark fw-normal">
                <i class="bi bi-calendar-event me-1"></i>
                <?php echo mostrarEstadoFecha($fechaDisponible_U5, $fechaLimite_U5); ?>
           </span>
        </a>
    </div>
</div>
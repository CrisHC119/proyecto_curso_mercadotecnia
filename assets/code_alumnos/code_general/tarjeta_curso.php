<?php
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
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-globe2 me-2"></i></i><?php echo $textos['tema_1.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
        <i class="bi bi-people-fill me-2"></i><?php echo $textos['tema_1.2.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
        <i class="bi bi-diagram-3 me-2"></i><?php echo $textos['tema_1.2.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
        <i class="bi bi-currency-dollar me-2"></i><?php echo $textos['tema_1.2.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-search me-2"></i><?php echo $textos['tema_1.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-laptop me-2"></i><?php echo $textos['tema_1.4']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-exclamation-triangle me-2"></i><?php echo $textos['tema_1.5']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-palette me-2"></i><?php echo $textos['tema_1.6']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.7.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_1.7']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_1/T_1.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u1']; ?>
        </a>        
        <a href="<?php 
                    echo $examenRealizado 
                        ? '/assets/code/alumnos/temas/tema_1/1.E.php?lang=' . $_SESSION['idioma']
                        : '/assets/code/alumnos/temas/tema_1/1.E_confirm.php?lang=' . $_SESSION['idioma']; 
                ?>" 
            class="list-group-item list-group-item-action"
            id="link-examen-1"
            data-fecha="<?php echo $fechaISO; ?>">
            <i class="bi bi-book me-2"></i>
            <?php 
                echo $textos['test_u1']; 
                if ($examenRealizado) echo " <span class='badge bg-success ms-2'>Realizado</span>";
            ?>
            -> 
            <span class="fecha-examen"><?php echo mostrarEstadoFecha($fechaExamen); ?></span>
        </a>

    </div>
    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>
    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-diagram-3-fill me-2"></i><?php echo $textos['tema_2']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-lightbulb-fill me-2"></i><?php echo $textos['tema_2.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-ui-checks-grid me-2"></i><?php echo $textos['tema_2.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-building me-2"></i><?php echo $textos['tema_2.2.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-person-badge me-2"></i><?php echo $textos['tema_2.2.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-bank me-2"></i><?php echo $textos['tema_2.2.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.2.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-bar-chart-line me-2"></i><?php echo $textos['tema_2.2.4']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_2.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_2/T_2.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u2']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u2']; ?>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-cpu-fill me-2"></i><?php echo $textos['tema_3']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-wifi me-2"></i><?php echo $textos['tema_3.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-phone me-2"></i><?php echo $textos['tema_3.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-gear-wide-connected me-2"></i><?php echo $textos['tema_3.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-telephone-fill me-2"></i><?php echo $textos['tema_3.4']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_3.5']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-person-lines-fill me-2"></i><?php echo $textos['tema_3.6']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.7.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-person-video3 me-2"></i><?php echo $textos['tema_3.7']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.8.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_3.8']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_3/T_3.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u3']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u3']; ?>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-shield-lock-fill me-2"></i><?php echo $textos['tema_4']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-file-earmark-text me-2"></i><?php echo $textos['tema_4.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-pencil-square me-2"></i><?php echo $textos['tema_4.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-diagram-3-fill me-2"></i><?php echo $textos['tema_4.2.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-journal-check me-2"></i><?php echo $textos['tema_4.2.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.2.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-arrow-repeat me-2"></i><?php echo $textos['tema_4.2.4']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-shield-shaded me-2"></i><?php echo $textos['tema_4.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-emoji-neutral-fill me-2"></i><?php echo $textos['tema_4.4']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $textos['tema_4.5']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.5.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-hdd-network-fill me-2"></i><?php echo $textos['tema_4.5.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.5.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-bug-fill me-2"></i><?php echo $textos['tema_4.5.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_4.6']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_4/T_4.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_4.G']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u4']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u4']; ?>
        </a>
    </div>


    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-graph-up-arrow me-2"></i><?php echo $textos['tema_5_alt']; ?>
        </div>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-lightbulb me-2"></i><?php echo $textos['tema_5.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-tools me-2"></i><?php echo $textos['tema_5.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-diagram-3 me-2"></i><?php echo $textos['tema_5.3']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.3.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-database-check me-2"></i><?php echo $textos['tema_5.3.1']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.3.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-speedometer2 me-2"></i><?php echo $textos['tema_5.3.2']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-bar-chart-fill me-2"></i><?php echo $textos['tema_5.4']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_5.5']; ?>
        </a>
        <a href="/assets/code_alumnos/temas_unidad/tema_5/T_5.Glosario.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_5.G']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u5']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u5']; ?>
        </a>
    </div>
    
</div>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    <div id="toastAviso" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMensaje"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>
<script src="/assets/code_alumnos/scripts/script_tarjeta_curso_examen.js"></script>
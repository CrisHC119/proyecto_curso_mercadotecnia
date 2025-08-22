<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.5.php'; 
    $siguiente = 'T_1.7.php'; 
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.6']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0166']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0167']; ?></p>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0167_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0167_2']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0168']; ?></p></strong>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0168_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0168_2']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0169']; ?></p></strong>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0169_1']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0170']; ?></p></strong>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0170_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0170_2']; ?>
                    </li>          
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0171']; ?></p></strong>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_2']; ?>
                    </li>          
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_3']; ?>
                    </li>                    
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_4']; ?>
                    </li>                    
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_5']; ?>
                    </li>                    
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_6']; ?>
                    </li>                    
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_7']; ?>
                    </li>          
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0172']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0173']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0174']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0175']; ?></p>
            </div>
        </div>
    </div>
    <?php
        include_once __DIR__ . '/../../code_general/tarjeta_curso.php';
    ?>
</div>
<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>
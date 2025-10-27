<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.4.php'; 
    $siguiente = 'T_1.6.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.5']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0156']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0157']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0158']; ?></p></strong>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_6']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0159']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0160']; ?></p>
                <p class="justificado"><strong><?php echo $textos['parrafo_0161']; ?></strong><?php echo $textos['parrafo_0161_1']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0162']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0163']; ?></p>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0163_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0163_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0163_3']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0164']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0165']; ?></p>
            </div>
        </div>
    </div>
    <?php
        include __DIR__ . '/../../code_general/tarjeta_curso.php';
    ?>
</div>
<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>
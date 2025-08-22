<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.2.php'; 
    $siguiente = 'T_1.2.2.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.2.1']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0037']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0038']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0039']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0040']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0041']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0042']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0043']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0044']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0046']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0047']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0048']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0049']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0050']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0051']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0052']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0053']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0054']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0055']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0056']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0057']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0058']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0059']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0060']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0061']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0062']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0063']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0064']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0065']; ?>
                    </li>
                </ul>
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
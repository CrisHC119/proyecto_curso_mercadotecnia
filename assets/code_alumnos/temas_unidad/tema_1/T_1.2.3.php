<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.2.2.php'; 
    $siguiente = 'T_1.3.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.2.3']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0088']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0089']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0090_1']; ?></strong><?php echo $textos['parrafo_0090']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0091_1']; ?></strong><?php echo $textos['parrafo_0091']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0092_1']; ?></strong><?php echo $textos['parrafo_0092']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0093_1']; ?></strong><?php echo $textos['parrafo_0093']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0094_1']; ?></strong><?php echo $textos['parrafo_0094']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0095_1']; ?></strong><?php echo $textos['parrafo_0095']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0096_1']; ?></strong><?php echo $textos['parrafo_0096']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0097']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0098']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0099']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0100']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0101']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0102']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0103']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0104']; ?></p>
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
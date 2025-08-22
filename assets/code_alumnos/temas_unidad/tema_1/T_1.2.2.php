<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.2.1.php'; 
    $siguiente = 'T_1.2.3.php'; 
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.2.2']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0066']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0067']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0068']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0069']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0070']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0071']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0072']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0073']; ?></p></strong>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0074_1']; ?></strong><?php echo $textos['parrafo_0074']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0075_1']; ?></strong><?php echo $textos['parrafo_0075']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0076_1']; ?></strong><?php echo $textos['parrafo_0076']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0077_1']; ?></strong><?php echo $textos['parrafo_0077']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0078']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><strong><?php echo $textos['parrafo_0079_1']; ?></strong><?php echo $textos['parrafo_0079']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><strong><?php echo $textos['parrafo_0080_1']; ?></strong><?php echo $textos['parrafo_0080']; ?>
                    </li>
                </ul>
                <div class="d-flex align-items-start justify-content-between flex-wrap">
                    <div style="flex: 1; min-width: 250px;">
                        <strong><p class="justificado"><?php echo $textos['parrafo_0081']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0082']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0083']; ?></p>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0084']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0085']; ?></p>
                        <ul class="list-unstyled justificado mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_4']; ?>
                            </li>
                        </ul>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0086']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0087']; ?></p>
                        <ul class="list-unstyled justificado mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0087_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0087_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0087_3']; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                        <img src="/assets/images/temas/tema_1/image_T_1.2.2.jpg" alt="Descripción" class="img-fluid rounded shadow" />
                        <img src="/assets/images/temas/tema_1/image_T_1.2.2_2.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                    </div>
                </div>
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
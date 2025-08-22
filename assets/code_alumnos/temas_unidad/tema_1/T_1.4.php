<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.3.php'; 
    $siguiente = 'T_1.5.php'; 
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.4']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0126']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0127']; ?></p>
                <p class="justificado">
                    <?php echo $textos['parrafo_0128']; ?>
                    <a href="https://sell.amazon.com/es/programs/handmade" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0128_hyp']; ?>
                    </a>
                    <?php echo $textos['parrafo_0128_1']; ?>
                </p>
                <p class="justificado">
                    <?php echo $textos['parrafo_0129']; ?>
                    <a href="https://advertising.amazon.com/solutions/products/amazon-live?initialSessionID=140-2946941-0614067&ld=NSGoogle&ldStackingCodes=NSGoogle" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0129_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0130']; ?></p>
                <ul class="list-unstyled justificado mt-3">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_2']; ?>
                        <a href="https://sell.amazon.com/es/programs/amazon-business" target="_blank" style="color: #007bff; text-decoration: underline;">
                            <?php echo $textos['parrafo_0130_2_hyp']; ?>
                        </a>
                        <?php echo $textos['parrafo_0130_2_2']; ?>
                        <a href="https://sell.amazon.com/es/blog/reselling" target="_blank" style="color: #007bff; text-decoration: underline;">
                            <?php echo $textos['parrafo_0130_2_hyp_2']; ?>
                        </a>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_6']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_7']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_8']; ?>
                    </li>        
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0131']; ?></p>
                <div class="d-flex align-items-start justify-content-between flex-wrap">
                    <div style="flex: 1; min-width: 250px;">
                        <strong><p class="justificado"><?php echo $textos['parrafo_0132']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0133']; ?></p>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0134']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0135']; ?></p>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0136']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0137']; ?></p>
                        <ul class="list-unstyled justificado mt-3">
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0137_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0137_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0137_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0137_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0137_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0137_6']; ?>
                            </li>
                        </ul>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0138']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0139']; ?></p>
                        <ul class="list-unstyled justificado mt-3">
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0139_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0139_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0139_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0139_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="me-2"></i><?php echo $textos['parrafo_0139_5']; ?>
                            </li>
                        </ul>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0140']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0141']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0142']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0143']; ?></p>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0144']; ?></p></strong>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0145']; ?></strong><?php echo $textos['parrafo_0145_1']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0146']; ?></p>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0147']; ?></strong><?php echo $textos['parrafo_0147_1']; ?></p>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0148']; ?></strong><?php echo $textos['parrafo_0148_1']; ?></p>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0149']; ?></strong><?php echo $textos['parrafo_0149_1']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0149_2']; ?></p>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0150']; ?></strong><?php echo $textos['parrafo_0150_1']; ?></p>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0151']; ?></strong><?php echo $textos['parrafo_0151_1']; ?></p>
                        <p class="justificado"><strong><?php echo $textos['parrafo_0152']; ?></strong><?php echo $textos['parrafo_0152_1']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0152_2']; ?></p>
                        <strong><p class="justificado"><?php echo $textos['parrafo_0153']; ?></p></strong>
                        <p class="justificado"><?php echo $textos['parrafo_0154']; ?></p>
                        <p class="justificado"><?php echo $textos['parrafo_0155']; ?></p>
                    </div>
                    <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                        <img src="/assets/images/temas/tema_1/image_T_1.4.jpg" alt="Descripción" class="img-fluid rounded shadow" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_2.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_3.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_4.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_5.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_6.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_7.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                        <img src="/assets/images/temas/tema_1/image_T_1.4_8.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
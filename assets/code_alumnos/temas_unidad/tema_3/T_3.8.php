<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_3.7.php'; 
    $siguiente = 'T_3.Glosario.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_3.8']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0436']; ?><br>
                    <a href="<?php echo $textos['parrafo_0436_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0436_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0437']; ?><br>
                    <a href="<?php echo $textos['parrafo_0437_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0437_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0438']; ?><br>
                    <a href="<?php echo $textos['parrafo_0438_o_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0438_hyp']; ?>
                    </a>
                    <a href="<?php echo $textos['parrafo_0438_o_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0438_1_hyp']; ?>
                    </a>                
                    <a href="<?php echo $textos['parrafo_0438_o_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0438_2_hyp']; ?>
                    </a>                
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0439']; ?><br>
                    <a href="<?php echo $textos['parrafo_0439_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0439_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0440']; ?><br>
                    <a href="<?php echo $textos['parrafo_0440_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0440_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0441']; ?><br>
                    <a href="<?php echo $textos['parrafo_0441_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0441_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0442']; ?><br>
                    <a href="<?php echo $textos['parrafo_0442_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0442_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0443']; ?><br>
                    <a href="<?php echo $textos['parrafo_0443_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0443_hyp']; ?>
                    </a>
                </p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.8.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.8_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
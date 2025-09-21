<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.6.php'; 
    $siguiente = 'T_1.G.php'; 
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_4.6']; ?></h1>

                <p class="justificado"><?php echo $textos['parrafo_0629']; ?><br>
                    <a href="<?php echo $textos['parrafo_0629_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0629_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0630']; ?><br>
                    <a href="<?php echo $textos['parrafo_0630_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0630_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0631']; ?><br>
                    <a href="<?php echo $textos['parrafo_0631_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0631_hyp']; ?>
                    </a>
                    <a href="<?php echo $textos['parrafo_0631_hyp2']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0631_hyp2']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0632']; ?><br>
                    <a href="<?php echo $textos['parrafo_0632_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0632_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0633']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0634']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0635']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0636']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0637']; ?><br>
                    <a href="<?php echo $textos['parrafo_0637_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0637_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0638']; ?><br>
                    <a href="<?php echo $textos['parrafo_0638_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0638_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0639']; ?><br>
                    <a href="<?php echo $textos['parrafo_0639_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0639_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0640']; ?><br>
                    <a href="<?php echo $textos['parrafo_0640_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0640_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0641']; ?><br>
                    <a href="<?php echo $textos['parrafo_0641_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0641_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0642']; ?><br>
                <p class="justificado"><?php echo $textos['parrafo_0643']; ?><br>
                    <a href="<?php echo $textos['parrafo_0643_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0643_hyp']; ?>
                    </a>
                </p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_4/image_T_4.6.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_4/image_T_4.6_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
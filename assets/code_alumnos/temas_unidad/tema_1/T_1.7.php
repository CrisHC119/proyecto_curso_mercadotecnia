<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.6.php'; 
    $siguiente = 'T_1.Glosario.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.7']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0176']; ?><br>
                    <a href="<?php echo $textos['parrafo_0176_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0176_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0177']; ?><br>
                    <a href="<?php echo $textos['parrafo_0177_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0177_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0178']; ?><br>
                    <a href="<?php echo $textos['parrafo_0178_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0178_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0179']; ?><br>
                    <a href="<?php echo $textos['parrafo_0179_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0179_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0180']; ?><br>
                    <a href="<?php echo $textos['parrafo_0180_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0180_hyp']; ?>
                    </a>
                </p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_1/image_T_1.7.jpg" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_1/image_T_1.7_1.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
            </div>
        </div>
    </div>
    <?php
        include __DIR__ . '/../../code_general/tarjeta_curso.php';
    ?>
</div>
<?php
    include __DIR__ . '/../../../code_general/footer.php';
?>
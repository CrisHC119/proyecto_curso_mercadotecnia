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
                <h1 class="text-center mb-4"><?php echo $textos['tema_5.5']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0762']; ?><br>
                    <a href="<?php echo $textos['parrafo_0762_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0762_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0763']; ?><br>
                    <a href="<?php echo $textos['parrafo_0763_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0763_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0764']; ?><br>
                    <a href="<?php echo $textos['parrafo_0764_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0764_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0765']; ?><br>
                    <a href="<?php echo $textos['parrafo_0765_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0765_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0766']; ?><br>
                    <a href="<?php echo $textos['parrafo_0766_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0766_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0767']; ?><br>
                    <a href="<?php echo $textos['parrafo_0767_hypO']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0767_hyp']; ?>
                        <?php echo $textos['parrafo_0767_hyp2']; ?>
                    </a>
                </p>                
                <p class="justificado"><?php echo $textos['parrafo_0768']; ?><br>
                    <a href="<?php echo $textos['parrafo_0768_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0768_hyp']; ?>
                    </a>
                </p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_5/image_T_5.5.png" alt="Descripción" class="img-fluid rounded shadow" />
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
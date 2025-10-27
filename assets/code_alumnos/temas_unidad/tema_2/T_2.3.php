<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.2.4.php'; 
    $siguiente = 'T_2.Glosario.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_2.3']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0781']; ?><br>
                    <a href="<?php echo $textos['parrafo_0781_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0781_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0783']; ?><br>
                    <a href="<?php echo $textos['parrafo_0783_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0783_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0784']; ?><br>
                    <a href="<?php echo $textos['parrafo_0784_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0784_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0785']; ?><br>
                    <a href="<?php echo $textos['parrafo_0785_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0785_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0786']; ?><br>
                    <a href="<?php echo $textos['parrafo_0786_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0786_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0787']; ?><br>
                    <a href="<?php echo $textos['parrafo_0787_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0787_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0788']; ?><br>
                    <a href="<?php echo $textos['parrafo_0788_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0788_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0789']; ?><br>
                    <a href="<?php echo $textos['parrafo_0789_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0789_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0790']; ?><br>
                    <a href="<?php echo $textos['parrafo_0790_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0790_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0791']; ?><br>
                    <a href="<?php echo $textos['parrafo_0791_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0791_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0792']; ?><br>
                    <a href="<?php echo $textos['parrafo_0792_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0792_hyp']; ?>
                    </a>
                </p>
                <p class="justificado"><?php echo $textos['parrafo_0782']; ?><br>
                    <a href="<?php echo $textos['parrafo_0782_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
                        <?php echo $textos['parrafo_0782_hyp']; ?>
                    </a>
                </p>
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
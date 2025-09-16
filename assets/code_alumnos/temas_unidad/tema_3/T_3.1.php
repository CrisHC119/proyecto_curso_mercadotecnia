<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_1.2.4.php'; 
    $siguiente = 'T_3.1.php'; 
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_3.1']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0349']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0350']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0351']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0352']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0353']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <p class="justificado"><?php echo $textos['parrafo_0354']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0355']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0356']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.1.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.1_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
<style>
  ul.list-unstyled.justificado li {
  line-height: 1.2;
}
</style>
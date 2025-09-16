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
        <h2 class="text-center mb-4"><?php echo $textos['tema_3.3']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0365']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0366']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0367']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0368']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0369']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <p class="justificado"><?php echo $textos['parrafo_0370']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0371']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0372']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0373']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0374']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.3.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.3_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
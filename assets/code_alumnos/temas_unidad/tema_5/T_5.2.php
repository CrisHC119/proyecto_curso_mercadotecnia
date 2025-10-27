<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_5.1.php'; 
    $siguiente = 'T_5.3.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_5.2']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0681']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0681_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0681_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0681_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0681_4']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0681_5']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0681_6']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0682']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0683']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0684']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0685']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0686']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0687']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0688']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <p class="justificado"><?php echo $textos['parrafo_0689']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0690']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0691']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0692']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_5/image_T_5.1.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_5/image_T_5.1_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
<style>
  ul.list-unstyled.justificado li {
  line-height: 1.2;
}
</style>
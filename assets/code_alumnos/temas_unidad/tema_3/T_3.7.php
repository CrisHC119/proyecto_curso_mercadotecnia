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
        <h2 class="text-center mb-4"><?php echo $textos['tema_3.7']; ?></h2>

        <p class="justificado"><?php echo $textos['parrafo_0423']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0424']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0425']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0426']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0427']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0428']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0429']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0430']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0431']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0432']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0433']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_4']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0434']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0435']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_6']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_7']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_8']; ?>
                    </li>
                </ul>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.7.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.7_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
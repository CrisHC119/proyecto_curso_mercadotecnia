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
        <h2 class="text-center mb-4"><?php echo $textos['tema_3.4']; ?></h2>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <p class="justificado"><?php echo $textos['parrafo_0375']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0376']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_5']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0377']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0378']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0379']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0380']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0380_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0380_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0380_3']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0381']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0382']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.4.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.4_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                <img src="/assets/images/temas/tema_3/image_T_3.4_3.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
                <img src="/assets/images/temas/tema_3/image_T_3.4_4.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
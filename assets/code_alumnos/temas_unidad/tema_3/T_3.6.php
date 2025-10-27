<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_3.5.php'; 
    $siguiente = 'T_3.7.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_3.6']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0405']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0406']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0407']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0408']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0409']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0409_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0409_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0409_3']; ?>
            </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0410']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0411']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0412']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0413']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0414']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0415']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0416']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0417']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0418']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_4']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_5']; ?>
            </li>
        </ul>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <p class="justificado"><?php echo $textos['parrafo_0419']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0419_1']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0420']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0421']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0421_1']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0422']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_4']; ?>
                    </li>
                </ul>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.6.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.6_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
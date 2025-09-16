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
        <h2 class="text-center mb-4"><?php echo $textos['tema_3.5']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0383']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0384']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0385']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0386']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0387']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0388']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0389']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0390']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0391']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0392']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0393']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0394']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0395']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0396']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0397']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0398']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0399']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0400']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0401']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0402']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_6']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_7']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_8']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_9']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0403']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0404']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_3/image_T_3.5.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_3/image_T_3.5_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
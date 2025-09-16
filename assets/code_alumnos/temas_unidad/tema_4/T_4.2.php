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
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.2']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0497']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0498']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0498_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0498_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0498_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0498_4']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0499']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0500']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0501']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0502']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0502_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0502_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0502_3']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0503']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0504']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0505']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0506']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0507']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0508']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0509']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0510']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0511']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0512']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0513']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_01']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_02']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_03']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_04']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_05']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_06']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_07']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_08']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_09']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0513_10']; ?>
                    </li>
                </ul>
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
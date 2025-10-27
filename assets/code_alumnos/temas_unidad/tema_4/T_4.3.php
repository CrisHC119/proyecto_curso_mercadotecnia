<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_4.2.4.php'; 
    $siguiente = 'T_4.4.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.3']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0574']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0575']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0576']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0577']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0578']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0579']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0579_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0579_2']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0580']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0581']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0582']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0582_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0582_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0582_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0582_4']; ?>
            </li>
        </ul>
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
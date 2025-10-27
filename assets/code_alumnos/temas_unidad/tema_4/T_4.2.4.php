<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_4.2.3.php'; 
    $siguiente = 'T_4.3.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.2.4']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0548']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0549']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0550']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0551']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0552']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0553']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0554']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0554_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0554_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0554_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0554_4']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0554_5']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0554_6']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0555']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0556']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0557']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0558']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0559']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0560']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0561']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0562']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0563']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0564']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0565']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0566']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0567']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0568']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0569']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0570']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0571']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0572']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0573']; ?></p>
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
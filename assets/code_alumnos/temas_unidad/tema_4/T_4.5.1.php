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
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.5.1']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0603']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0604']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0605']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0606']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0607']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0608']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0608_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0608_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0608_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0608_4']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0609']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0610']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0610_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0610_2']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0610_3']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0610_4']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0610_5']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0611']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0611_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0611_2']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0612']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0612_1']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0613']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0614']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0615']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0616']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0617']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0618']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0619']; ?></p>
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
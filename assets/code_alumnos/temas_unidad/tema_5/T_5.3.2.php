<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_5.3.1.php'; 
    $siguiente = 'T_5.4.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_5.3.2']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0712']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0713']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0714']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0715']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0716']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0717']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0718']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0719']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0720']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0721']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0722']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0723']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0724']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0725']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0726']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0727']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0728']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0729']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0730']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0731']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0732']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0733']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0734']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0735']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0736']; ?></p>
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
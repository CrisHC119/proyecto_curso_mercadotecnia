<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_4.2.2.php'; 
    $siguiente = 'T_4.2.4.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.2.3']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0540']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0541']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0542']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0543']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0544']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0545']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0546']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0547']; ?></p>
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
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
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.5']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0591']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0592']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0593']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0594']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0595']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0596']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0597']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0598']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0599']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0600']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0601']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0602']; ?></p>
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
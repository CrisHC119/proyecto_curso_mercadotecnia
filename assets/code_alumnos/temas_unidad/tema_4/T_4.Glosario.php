<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_4.6.php'; 
    $siguiente = 'T_4.A.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.G']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0644']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0645']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0646']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0647']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0648']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0649']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0650']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0651']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0652']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0653']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0654']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0655']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0656']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0657']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0658']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0659']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0660']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0661']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0662']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0663']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0664']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0665']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0666']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0667']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0668']; ?></p>
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
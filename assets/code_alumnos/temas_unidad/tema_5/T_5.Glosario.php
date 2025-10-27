<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_5.5.php'; 
    $siguiente = 'T_5.A.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_5.G']; ?></h2>

        <p class="justificado"><?php echo $textos['parrafo_0769']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0770']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0771']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0772']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0773']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0774']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0775']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0776']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0777']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0778']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0779']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0780']; ?></p>
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
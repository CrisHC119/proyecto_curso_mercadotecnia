<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.3.php'; 
    $siguiente = 'T_2.A.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.G']; ?></h2>
        <strong><p class="justificado"><?php echo $textos['parrafo_0793']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0794']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0795']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0796']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0797']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0798']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0799']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0800']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0801']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0802']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0803']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0804']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0805']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0806']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0807']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0808']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0809']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0810']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0811']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0812']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0813']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0814']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0815']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0816']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0817']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0818']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0819']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0820']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0821']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0822']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0823']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0824']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0825']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0826']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0827']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0828']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0829']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0830']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0831']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0832']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0833']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0834']; ?></p>
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
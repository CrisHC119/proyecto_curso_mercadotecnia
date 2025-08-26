<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.1.php'; 
    $siguiente = 'T_2.2.1.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_2.2']; ?></h2>
        <strong><p class="justificado"><?php echo $textos['parrafo_0215']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0216']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0217']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0218']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0219']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0220']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0221']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0222']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0226']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0223']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0224']; ?></strong><?php echo $textos['parrafo_0224_1']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0225']; ?></strong><?php echo $textos['parrafo_0225_1']; ?></p>
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
<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_4.2.php'; 
    $siguiente = 'T_4.2.3.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.2.2']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0514']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0515']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0516']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0517']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0518']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0519']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0520']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0521']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0522']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0523']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0524']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0525']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0526']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0527']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0528']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0529']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0530']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0531']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0532']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <p class="justificado"><?php echo $textos['parrafo_0533']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0534']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0535']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0536']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0537']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0538']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0539']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_4/image_T_4.2.2.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_4/image_T_4.2.2_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
            </div>
        </div>
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
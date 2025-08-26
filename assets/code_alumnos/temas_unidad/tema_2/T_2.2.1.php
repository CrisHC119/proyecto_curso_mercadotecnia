<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.2.php'; 
    $siguiente = 'T_2.2.2.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_2.2.1']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0227']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0228']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0229']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0230']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0231']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0232']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0233']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0234']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0235']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0236']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0237']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0238']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0239']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0240']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0241']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0242']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0243']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0244']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0245']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0246']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0247']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0248']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0249']; ?></p>
        <ul class="list-unstyled justificado">
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0249_1']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start mt-4">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0249_2']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start mt-4">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0249_3']; ?></span>
            </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0250']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0251']; ?></p>
        <ul class="list-unstyled justificado">
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0251_1']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start mt-4">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0251_2']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start mt-4">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0251_3']; ?></span>
            </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0252']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0253']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0254']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0255']; ?></p>
        <ul class="list-unstyled justificado">
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0255_1']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start mt-4">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0255_2']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start mt-4">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0255_3']; ?></span>
            </li>
        </ul>
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
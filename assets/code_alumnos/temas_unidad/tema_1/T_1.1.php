<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = '../../index_alumnos.php'; 
    $siguiente = 'T_1.2.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_1.1']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0006']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0007']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0008']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0009']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0010']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0011']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0012']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0013']; ?></span>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0014']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0015']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0016']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0017']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0018']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0019']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0020']; ?></p>
        <div class="text-center">
            <h4><?php echo $textos['parrafo_0021']; ?></h4>
        </div>
        <p class="justificado mt-4"><?php echo $textos['parrafo_0022']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0023']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0024']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0025']; ?></p>
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
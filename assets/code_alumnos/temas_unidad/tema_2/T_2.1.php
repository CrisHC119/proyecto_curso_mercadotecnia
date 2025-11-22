<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2_introduccion.php'; 
    $siguiente = 'T_2.2.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_2.1']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0181']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0182']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0183']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0184']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0185']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0186']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0187']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0188']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0189']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0190']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0191']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0192']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0193']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0194']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0195']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0196']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0197']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0198']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0199']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0200']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0201']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0202']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0203']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0204']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0205']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0206']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0207']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0208']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0209']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0210']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0211']; ?></p>
        <ul class="list-unstyled justificado">
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0211_1']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0211_2']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0211_3']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0211_4']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0211_5']; ?></span>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0212']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0213']; ?></p>
        <ul class="list-unstyled justificado">
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0213_1']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0213_2']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0213_3']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0213_4']; ?></span>
            </li>
            <li class="mb-1 d-flex align-items-start">
                <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
                <span><?php echo $textos['parrafo_0213_5']; ?></span>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0214']; ?></p>
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
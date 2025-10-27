<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.2.2.php'; 
    $siguiente = 'T_2.2.4.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_2.2.3']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0273']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0274']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0275']; ?></p></strong>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0275_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0275_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0275_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0275_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0275_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0275_6']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0276']; ?></p></strong>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0276_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0276_2']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0277']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0278']; ?></p></strong>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0278_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0278_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0278_3']; ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
            <img src="/assets/images/temas/tema_2/image_T_2.2.3.jpg" alt="Descripción" class="img-fluid rounded shadow" />
            <img src="/assets/images/temas/tema_2/image_T_2.2.3_2.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
            <img src="/assets/images/temas/tema_2/image_T_2.2.3_3.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
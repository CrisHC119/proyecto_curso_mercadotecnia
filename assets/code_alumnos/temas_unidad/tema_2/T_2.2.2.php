<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.2.1.php'; 
    $siguiente = 'T_2.2.3.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_2.2.2']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0256']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0257']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0258']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0259']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0260']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0260_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0260_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0260_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0260_4']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0261']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0262']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0263']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0264']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0265']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0266']; ?></p></strong>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0266_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0266_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0266_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0266_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0266_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0266_6']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0267']; ?></p></strong>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0267_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0267_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0267_3']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0268']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0269']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0270']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0271']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0272']; ?></p>
            </div>
        </div>
        <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
            <img src="/assets/images/temas/tema_2/image_T_2.2.2.jpg" alt="Descripción" class="img-fluid rounded shadow" />
            <img src="/assets/images/temas/tema_2/image_T_2.2.2_2.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
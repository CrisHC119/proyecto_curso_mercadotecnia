<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $siguiente = 'T_4.2.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['tema_4.1']; ?></h2>
        <p class="justificado"><?php echo $textos['parrafo_0453']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0454']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0455']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0456']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0457']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0458']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0459']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0460']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0461']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0462']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0463']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0464']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0465']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0466']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0467']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0468']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0469']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0470']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0471']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0472']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0473']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0474']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0475']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0476']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0477']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0478']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0479']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0480']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0481']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0482']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0483']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0484']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0485']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0486']; ?></p>
        <ul class="list-unstyled justificado mt-4">
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0486_1']; ?>
            </li>
            <li class="mb-3">
                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0486_2']; ?>
            </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0487']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0488']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0489']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0490']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0491']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0492']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0493']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0494']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0495']; ?></p>
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_6']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0495_7']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0496']; ?></p>
            </div>
            <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
                <img src="/assets/images/temas/tema_4/image_T_4.1.png" alt="Descripción" class="img-fluid rounded shadow" />
                <img src="/assets/images/temas/tema_4/image_T_4.1_2.png" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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
<?php
    $page_4 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/styles/style_material.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4"><?php echo $textos['title_descargar_temario']; ?></h2>
        <div id="mainContent">
            <h4 class="text-center mb-4"><?php echo $textos['titulo']; ?></h4>
            <div class="text-center">
                <a href="/assets/pdf/AE045 Mercadotecnia Electronica.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-tema_0 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['descargar_pdf_temas']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_1']; ?></h4>
                <div class="text-center">
                <a href="/assets/pdf/Contenido_Unidades/Unidad 1.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-tema_1 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_1']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_2']; ?></h4>
                <div class="text-center">
                <a href="/assets/pdf/Contenido_Unidades/Unidad 2.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-tema_2 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_2']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_3']; ?></h4>
                <div class="text-center">
                <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-tema_3 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_3']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_4']; ?></h4>
                <div class="text-center">
                <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-tema_4 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_4']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_5']; ?></h4>
                <div class="text-center">
                <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-tema_5 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_5']; ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
  include_once __DIR__ . '/../code_general/footer.php';
?>
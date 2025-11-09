<?php
    $page_7 = 'active';
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
        <h2 class="text-center mb-4">Material del las unidades</h2>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_1']; ?></h4>
                <div class="text-center">
                <a href="scripts/script_acceso_archivos.php?file=tema1" title="<?php echo $textos['title_descargar_temario']; ?>" class="btn btn-tema_1 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_1']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_2']; ?></h4>
                <div class="text-center">
                <a href="scripts/script_acceso_archivos.php?file=tema2" title="<?php echo $textos['title_descargar_temario']; ?>" class="btn btn-tema_2 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_2']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_3']; ?></h4>
                <div class="text-center">
                <a href="scripts/script_acceso_archivos.php?file=tema3" title="<?php echo $textos['title_descargar_temario']; ?>" class="btn btn-tema_3 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_3']; ?> (Pendiente)
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_4']; ?></h4>
                <div class="text-center">
                <a href="scripts/script_acceso_archivos.php?file=tema4" title="<?php echo $textos['title_descargar_temario']; ?>" class="btn btn-tema_4 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_4']; ?>
                </a>
            </div>
        </div>
        <div id="mainContent" class="mt-4">
            <h4 class="text-center mb-4"><?php echo $textos['tema_5']; ?></h4>
                <div class="text-center">
                <a href="scripts/script_acceso_archivos.php?file=tema5" title="<?php echo $textos['title_descargar_temario']; ?>" class="btn btn-tema_5 text-white d-inline-block px-4 py-2">
                    <?php echo $textos['download_tema_5']; ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
  include_once __DIR__ . '/../code_general/footer.php';
?>
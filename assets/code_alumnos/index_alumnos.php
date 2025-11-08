<?php
    $page_1 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/code_general/info_icon.php';
    include_once __DIR__ . '/styles/style_index.php';
    include_once __DIR__ . '/../styles/style_video.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h1 class="text-center mb-4 titulo"><?php echo $textos['titulo']; ?></h1>
        <div class="video-container text-center mb-4">
            <video 
                src="/assets/videos/video_introductorio.mp4" 
                controls 
                muted 
                loop
                preload="metadata">
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>
        <p class="justificado">
            <?php echo $textos['parrafo_0001']; ?>
        </p>
        <p class="justificado">
            <?php echo $textos['parrafo_0002']; ?>      
        </p>
        <p class="justificado">
            <?php echo $textos['parrafo_0003']; ?>
        </p>
        <p class="justificado">
            <?php echo $textos['parrafo_0004']; ?>
        </p>
        <p class="justificado">
            <?php echo $textos['parrafo_0005']; ?>
        </p>
        <div class="text-center mt-4">
            <a href="temas_unidad/tema_1/T_1.1.php" class="btn btn-tema text-white">
                <i class="bi bi-play-circle-fill"></i><?php echo $textos['inicio_curso']; ?>
            </a>
        </div>
    </div>
    <div class="contenedor-lateral d-none d-md-flex">
        <div class="tarjeta-curso">
            <h2 class="text-center"><?php echo $textos['pendiente']; ?></h2>
            <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>
            <p>
                <?php echo $textos['objetivo_3'];?><br>
            </p>
        </div>
        <div class="tarjeta-curso">
            <h2 class="text-center"><?php echo $textos['objetivos']; ?></h2>
            <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>
            <p>
                <?php echo $textos['objetivo_1'];?><br>
                <?php echo $textos['objetivo_2'];?><br>
                <?php echo $textos['objetivo_3'];?><br>
            </p>
        </div>
        <?php
        include_once __DIR__ . '/code_general/temas_unidad_1_index.php';
        ?>
    </div>
</div>
<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = '../../index_alumnos.php'; 
    $siguiente = 'T_1.1.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <h1 class="text-center mb-4"><?php echo $textos['introduccion']; ?></h1>
        <div class="presentacion-container mb-4">
            <ul class="nav nav-tabs" id="presentacionTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-tab-pane" type="button" role="tab" aria-controls="video-tab-pane" aria-selected="true">
                        <i class="bi bi-play-btn-fill"></i> <?php echo $textos['video']; ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pdf-tab" data-bs-toggle="tab" data-bs-target="#pdf-tab-pane" type="button" role="tab" aria-controls="pdf-tab-pane" aria-selected="false">
                        <i class="bi bi-file-earmark-ppt-fill"></i> <?php echo $textos['presentacion']; ?>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="presentacionTabContent">
                <div class="tab-pane fade show active" id="video-tab-pane" role="tabpanel" aria-labelledby="video-tab" tabindex="0">
                    <div class="ratio ratio-16x9">
                        <video 
                            src="/assets/videos/videos_introduccion/video_introduccion_T1.mp4" 
                            controls 
                            muted 
                            loop
                            preload="metadata"
                            class="w-100">
                            Tu navegador no soporta la etiqueta de video.
                        </video>
                    </div>
                </div>
                <div class="tab-pane fade" id="pdf-tab-pane" role="tabpanel" aria-labelledby="pdf-tab" tabindex="0">
                    <div class="pdf-viewer-wrapper">
                        <iframe class="visor-pdf"
                            src="/assets/pdf/Presentacion_Unidades/UNIDAD 1 INTRODUCCION A LA MERCADOTECNIA ELECTRONICA.pdf">
                        </iframe>
                    </div>
                </div>
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
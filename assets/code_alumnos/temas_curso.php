<?php
    $page_2 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../styles/style_temas_curso.php';
    include_once __DIR__ . '/../styles/style_botones.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<main class="flex-fill">
    <div class="container text-center mt-4 mb-2">
        <h1 class="display-6 fw-bold text-dark"><?php echo $textos['temario']; ?></h1>
    </div>
    <div class="layout-container">
        <aside class="indice-wrapper">
            <div class="indice-box">
                <h3>Índice</h3>
                <nav id="navbar-temario">
                    <a href="#tema_1" class="nav-link-tema">1. <?php echo $textos['tema_1']; ?></a>
                    <a href="#tema_1_1" class="nav-link-subtema"><?php echo $textos['tema_1.1']; ?></a>
                    <a href="#tema_1_2" class="nav-link-subtema"><?php echo $textos['tema_1.2']; ?></a>
                    <a href="#tema_1_2_1" class="nav-link-subtema"><?php echo $textos['tema_1.2.1']; ?></a>
                    <a href="#tema_1_2_2" class="nav-link-subtema"><?php echo $textos['tema_1.2.2']; ?></a>
                    <a href="#tema_1_2_3" class="nav-link-subtema"><?php echo $textos['tema_1.2.3']; ?></a>
                    <a href="#tema_1_3" class="nav-link-subtema"><?php echo $textos['tema_1.3']; ?></a>
                    <a href="#tema_1_4" class="nav-link-subtema"><?php echo $textos['tema_1.4']; ?></a>
                    <a href="#tema_1_5" class="nav-link-subtema"><?php echo $textos['tema_1.5']; ?></a>
                    <a href="#tema_1_6" class="nav-link-subtema"><?php echo $textos['tema_1.6']; ?></a>
                    
                    <a href="#tema_2" class="nav-link-tema">2. <?php echo $textos['tema_2']; ?></a>
                    <a href="#tema_2_1" class="nav-link-subtema"><?php echo $textos['tema_2.1']; ?></a>
                    <a href="#tema_2_2" class="nav-link-subtema"><?php echo $textos['tema_2.2']; ?></a>
                    <a href="#tema_2_2_1" class="nav-link-subtema"><?php echo $textos['tema_2.2.1']; ?></a>
                    <a href="#tema_2_2_2" class="nav-link-subtema"><?php echo $textos['tema_2.2.2']; ?></a>
                    <a href="#tema_2_2_3" class="nav-link-subtema"><?php echo $textos['tema_2.2.3']; ?></a>

                    <a href="#tema_3" class="nav-link-tema">3. <?php echo $textos['tema_3']; ?></a>
                    <a href="#tema_3_1" class="nav-link-subtema"><?php echo $textos['tema_3.1']; ?></a>
                    <a href="#tema_3_2" class="nav-link-subtema"><?php echo $textos['tema_3.2']; ?></a>
                    <a href="#tema_3_3" class="nav-link-subtema"><?php echo $textos['tema_3.3']; ?></a>
                    <a href="#tema_3_4" class="nav-link-subtema"><?php echo $textos['tema_3.4']; ?></a>
                    <a href="#tema_3_5" class="nav-link-subtema"><?php echo $textos['tema_3.5']; ?></a>
                    <a href="#tema_3_6" class="nav-link-subtema"><?php echo $textos['tema_3.6']; ?></a>
                    <a href="#tema_3_7" class="nav-link-subtema"><?php echo $textos['tema_3.7']; ?></a>
                    
                    <a href="#tema_4" class="nav-link-tema">4. <?php echo $textos['tema_4']; ?></a>
                    <a href="#tema_4_1" class="nav-link-subtema"><?php echo $textos['tema_4.1']; ?></a>
                    <a href="#tema_4_2" class="nav-link-subtema"><?php echo $textos['tema_4.2']; ?></a>
                    <a href="#tema_4_2_2" class="nav-link-subtema"><?php echo $textos['tema_4.2.2']; ?></a>
                    <a href="#tema_4_2_3" class="nav-link-subtema"><?php echo $textos['tema_4.2.3']; ?></a>
                    <a href="#tema_4_2_4" class="nav-link-subtema"><?php echo $textos['tema_4.2.4']; ?></a>
                    <a href="#tema_4_3" class="nav-link-subtema"><?php echo $textos['tema_4.3']; ?></a>
                    <a href="#tema_4_4" class="nav-link-subtema"><?php echo $textos['tema_4.4']; ?></a>
                    <a href="#tema_4_5" class="nav-link-subtema"><?php echo $textos['tema_4.5']; ?></a>
                    <a href="#tema_4_5_1" class="nav-link-subtema"><?php echo $textos['tema_4.5.1']; ?></a>
                    <a href="#tema_4_5_2" class="nav-link-subtema"><?php echo $textos['tema_4.5.2']; ?></a>

                    <a href="#tema_5" class="nav-link-tema">5. <?php echo $textos['tema_5']; ?></a>
                    <a href="#tema_5_1" class="nav-link-subtema"><?php echo $textos['tema_5.1']; ?></a>
                    <a href="#tema_5_2" class="nav-link-subtema"><?php echo $textos['tema_5.2']; ?></a>
                    <a href="#tema_5_3" class="nav-link-subtema"><?php echo $textos['tema_5.3']; ?></a>
                    <a href="#tema_5_3_1" class="nav-link-subtema"><?php echo $textos['tema_5.3.1']; ?></a>
                    <a href="#tema_5_3_2" class="nav-link-subtema"><?php echo $textos['tema_5.3.2']; ?></a>
                    <a href="#tema_5_4" class="nav-link-subtema"><?php echo $textos['tema_5.4']; ?></a>
                </nav>
                <div class="mt-4 pt-3 border-top text-center">
                    <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" download class="btn btn-verde w-100 btn-sm">
                        <i class="bi bi-file-earmark-pdf me-2"></i><?php echo $textos['descargar_pdf_temas']; ?>
                    </a>
                </div>
            </div>
        </aside>
        <div id="mainContent">
            <div id="tema_1" class="tema-seccion">
                <div class="titulo-tema">
                    <?php echo $textos['tema_1']; ?>
                    <span class="badge-horas">17 hrs</span>
                </div>
                <div class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_0']; ?> <span class="badge-horas">1 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0001']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0002']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0003']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0004']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0005']; ?></p>
                </div>
                <div id="tema_1_1" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_1.1']; ?> <span class="badge-horas">1 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0006']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0007']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0008']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="d-flex align-items-start"><i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i><?php echo $textos['parrafo_0009']; ?></li>
                        <li class="d-flex align-items-start"><i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i><?php echo $textos['parrafo_0010']; ?></li>
                        <li class="d-flex align-items-start"><i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i><?php echo $textos['parrafo_0011']; ?></li>
                        <li class="d-flex align-items-start"><i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i><?php echo $textos['parrafo_0012']; ?></li>
                        <li class="d-flex align-items-start"><i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i><?php echo $textos['parrafo_0013']; ?></li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0014']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0015']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0016']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0017']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0018']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0019']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0020']; ?></p>
                    <div class="text-center my-3"><h4><?php echo $textos['parrafo_0021']; ?></h4></div>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0022']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0023']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0024']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0025']; ?></p>
                </div>

                <div id="tema_1_2" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_1.2']; ?> <span class="badge-horas">1 hrs (8 hrs)</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0026']; ?></p>
                    
                    <h4 class="mt-3"><?php echo $textos['parrafo_0027']; ?></h4>
                    <ul class="list-unstyled texto-contenido">
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0028']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0029']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0030']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0031']; ?></li>
                    </ul>
                    <h4 class="mt-3"><?php echo $textos['parrafo_0032']; ?></h4>
                    <ul class="list-unstyled texto-contenido">
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0033']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0034']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0035']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0036']; ?></li>
                    </ul>
                    
                    <div id="tema_1_2_1" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_1.2.1']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0037']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0038']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0039']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0040']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0041']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0042']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0043']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0044']; ?></li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0046']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0047']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0048']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0049']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0050']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0051']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0052']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0053']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0054']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0055']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0056']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0057']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0058']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0059']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0060']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0061']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0062']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0063']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0064']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0065']; ?></li>
                        </ul>
                    </div>
                    <div id="tema_1_2_2" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_1.2.2']; ?> <span class="badge-horas">3 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0066']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0067']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0068']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0069']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0070']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0071']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0072']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0073']; ?></p></strong>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0074_1']; ?><?php echo $textos['parrafo_0074']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0075_1']; ?><?php echo $textos['parrafo_0075']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0076_1']; ?><?php echo $textos['parrafo_0076']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0077_1']; ?><?php echo $textos['parrafo_0077']; ?></li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0078']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0079_1']; ?><?php echo $textos['parrafo_0079']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0080_1']; ?><?php echo $textos['parrafo_0080']; ?></li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0081']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0082']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0083']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0084']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0085']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0085_1']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0085_2']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0085_3']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0085_4']; ?></li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0086']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0087']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0087_1']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0087_2']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0087_3']; ?></li>
                        </ul>
                    </div>
                    <div id="tema_1_2_3" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_1.2.3']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0088']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0089']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0090_1']; ?><?php echo $textos['parrafo_0090']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0091_1']; ?><?php echo $textos['parrafo_0091']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0092_1']; ?><?php echo $textos['parrafo_0092']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0093_1']; ?><?php echo $textos['parrafo_0093']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0094_1']; ?><?php echo $textos['parrafo_0094']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0095_1']; ?><?php echo $textos['parrafo_0095']; ?></li>
                            <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0096_1']; ?><?php echo $textos['parrafo_0096']; ?></li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0097']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0098']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0099']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0100']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0101']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0102']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0103']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0104']; ?></p>
                    </div>
                </div>

                <div id="tema_1_3" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_1.3']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0105']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0106']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0107']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0108']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0109']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0110']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0111']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0112']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0113']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0114']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0115']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0116']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0117']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0118']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0119']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0120']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0121']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0122']; ?></p>
                    <ul class="list-unstyled texto-contenido">
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_1']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_2']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_3']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_4']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_5']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_6']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_7']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_8']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_9']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_10']; ?></li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0123']; ?></p>
                    <ul class="list-unstyled texto-contenido">
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0123_1']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0123_2']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0123_3']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0123_4']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0123_5']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0123_6']; ?></li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0124']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0125']; ?></p>
                    <ul class="list-unstyled texto-contenido">
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0125_1']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0125_2']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0125_3']; ?></li>
                        <li><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0125_4']; ?></li>
                    </ul>
                </div>
                <div id="tema_1_4" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_1.4']; ?> <span class="badge-horas">1 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0126']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0127']; ?></p>
                    <p class="texto-contenido">
                        <?php echo $textos['parrafo_0128']; ?>
                        <a href="https://sell.amazon.com/es/programs/handmade" target="_blank" style="color: #007bff; text-decoration: underline;">
                            <?php echo $textos['parrafo_0128_hyp']; ?>
                        </a>
                        <?php echo $textos['parrafo_0128_1']; ?>
                    </p>
                    <p class="texto-contenido">
                        <?php echo $textos['parrafo_0129']; ?>
                        <a href="https://advertising.amazon.com/solutions/products/amazon-live?initialSessionID=140-2946941-0614067&ld=NSGoogle&ldStackingCodes=NSGoogle" target="_blank" style="color: #007bff; text-decoration: underline;">
                            <?php echo $textos['parrafo_0129_hyp']; ?>
                        </a>
                    </p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0130']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_2']; ?>
                            <a href="https://sell.amazon.com/es/programs/amazon-business" target="_blank" style="color: #007bff; text-decoration: underline;">
                                <?php echo $textos['parrafo_0130_2_hyp']; ?>
                            </a>
                            <?php echo $textos['parrafo_0130_2_2']; ?>
                            <a href="https://sell.amazon.com/es/blog/reselling" target="_blank" style="color: #007bff; text-decoration: underline;">
                                <?php echo $textos['parrafo_0130_2_hyp_2']; ?>
                            </a>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_7']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0130_8']; ?>
                        </li>        
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0131']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0132']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0133']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0134']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0135']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0136']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0137']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0137_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0137_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0137_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0137_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0137_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0137_6']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0138']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0139']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0139_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0139_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0139_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0139_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="me-2"></i><?php echo $textos['parrafo_0139_5']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0140']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0141']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0142']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0143']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0144']; ?></p></strong>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0145']; ?></strong><?php echo $textos['parrafo_0145_1']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0146']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0147']; ?></strong><?php echo $textos['parrafo_0147_1']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0148']; ?></strong><?php echo $textos['parrafo_0148_1']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0149']; ?></strong><?php echo $textos['parrafo_0149_1']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0149_2']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0150']; ?></strong><?php echo $textos['parrafo_0150_1']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0151']; ?></strong><?php echo $textos['parrafo_0151_1']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0152']; ?></strong><?php echo $textos['parrafo_0152_1']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0152_2']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0153']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0154']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0155']; ?></p>
                </div>
                <div id="tema_1_5" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_1.5']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0156']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0157']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0158']; ?></p></strong>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0158_6']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0159']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0160']; ?></p>
                    <p class="texto-contenido"><strong><?php echo $textos['parrafo_0161']; ?></strong><?php echo $textos['parrafo_0161_1']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0162']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0163']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0163_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0163_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0163_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0164']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0165']; ?></p>
                </div>
                <div id="tema_1_6" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_1.6']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0166']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0167']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0167_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0167_2']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0168']; ?></p></strong>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0168_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0168_2']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0169']; ?></p></strong>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0169_1']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0170']; ?></p></strong>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0170_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0170_2']; ?>
                        </li>          
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0171']; ?></p></strong>
                    <ul class="list-unstyled texto-contenido mt-3">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_2']; ?>
                        </li>          
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_3']; ?>
                        </li>                    
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_4']; ?>
                        </li>                    
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_5']; ?>
                        </li>                    
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_6']; ?>
                        </li>                    
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0171_7']; ?>
                        </li>          
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0172']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0173']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0174']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0175']; ?></p>
                </div>
            </div>

            <div id="tema_2" class="tema-seccion">
                <div class="titulo-tema">
                    <?php echo $textos['tema_2']; ?>
                    <span class="badge-horas">14 hrs</span>
                </div>

                <div id="tema_2_1" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_2.1']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0181']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0182']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0183']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0184']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0185']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0186']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0187']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0188']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0189']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0190']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0191']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0192']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0193']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0194']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0195']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0196']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0197']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0198']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0199']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0200']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0201']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0202']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0203']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0204']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0205']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0206']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0207']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0208']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0209']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0210']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0211']; ?></p>
                    <ul class="list-unstyled texto-contenido">
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0211_1']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0211_2']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0211_3']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0211_4']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0211_5']; ?></span>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0212']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0213']; ?></p>
                    <ul class="list-unstyled texto-contenido">
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0213_1']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0213_2']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0213_3']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0213_4']; ?></span>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                            <span><?php echo $textos['parrafo_0213_5']; ?></span>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0214']; ?></p>
                </div>

                <div id="tema_2_2" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_2.2']; ?> <span class="badge-horas">2 hrs (12 hrs)</span></h3>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0215']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0216']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0217']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0218']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0219']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0220']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0221']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0222']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0226']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0223']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0224']; ?></strong><?php echo $textos['parrafo_0224_1']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0225']; ?></strong><?php echo $textos['parrafo_0225_1']; ?></p>

                    <div id="tema_2_2_1" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_2.2.1']; ?> <span class="badge-horas">3 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0227']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0228']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0229']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0230']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0231']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0232']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0233']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0234']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0235']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0236']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0237']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0238']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0239']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0240']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0241']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0242']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0243']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0244']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0245']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0246']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0247']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0248']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0249']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li class="mb-1 d-flex align-items-start">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0249_1']; ?></span>
                            </li>
                            <li class="mb-1 d-flex align-items-start mt-4">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0249_2']; ?></span>
                            </li>
                            <li class="mb-1 d-flex align-items-start mt-4">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0249_3']; ?></span>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0250']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0251']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li class="mb-1 d-flex align-items-start">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0251_1']; ?></span>
                            </li>
                            <li class="mb-1 d-flex align-items-start mt-4">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0251_2']; ?></span>
                            </li>
                            <li class="mb-1 d-flex align-items-start mt-4">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0251_3']; ?></span>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0252']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0253']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0254']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0255']; ?></p>
                        <ul class="list-unstyled texto-contenido">
                            <li class="mb-1 d-flex align-items-start">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0255_1']; ?></span>
                            </li>
                            <li class="mb-1 d-flex align-items-start mt-4">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0255_2']; ?></span>
                            </li>
                            <li class="mb-1 d-flex align-items-start mt-4">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2 mt-1"></i>
                                <span><?php echo $textos['parrafo_0255_3']; ?></span>
                            </li>
                        </ul>
                    </div>
                    <div id="tema_2_2_2" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_2.2.2']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0256']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0257']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0258']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0259']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0260']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0260_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0260_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0260_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0260_4']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0261']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0262']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0263']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0264']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0265']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0266']; ?></p></strong>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0266_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0266_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0266_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0266_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0266_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0266_6']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0267']; ?></p></strong>
                        <ul class="list-unstyled texto-contenido mt-4">
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
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0268']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0269']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0270']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0271']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0272']; ?></p>
                    </div>
                    <div id="tema_2_2_3" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_2.2.3']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0273']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0274']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0275']; ?></p></strong>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0275_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0275_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0275_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0275_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0275_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0275_6']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0276']; ?></p></strong>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0276_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0276_2']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0277']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0278']; ?></p></strong>
                        <ul class="list-unstyled texto-contenido mt-4">
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
                    <div id="tema_2_2_4" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_2.2.4']; ?> <span class="badge-horas">3 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0279']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0280']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_01']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_02']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_03']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_04']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_05']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_06']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_07']; ?>
                            </li>                    
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_08']; ?>
                            </li>                    
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_09']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0280_10']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0281']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0282']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0283']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0283_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0283_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0283_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0283_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0284']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0285']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0285_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0285_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0285_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0285_4']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0286']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0287']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0288']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0288_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0288_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0288_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0288_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0288_5']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0289']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0289_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0289_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0289_3']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0290']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0290_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0290_2']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0291']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0292']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0293']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0294']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0295']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0296']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0297']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0298']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0299']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0300']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0301']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0302']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0303']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0304']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0305']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0306']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0307']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0308']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_01']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_02']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_03']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_04']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_05']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_06']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_07']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_08']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_09']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_10']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0308_11']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0309']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0310']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0311']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0311_1']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0311_2']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0311_3']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0312']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0312_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0312_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0312_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0312_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0313']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0314']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0315']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0316']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0317']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0317_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0317_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0317_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0317_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0317_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0317_6']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0318']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0319']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0320']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0321']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0322']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0323']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0324']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0325']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_01']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_02']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_03']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_04']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_05']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_06']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_07']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_08']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_09']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_10']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_11']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_12']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_13']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_14']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_15']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_16']; ?>
                            </li>
                        </ul>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0326']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0327']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0328']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0328_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0328_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0328_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0328_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0329']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_6']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_7']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0329_8']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0330']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0330_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0330_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0330_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0330_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0331']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0331_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0331_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0331_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0331_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0331_5']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0332']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0333']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0334']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0335']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0336']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0337']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0338']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0339']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0340']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0341']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0342']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0343']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0344']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0344_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0344_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0344_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0344_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0345']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0346']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0347']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0348']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0348_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0348_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0348_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0348_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0348_5']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0348_6']; ?></p>
                    </div>
                </div>
            </div>

            <div id="tema_3" class="tema-seccion">
                <div class="titulo-tema">
                    <?php echo $textos['tema_3']; ?>
                    <span class="badge-horas">16 hrs</span>
                </div>

                <div id="tema_3_1" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_3.1']; ?> <span class="badge-horas">3 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0349']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0350']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0351']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0352']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0353']; ?></p>
                    <div class="d-flex align-items-start justify-content-between flex-wrap">
                        <div style="flex: 1; min-width: 250px;">
                            <p class="texto-contenido"><?php echo $textos['parrafo_0354']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0355']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0356']; ?></p>
                        </div>
                    </div>
                </div>
                <div id="tema_3_2" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_3.2']; ?> <span class="badge-horas">3 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0357']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0358']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0359']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0360']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0361']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0362']; ?></p>
                    <p class="texto-contenido text-center"><?php echo $textos['parrafo_0363']; ?></p>
                    <p class="texto-contenido text-center"><?php echo $textos['parrafo_0364']; ?></p>
                </div>
                <div id="tema_3_3" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_3.3']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0365']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0366']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0367']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0368']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0369']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0370']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0371']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0372']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0373']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0374']; ?></p>
                </div>
                <div id="tema_3_4" class="subtema-bloque"><h3 class="titulo-subtema">
                    <?php echo $textos['tema_3.4']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0375']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0376']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0376_5']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0377']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0378']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0379']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0380']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0380_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0380_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0380_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0381']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0382']; ?></p>
                </div>
                <div id="tema_3_5" class="subtema-bloque"><h3 class="titulo-subtema">
                    <?php echo $textos['tema_3.5']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0383']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0384']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0385']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0386']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0387']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0388']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0389']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0390']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0391']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0392']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0393']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0394']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0395']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0396']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0397']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0398']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0399']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0400']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0401']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0402']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_7']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_8']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0402_9']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0403']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0403_4']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0404']; ?></p>
                </div>
                <div id="tema_3_6" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_3.6']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0405']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0406']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0407']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0408']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0409']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0409_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0409_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0409_3']; ?>
                        </li>
                    </ul>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0410']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0411']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0412']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0413']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0414']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0415']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0416']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0417']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0418']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0418_5']; ?>
                        </li>
                    </ul>
                    <div style="flex: 1; min-width: 250px;">
                        <p class="texto-contenido"><?php echo $textos['parrafo_0419']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0419_1']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0420']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0421']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0421_1']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0422']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0422_4']; ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="tema_3_7" class="subtema-bloque"><h3 class="titulo-subtema">
                    <?php echo $textos['tema_3.7']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0423']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0424']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0425']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0426']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0427']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0428']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0429']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0430']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0431']; ?></p>
                    <strong><p class="texto-contenido"><?php echo $textos['parrafo_0432']; ?></p></strong>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0433']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0433_4']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0434']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0435']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_7']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0435_8']; ?>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="tema_4" class="tema-seccion">
                <div class="titulo-tema">
                    <?php echo $textos['tema_4']; ?>
                    <span class="badge-horas">19 hrs</span>
                </div>

                <div id="tema_4_1" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_4.1']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0453']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0454']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0455']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0456']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0457']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0458']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0459']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0460']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0461']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0462']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0463']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0464']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0465']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0466']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0467']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0468']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0469']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0470']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0471']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0472']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0473']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0474']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0475']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0476']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0477']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0478']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0479']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0480']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0481']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0482']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0483']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0484']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0485']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0486']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0486_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0486_2']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0487']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0488']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0489']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0490']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0491']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0492']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0493']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0494']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0495']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0495_7']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0496']; ?></p>
                </div>

                <div id="tema_4_2" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_4.2']; ?> <span class="badge-horas">2 hrs (8 hrs)</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0497']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0498']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0498_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0498_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0498_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0498_4']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0499']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0500']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0501']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0502']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0502_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0502_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0502_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0503']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0504']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0505']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0506']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0507']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0508']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0509']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0510']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0511']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0512']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0513']; ?></p>
                    <div class="d-flex align-items-start justify-content-between flex-wrap">
                        <div style="flex: 1; min-width: 250px;">
                            <ul class="list-unstyled texto-contenido mt-4">
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_01']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_02']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_03']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_04']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_05']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_06']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_07']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_08']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_09']; ?>
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0513_10']; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="tema_4_2_2" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_4.2.2']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0514']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0515']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0516']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0517']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0518']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0519']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0520']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0521']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0522']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0523']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0524']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0525']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0526']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0527']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0528']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0529']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0530']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0531']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0532']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0533']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0534']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0535']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0536']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0537']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0538']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0539']; ?></p>
                    </div>
                    <div id="tema_4_2_3" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_4.2.3']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0540']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0541']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0542']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0543']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0544']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0545']; ?></p>
                        <strong><p class="texto-contenido"><?php echo $textos['parrafo_0546']; ?></p></strong>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0547']; ?></p>
                    </div>
                    <div id="tema_4_2_4" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_4.2.4']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0548']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0549']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0550']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0551']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0552']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0553']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0554']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0554_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0554_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0554_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0554_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0554_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0554_6']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0555']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0556']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0557']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0558']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0559']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0560']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0561']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0562']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0563']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0564']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0565']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0566']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0567']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0568']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0569']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0570']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0571']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0572']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0573']; ?></p>
                    </div>
                </div>
                <div id="tema_4_3" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_4.3']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0574']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0575']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0576']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0577']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0578']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0579']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0579_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0579_2']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0580']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0581']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0582']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0582_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0582_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0582_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0582_4']; ?>
                        </li>
                    </ul>
                </div>
                <div id="tema_4_4" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_4.4']; ?> <span class="badge-horas">2 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0583']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0584']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0584_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0584_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0584_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0585']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0586']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0587']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0588']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0589']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0590']; ?></p>
                </div>
                <div id="tema_4_5" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_4.5']; ?> <span class="badge-horas">1 hrs (5 hrs)</span></h3>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0591']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0592']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0593']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0594']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0595']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0596']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0597']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0598']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0599']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0600']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0601']; ?></p>
                            <p class="texto-contenido"><?php echo $textos['parrafo_0602']; ?></p>

                    <div id="tema_4_5_1" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_4.5.1']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0603']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0604']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0605']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0606']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0607']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0608']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0608_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0608_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0608_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0608_4']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0609']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0610']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0610_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0610_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0610_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0610_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0610_5']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0611']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0611_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0611_2']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0612']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0612_1']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0613']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0614']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0615']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0616']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0617']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0618']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0619']; ?></p>
                    </div>
                    <div id="tema_4_5_2" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_4.5.2']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0620']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0621']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_6']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0621_7']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0622']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0623']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0623_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0623_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0623_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0623_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0623_4_1']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0624']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0625']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0625_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0625_2']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0626']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0626_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0626_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0626_3']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0627']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0628']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_5']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_6']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_7']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_8']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_9']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0628_10']; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="tema_5" class="tema-seccion">
                <div class="titulo-tema">
                    <?php echo $textos['tema_5']; ?>
                    <span class="badge-horas">14 hrs</span>
                </div>

                <div id="tema_5_1" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_5.1']; ?> <span class="badge-horas">3 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0669']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0670']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0671']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_7']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_8']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0671_9']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0672']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0673']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_7']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0673_8']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0674']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0675']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0676']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0677']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0678']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0679']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0680']; ?></p>
                </div>
                <div id="tema_5_2" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_5.2']; ?> <span class="badge-horas">3 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0681']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0681_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0681_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0681_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0681_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0681_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0681_6']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0682']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0683']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0684']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0685']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0686']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0687']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0688']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0689']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0690']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0691']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0692']; ?></p>
                </div>
                
                <div id="tema_5_3" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_5.3']; ?> <span class="badge-horas">1 hrs (5 hrs)</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0693']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0694']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0695']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0695_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0695_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0695_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0695_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0695_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0695_6']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0696']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0697']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0698']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0699']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0700']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0700_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0700_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0700_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0700_4']; ?>
                        </li>
                    </ul>

                    <div id="tema_5_3_1" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_5.3.1']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0701']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0702']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0703']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0704']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0705']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0706']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0707']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0708']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0709']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0710']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0710_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0710_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0710_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0710_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0710_5']; ?>
                            </li>
                        </ul>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0711']; ?></p>
                        <ul class="list-unstyled texto-contenido mt-4">
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0711_1']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0711_2']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0711_3']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0711_4']; ?>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0711_5']; ?>
                            </li>
                        </ul>
                    </div>
                    <div id="tema_5_3_2" class="subtema-bloque">
                        <h4 class="titulo-apartado"><?php echo $textos['tema_5.3.2']; ?> <span class="badge-horas">2 hrs</span></h4>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0712']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0713']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0714']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0715']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0716']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0717']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0718']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0719']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0720']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0721']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0722']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0723']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0724']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0725']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0726']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0727']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0728']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0729']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0730']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0731']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0732']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0733']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0734']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0735']; ?></p>
                        <p class="texto-contenido"><?php echo $textos['parrafo_0736']; ?></p>
                    </div>
                </div>
                <div id="tema_5_4" class="subtema-bloque">
                    <h3 class="titulo-subtema"><?php echo $textos['tema_5.4']; ?> <span class="badge-horas">3 hrs</span></h3>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0737']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0738']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0739']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0740']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0740_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0740_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0740_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0740_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0740_5']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0741']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0742']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0743']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0744']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0745']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0746']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0747']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0748']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0749']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0750']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0751']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0752']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0753']; ?></p>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0754']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0754_7']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0755']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_6']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_7']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0755_8']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0756']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0756_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0756_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0756_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0757']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0757_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0757_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0757_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0758']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0758_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0758_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0758_3']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0759']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0759_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0759_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0759_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0759_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0759_5']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0759_6']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0760']; ?></p>
                    <ul class="list-unstyled texto-contenido mt-4">
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0760_1']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0760_2']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0760_3']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0760_4']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0760_5']; ?>
                        </li>
                    </ul>
                    <p class="texto-contenido"><?php echo $textos['parrafo_0761']; ?></p>
                </div>
            </div>
        </div> 
    </div> <div class="d-block d-lg-none text-center mt-4 mb-4">
    <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" download class="btn btn-verde px-4 py-2">
        <?php echo $textos['descargar_pdf_temas']; ?>
    </a>
</div>

</main>
<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
<script src="/assets/scripts/temas_curso.js"></script>
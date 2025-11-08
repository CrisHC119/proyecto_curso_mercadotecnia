<?php
    // temas_curso.php
    ob_start();
    // Selecciona la pestaña que se encuentra
    $page_2 = 'active';
    include_once __DIR__ . '/assets/code_index/navbar.php';
    include_once __DIR__ . '/assets/code_index/info_icon.php';
    include_once __DIR__ . '/assets/styles/style_transicion.php';
    include_once __DIR__ . '/assets/styles/style_botones.php';
    include_once __DIR__ . '/assets/styles/style_temas_curso.php';

    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<main class="flex-fill">
    <div class="contenedor-temas">
        <div id="mainContent">
            <h1 class="text-center mb-4"><?php echo $textos['temario']; ?></h1>
            <div class="accordion">
            <button class="accordion-button"><?php echo $textos['tema_1']; ?>
                <span class="badge-horas">17 hrs</span>
            </button>
            <div class="accordion-content">
            <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100"><?php echo $textos['tema_0']; ?>
                <span class="badge-horas">1 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="justificado"><?php echo $textos['parrafo_0001']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0002']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0003']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0004']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0005']; ?></p>
            </div>
            <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100" style="text-align: left;">
                <span><?php echo $textos['tema_1.1']; ?></span>
                <span class="badge-horas">1 hrs</span>
            </button>
            <div class="accordion-content">
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
            <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100">
                <span><?php echo $textos['tema_1.2']; ?></span>
                <span class="badge-horas">1 hrs (8 hrs)</span>
            </button>    
            <div class="accordion-content">
                <p class="justificado"><?php echo $textos['parrafo_0026']; ?></p>
                <h4><?php echo $textos['parrafo_0027']; ?></h4>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0028']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0029']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0030']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0031']; ?>
                    </li>
                </ul>
                <h4><?php echo $textos['parrafo_0032']; ?></h4>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0033']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0034']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0035']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0036']; ?>
                    </li>
                </ul>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_1.2.1']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_1.2.1']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_1.2.2']; ?>
                    <span class="badge-horas">3 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_1.2.2']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_1.2.3']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_1.2.3']; ?></p>
                </div>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_1.3']; ?>
                <span class="badge-horas">2 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_1.3']; ?></p>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_1.4']; ?>
                <span class="badge-horas">1 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_1.4']; ?></p>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_1.5']; ?>
                <span class="badge-horas">2 hrs</span>
              </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_1.5']; ?></p>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_1.6']; ?>
                <span class="badge-horas">2 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_1.6']; ?></p>
            </div>
        </div>
        <button class="accordion-button"><?php echo $textos['tema_2']; ?>
            <span class="badge-horas">14 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_2']; ?></p>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_2.1']; ?>
                <span class="badge-horas">2 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_2.1']; ?></p>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_2.2']; ?>
                <span class="badge-horas">2 hrs (12 hrs)</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_2.2']; ?></p>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.1']; ?>
                    <span class="badge-horas">3 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_2.2.1']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.2']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_2.2.2']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.3']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_2.2.3']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.4']; ?>
                    <span class="badge-horas">3 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_2.2.4']; ?></p>
                </div>
            </div>
        </div>
        <button class="accordion-button"><?php echo $textos['tema_3']; ?>
            <span class="badge-horas">16 hrs</span>
        </button>
            <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3']; ?></p>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.1']; ?>
            <span class="badge-horas">3 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.1']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.2']; ?>
            <span class="badge-horas">3 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.2']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.3']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.3']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.4']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.4']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.5']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.5']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.6']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.6']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_3.7']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_3.7']; ?></p>
        </div>
    </div>
    <button class="accordion-button"><?php echo $textos['tema_4']; ?>
        <span class="badge-horas">19 hrs</span>
    </button>
    <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_4']; ?></p>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_4.1']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_4.1']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_4.2']; ?>
            <span class="badge-horas">2 hrs (8 hrs)</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_4.2']; ?></p>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_4.2.2']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_4.2.2']; ?></p>
            </div>
            <button class="accordion-button nivel-3"><?php echo $textos['tema_4.2.3']; ?>
                <span class="badge-horas">2 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_4.2.3']; ?></p>
            </div>
            <button class="accordion-button nivel-3"><?php echo $textos['tema_4.2.4']; ?>
                <span class="badge-horas">2 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_4.2.4']; ?></p>
            </div>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_4.3']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_4.3']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_4.4']; ?>
            <span class="badge-horas">2 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_4.4']; ?></p>
        </div>
        <button class="accordion-button nivel-2"><?php echo $textos['tema_4.5']; ?>
            <span class="badge-horas">1 hrs (5 hrs)</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_4.5']; ?></p>
            <button class="accordion-button nivel-3"><?php echo $textos['tema_4.5.1']; ?>
                <span class="badge-horas">2 hrs</span>
            </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_4.5.1']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_4.5.2']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_4.5.2']; ?></p>
                </div>
            </div>
        </div>
        <button class="accordion-button"><?php echo $textos['tema_5']; ?>
            <span class="badge-horas">14 hrs</span>
        </button>
        <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_5']; ?></p>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_5.1']; ?>
                <span class="badge-horas">3 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_5.1']; ?></p>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_5.2']; ?>
                <span class="badge-horas">3 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_5.2']; ?></p>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_5.3']; ?>
                <span class="badge-horas">1 hrs (5 hrs)</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_5.3']; ?></p>
                    <button class="accordion-button nivel-3"><?php echo $textos['tema_5.3.1']; ?>
                        <span class="badge-horas">2 hrs</span>
                    </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_5.3.1']; ?></p>
                </div>
                <button class="accordion-button nivel-3"><?php echo $textos['tema_5.3.2']; ?>
                    <span class="badge-horas">2 hrs</span>
                </button>
                <div class="accordion-content">
                    <p class="subtema-text"><?php echo $textos['tema_5.3.2']; ?></p>
                </div>
            </div>
            <button class="accordion-button nivel-2"><?php echo $textos['tema_5.4']; ?>
                <span class="badge-horas">3 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_5.4']; ?></p>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" download class="btn btn-verde d-inline-block px-4 py-2 mt-3">
            <?php echo $textos['descargar_pdf_temas']; ?>
        </a>
    </div>
</main>
<?php
    include_once __DIR__ . '/assets/code_general/footer.php';
    include_once __DIR__ . '/assets/code_general/toast_message.php';
?>
<script src="/assets/scripts/temas_curso.js"></script>

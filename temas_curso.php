<?php
    ob_start();
    // Selecciona la pestaña que se encuentra
    $page_2 = 'active';
    include_once __DIR__ . '/assets/code_index/navbar.php';
    include_once __DIR__ . '/assets/code_index/info_icon.php';
    include_once __DIR__ . '/assets/styles/style_transicion.php';
    include_once __DIR__ . '/assets/styles/style_temas_curso.php';
    include_once __DIR__ . '/assets/styles/style_botones.php';

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
                <p class="subtema-text"><?php echo $textos['tema_0_description']; ?></p>
            </div>
            <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100" style="text-align: left;">
                <span><?php echo $textos['tema_1.1']; ?></span>
                <span class="badge-horas">1 hrs</span>
            </button>
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_1.1']; ?></p>
            </div>
            <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100">
                <span><?php echo $textos['tema_1.2']; ?></span>
                <span class="badge-horas">1 hrs (8 hrs)</span>
            </button>    
            <div class="accordion-content">
                <p class="subtema-text"><?php echo $textos['tema_1.2']; ?></p>
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
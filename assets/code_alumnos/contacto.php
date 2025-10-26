<?php
    $page_5 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../styles/style_contacto.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<body>
    <main class="flex-fill">
        <div class="contenedor-principal">
            <div id="mainContent">
                <h1 class="text-center mb-4 titulo"><?php echo $textos['tecnm']; ?></h1>
                <?php
                    $direccion = "Blvd. Emilio Portes Gil 1301, Sin Nombre de Col 7, 87010 Ciudad. Victoria, Tamps.";
                    $lat = 23.7535780056823;
                    $lng = -99.16672100652961;
                ?>
            <div class="mapa-info">
                <div id="map"></div>
                <div class="card info-card p-4">
                    <h4 class="text-center"><?php echo $textos['itcv_tec']; ?></h4>
                    <p class="m-2">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        <strong><?php echo $textos['direccion']; ?>:</strong>
                        <?php echo $direccion; ?>
                    </p>
                    <p class="m-2">
                        <i class="bi bi-telephone-fill me-1"></i>
                        <strong><?php echo $textos['telefono']; ?>:</strong>
                        <a class="link-theme" href="tel:8341532000" class="text-decoration-none text-light">(834) 153-2000</a>
                    </p>
                    <p class="m-2">
                        <i class="bi bi-envelope-fill me-1"></i>
                        <strong>Email:</strong>
                        <a class="link-theme" href="mailto:web_cdvictoria@tecnm.mx" class="text-decoration-none text-light">web_cdvictoria@tecnm.mx</a>
                    </p>
                    <p class="m-2">
                        <i class="bi bi-map-fill me-1"></i>
                        <strong>Google Maps:</strong>
                        <a class="link-theme" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($direccion); ?>"
                        target="_blank" class="text-decoration-none text-light">
                        <?php echo $textos['google_maps']; ?>
                        </a>
                    </p>
                    <p class="m-2">
                        <i class="bi bi-clock-fill me-1"></i>
                        <strong><?php echo $textos['horario']; ?>:</strong> <?php echo $textos['horario_tec']; ?>
                    </p>
                    <p class="m-2">
                        <i class="bi bi-facebook me-1"></i>
                        <strong>Facebook:</strong>
                        <a class="link-theme" href="https://www.facebook.com/TECNM.ITVICTORIA/?locale=es_LA" target="_blank" class="text-reset text-decoration-none">
                            <?php echo $textos['visita_web']; ?>
                        </a>
                    </p>
                    <p class="m-2">
                        <i class="bi bi-google me-1"></i>
                        <strong><?php echo $textos['web']; ?>:</strong>
                        <a class="link-theme" href="https://www.facebook.com/TECNM.ITVICTORIA/?locale=es_LA" target="_blank" class="text-reset text-decoration-none">
                            <?php echo $textos['visita_web']; ?>
                        </a>
                    </p>
                </div>
            </div>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <?php
                include_once __DIR__ . '/../scripts/mapa_contacto.php';
            ?>
        </div>
        <div class="card face-card p-4">
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v17.0"
                nonce="XYZ123">
            </script>
            <div class="fb-wrapper">
                <div class="fb-page"
                    data-href="https://www.facebook.com/TECNM.ITVICTORIA/?locale=es_LA"
                    data-tabs="timeline"
                    data-width="500"
                    data-height=""
                    data-small-header="false"
                    data-adapt-container-width="true"
                    data-hide-cover="false"
                    data-show-facepile="true">
                </div>
            </div>
        </div>
    </main>
<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
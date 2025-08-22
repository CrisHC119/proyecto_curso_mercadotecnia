<?php
    ob_start();
    // Selecciona la pestaña que se encuentra
    $page_1 = 'active';
    $page_2 = '';
    $page_3 = '';
    include_once __DIR__ . '/assets/code_general/verificar_session_apagado.php';
    include_once __DIR__ . '/assets/code_general/verificar_session_encendido.php';
    include_once __DIR__ . '/assets/code_general/horas_establecidas.php';
    include_once __DIR__ . '/assets/code_index/navbar.php';
    include_once __DIR__ . '/assets/code_index/info_icon.php';
    include_once __DIR__ . '/assets/styles/style_transicion.php'; 
    include_once __DIR__ . '/assets/styles/styles_responsivo_NL/style_responsivo_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
        //Redirecciona a la misma página con el idioma establecido (No se pudo guardar en otro archivo jaja)
    }
?>
</body>
    <main class="flex-fill">
        <div class="contenedor-cursos">
        <div id="mainContent">
            <h1 class="text-center mb-4 titulo"><?php echo $textos['titulo']; ?></h1>
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
        </div>
        <div class="contenedor-lateral">
            <?php
                include_once __DIR__ . '/assets/code_index/tarjeta_objetivos.php';
                include_once __DIR__ . '/assets/code_index/tarjeta_horas.php';
            ?>
        </div>
    </main>
<?php
    include_once __DIR__ . '/assets/code_general/footer.php';
?>
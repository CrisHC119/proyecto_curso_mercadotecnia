<?php
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/code_general/verificar_archivo_log.php';
    include_once __DIR__ . '/styles/style_index.php';
    include_once __DIR__ . '/styles/style_registros.php';
    include_once __DIR__ . '/../styles/style_botones.php';
    include_once __DIR__ . '/code_general/modal_verificar_password.php';
//    include $_SERVER['DOCUMENT_ROOT'] . '/assets/scripts/script_registrar_log.php';
//    escribirLog("El usuario: " . $_SESSION['nombre'] . " " . $_SESSION['apellido_p'] . " " . $_SESSION['apellido_m'] . " (" . $_SESSION['matricula'] . "), descargo el log de registros.");

    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<?php
    // Verificar inactividad
    //include_once '../modelo/login_profesor/logout_inactividad.php';
?>
<!--<script src="/assets/scripts/logout_inactividad_profesor.js"></script>-->

<body class="bg-light">
    <div class="container py-4">
        <h2 class="text-center mb-4"><?php echo $textos['registros_g']; ?></h2>
        <div class="d-flex justify-content-center">
            <textarea readonly class="cmd-box mx-auto"><?php echo htmlspecialchars($contenido); ?></textarea>
        </div>
    </div>
    <div class="text-center">
        <a href="#" id="btnDescargar" class="btn btn-azul">
            <?php echo $textos['descargar']; ?>
        </a>
        <a href="javascript:history.back()" class="btn btn-gris">
            <?php echo $textos['regresar']; ?>
        </a>
    </div>
</body>

<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
<script src="/assets/code_profesor/scripts/script_verificar_password.js"></script>
<script src="/assets/code_profesor/scripts/script_descargar_log.js"></script>

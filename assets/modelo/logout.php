<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . '/assets/scripts/script_registrar_log.php';
    escribirLog("Cierre de sesión (". $_SESSION['nocontrol'] . ")");
    session_unset();
    session_destroy();
    header("Location: /../../index.php");
    exit;
?>
<?php
    // logout.php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php'; 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/scripts/script_registrar_log.php';

    if (isset($_SESSION['nocontrol'])) {
        escribirLog("Cierre de sesión (". $_SESSION['nocontrol'] . ")");
    }
    session_unset();
    session_destroy();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'logged_out_success']);
    } else {
        header("Location: /../../index.php");
    }
    exit;
?>
<?php
    include_once __DIR__ . '/../../code_general/verificar_session_apagado.php';

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: /index.php");
        exit;
    }

    if (!isset($_SESSION['id_tipo_usuario'])) {
        header("Location: /index.php");
        exit;
    }

    $tipo = intval($_SESSION['id_tipo_usuario']);

    if ($tipo === 3) {
    } elseif ($tipo === 1 || $tipo === 2) {
        header("Location: /assets/code_profesor/index_profesor.php");
        exit;
    } else {
        header("Location: /index.php");
        exit;
    }
?>

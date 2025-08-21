<?php
    include_once __DIR__ . '/verificar_session_apagado.php';

    if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['id_tipo_usuario'])) {
        return;
    }

    $tipo = (int) $_SESSION['id_tipo_usuario'];

    if ($tipo === 3) {
        header("Location: /assets/code_alumnos/index_alumnos.php");
        exit;
    } elseif ($tipo === 1 || $tipo === 2) {
        header("Location: /assets/code_profesor/index_profesor.php");
        exit;
    } else {
        header("Location: /index.php");
        exit;
    }
?>

<?php
    $rutaSolicitada = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $rutaSolicitada = rtrim(strtolower($rutaSolicitada), '/');

    $rutaError = '/assets/code_404/lost_page_nl.php';

    if ($rutaSolicitada !== $rutaError) {
        $rutaReal = $_SERVER['DOCUMENT_ROOT'] . $rutaSolicitada;

        if (!file_exists($rutaReal) && !is_dir($rutaReal)) {
            header("Location: /assets/code_404/lost_page_NL.php");
            exit;
        }
    }
?>
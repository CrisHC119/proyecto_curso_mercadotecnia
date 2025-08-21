<?php
    session_start();

    if(!isset($_SESSION['id_usuario'])){
        exit('Acceso denegado');
    }
    $file = $_SERVER['DOCUMENT_ROOT'] . '/assets/logs/log_server.txt';

    if(file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        exit('Archivo no encontrado.');
    }
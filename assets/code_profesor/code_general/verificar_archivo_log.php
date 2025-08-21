<?php
    $archivo = __DIR__ . "/../../logs/log_server.txt";  

    $contenido = "El archivo no existe.";
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
    }
?>
<?php
function escribirLog($mensaje) {
    $archivo = __DIR__ . "/../logs/log_server.txt";

    $fecha = date("Y-m-d H:i:s", strtotime("-6 hours"));

    $texto = "[$fecha] $mensaje" . PHP_EOL;

    file_put_contents($archivo, $texto, FILE_APPEND | LOCK_EX);
}
//  escribirLog("Error al conectar con el servidor remoto.");
?>
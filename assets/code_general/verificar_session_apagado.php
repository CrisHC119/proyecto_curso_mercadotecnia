<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Verifica que la sesion este apagada, y la enciende, para no sobrecargar sesiones
?>
<?php
    $idioma = $_GET['lang'] ?? 'es';

    $_SESSION['lang'] = $idioma;

    $idiomas = [
        'es' => 'Español',
        'en' => 'English'
    ];

    $rutaArchivo = __DIR__ . "/../lang/lang_{$idioma}.json";
    include_once __DIR__ . '/verificar_invitado.php';

    if (file_exists($rutaArchivo)) {
        $json = file_get_contents($rutaArchivo);
        $textos = json_decode($json, true);
    } else {
        $json = file_get_contents(__DIR__ . "/../lang/lang_es.json");
        $textos = json_decode($json, true);
    }
    // Verifica el idioma de el link, si no tiene establecido, se coloca en ES
?>
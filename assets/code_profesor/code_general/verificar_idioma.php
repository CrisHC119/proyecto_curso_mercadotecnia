<?php
    $idiomas = ['es' => 'Español', 'en' => 'English'];

    $idioma = $_SESSION['idioma'] ?? 'es';

    if (isset($_GET['lang']) && in_array($_GET['lang'], array_keys($idiomas))) {
        $nuevoIdioma = $_GET['lang'];

        if ($nuevoIdioma !== ($_SESSION['idioma'] ?? 'es')) {
            $_SESSION['idioma'] = $nuevoIdioma;
            $idioma = $nuevoIdioma;

            if (isset($_SESSION['id_usuario'])) {
                include_once __DIR__ . '/../../modelo/conexion.php'; 
                $stmt = $conn->prepare("UPDATE usuarios SET idioma = ? WHERE id_usuario = ?");
                $stmt->bind_param("si", $idioma, $_SESSION['id_usuario']);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            $idioma = $nuevoIdioma;
        }
    }
    include_once __DIR__ . '/verificar_profesor.php';

    $rutaArchivo = $_SERVER['DOCUMENT_ROOT'] . "/assets/lang/lang_{$idioma}.json";
    if (file_exists($rutaArchivo)) {
        $json = file_get_contents($rutaArchivo);
        $textos = json_decode($json, true);
    } else {
        $rutaArchivo = $_SERVER['DOCUMENT_ROOT'] . "/assets/lang/lang_es.json";
        $textos = json_decode($json, true);
    }
?>
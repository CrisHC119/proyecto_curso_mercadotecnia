<?php
    session_start(); 

    $pagina_anterior = $_SERVER['HTTP_REFERER'] ?? '/index.php';

    $file_key = $_GET['file'] ?? null;

    if (empty($file_key)) {
        $_SESSION['descarga_error'] = "Solicitud de descarga no válida.";
        header('Location: ' . $pagina_anterior);
        exit;
    }

    $nombre_archivo = '';
    $ruta_base = '';
    $requiere_permiso = false;

    switch ($file_key) {
        case 'tema0':
            $nombre_archivo = 'AE045 Mercadotecnia Electronica.pdf';
            $ruta_base = '/assets/pdf/';
            $requiere_permiso = false; 
            break;
            
        case 'tema1':
            $nombre_archivo = 'UNIDAD 1.pdf';
            $ruta_base = '/assets/pdf/Contenido_Unidades/';
            $requiere_permiso = true; 
            break;

        case 'tema2':
            $nombre_archivo = 'UNIDAD 2.pdf';
            $ruta_base = '/assets/pdf/Contenido_Unidades/';
            $requiere_permiso = false; 
            break;

        case 'tema3':
            $nombre_archivo = 'UNIDAD 3.pdf';
            $ruta_base = '/assets/pdf/Contenido_Unidades/';
            $requiere_permiso = false;
            break;

        case 'tema4':
            $nombre_archivo = 'UNIDAD 4.pdf';
            $ruta_base = '/assets/pdf/Contenido_Unidades/';
            $requiere_permiso = false;
            break;

        case 'tema5':
            $nombre_archivo = 'UNIDAD 5.pdf';
            $ruta_base = '/assets/pdf/Contenido_Unidades/';
            $requiere_permiso = false;
            break;

        default:
            $_SESSION['descarga_error'] = "El archivo solicitado no existe.";
            header('Location: ' . $pagina_anterior);
            exit;
    }

    if ($requiere_permiso) {
        $es_autorizado = false;
        if (isset($_SESSION['id_tipo_usuario'])) {
            $tipo_usuario = $_SESSION['id_tipo_usuario'];
            if ($tipo_usuario == 3) {
                $es_autorizado = true;
            }
        }

        if (!$es_autorizado) {
            $_SESSION['descarga_error'] = "Acceso denegado. No tiene permisos para descargar este archivo.";
            header('Location: ' . $pagina_anterior);
            exit; 
        }
    }

    $ruta_completa_archivo = $_SERVER['DOCUMENT_ROOT'] . $ruta_base . $nombre_archivo;

    if (file_exists($ruta_completa_archivo)) {
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $nombre_archivo . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta_completa_archivo));
        
        ob_clean();
        flush();
        readfile($ruta_completa_archivo);
        exit;

    } else {
        $_SESSION['descarga_error'] = "Error: El archivo solicitado ('" . htmlspecialchars($nombre_archivo) . "') no se ha encontrado.";
        header('Location: ' . $pagina_anterior);
        exit;
    }
?>
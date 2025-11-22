<?php
// scripts/descargar_archivo.php (MODO DEBUG)

// 1. FORZAMOS QUE SE MUESTREN TODOS LOS ERRORES
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 

// 2. Comentamos la redirección para poder ver los errores
// $pagina_anterior = $_SERVER['HTTP_REFERER'] ?? '/index.php';

$file_key = $_GET['file'] ?? null;

if (empty($file_key)) {
    // 3. En lugar de redirigir, usamos 'die()' para parar y mostrar el error
    die("ERROR DEBUG: No se proporcionó 'file_key'.");
}

$nombre_archivo = '';
$ruta_base = '';
$requiere_permiso = false;

// Tu switch es idéntico
switch ($file_key) {
    case 'tema0':
        $nombre_archivo = 'AE045 Mercadotecnia Electronica.pdf';
        $ruta_base = '/assets/pdf/';
        $requiere_permiso = false; 
        break;
        
    case 'tema1':
        $nombre_archivo = 'UNIDAD 1 (Profesor).pdf';
        $ruta_base = '/assets/pdf/archivos_profesor/';
        $requiere_permiso = true; 
        break;

    case 'tema2':
        $nombre_archivo = 'UNIDAD 2 (Profesor).pdf';
        $ruta_base = '/assets/pdf/archivos_profesor/';
        $requiere_permiso = false; 
        break;

    case 'tema3':
        $nombre_archivo = 'UNIDAD 3 (Profesor).pdf';
        $ruta_base = '/assets/pdf/archivos_profesor/';
        $requiere_permiso = false;
        break;

    case 'tema4':
        $nombre_archivo = 'UNIDAD 4 (Profesor).pdf';
        $ruta_base = '/assets/pdf/archivos_profesor/';
        $requiere_permiso = false;
        break;

    case 'tema5':
        $nombre_archivo = 'UNIDAD 5 (Profesor).pdf';
        $ruta_base = '/assets/pdf/archivos_profesor/';
        $requiere_permiso = false;
        break;

    default:
        // 3. Usamos 'die()'
        die("ERROR DEBUG: El 'file_key' ('" . htmlspecialchars($file_key) . "') no es válido.");
}

// Lógica de permisos (sin cambios, pero usará 'die()')
if ($requiere_permiso) {
    $es_autorizado = false;
    if (isset($_SESSION['id_tipo_usuario'])) {
        $tipo_usuario = $_SESSION['id_tipo_usuario'];
        if ($tipo_usuario == 1 || $tipo_usuario == 2) {
            $es_autorizado = true;
        }
    }

    if (!$es_autorizado) {
        // 3. Usamos 'die()'
        die("ERROR DEBUG: Acceso denegado. No tiene permisos.");
    }
}

// --- ESTA ES LA PARTE MÁS IMPORTANTE ---
$ruta_completa_archivo = $_SERVER['DOCUMENT_ROOT'] . $ruta_base . $nombre_archivo;

echo "--- MODO DEBUG ACTIVADO ---<br>";
echo "<strong>Usuario de PHP (probable):</strong> " . shell_exec('whoami') . "<br>";
echo "<strong>DOCUMENT_ROOT del servidor:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "<strong>Ruta base del script:</strong> " . $ruta_base . "<br>";
echo "<strong>Nombre de archivo:</strong> " . $nombre_archivo . "<br>";
echo "<strong>Ruta completa que se está verificando:</strong><br><pre>" . htmlspecialchars($ruta_completa_archivo) . "</pre><br>";

if (file_exists($ruta_completa_archivo)) {
    
    echo "<strong>¡ÉXITO!</strong> El archivo se encontró en la ruta de arriba.<br>";
    echo "Si la descarga no inicia, es 100% un problema de PERMISOS DE LECTURA (ver solución 2).<br>";
    
    // Intentamos la descarga...
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($ruta_completa_archivo));
    
    ob_clean();
    flush();
    readfile($ruta_completa_archivo); // Esta línea es la que falla si 'www-data' no puede leer el archivo.
    exit;

} else {
    // 4. EL ERROR MÁS PROBABLE ESTÁ AQUÍ
    echo "<strong><span style='color:red;'>¡FALLO!</span></strong> `file_exists()` ha devuelto 'false'.<br>";
    echo "El archivo NO se encontró en la ruta especificada.<br><br>";
    echo "<strong>Soluciones posibles:</strong><br>";
    echo "1. La ruta está mal escrita (compara la ruta de arriba con la de tu servidor).<br>";
    echo "2. El archivo existe, pero el usuario de PHP (normalmente 'www-data') no tiene permisos para 'ver' la carpeta o el archivo.<br>";
    die("--- FIN DEL DEBUG ---");
}
?>
<?php
    // avatar_controller.php
    session_start();
    include_once __DIR__ . '/../conexion.php'; 
    $redirect_page = '../../code_profesor/menu_ajustes.php';
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../../index.php");
        exit;
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: " . $redirect_page);
        exit;
    }
    if (!isset($_FILES['nuevo_avatar']) || $_FILES['nuevo_avatar']['error'] != UPLOAD_ERR_OK) {
        $_SESSION['error_ajustes'] = "Error al subir el archivo (Código: " . $_FILES['nuevo_avatar']['error'] . "). Inténtalo de nuevo.";
        header("Location: " . $redirect_page);
        exit;
    }
    $id_profesor = $_SESSION['id_usuario'];
    $temp_file = $_FILES['nuevo_avatar']['tmp_name'];
    $stmt_matricula = $conn->prepare("SELECT matricula FROM profesores WHERE id_usuario = ?");
    if (!$stmt_matricula) {
        $_SESSION['error_ajustes'] = "Error al preparar la consulta de matrícula: " . $conn->error;
        header("Location: " . $redirect_page);
        exit;
    }
    $stmt_matricula->bind_param("i", $id_profesor);
    $stmt_matricula->execute();
    $resultado = $stmt_matricula->get_result();

    if ($resultado->num_rows === 0) {
        $_SESSION['error_ajustes'] = "No se pudo encontrar al usuario para obtener la matrícula.";
        header("Location: " . $redirect_page);
        exit;
    }
    $fila = $resultado->fetch_assoc();
    $matricula_profesor = preg_replace("/[^a-zA-Z0-9_-]/", "", $fila['matricula']);
    $stmt_matricula->close();
    if (empty($matricula_profesor)) {
        $_SESSION['error_ajustes'] = "La matrícula obtenida no es válida.";
        header("Location: " . $redirect_page);
        exit;
    }
    const MAX_FILE_SIZE_BYTES = 2 * 1024 * 1024;
    if ($_FILES['nuevo_avatar']['size'] > MAX_FILE_SIZE_BYTES) {
        $_SESSION['error_ajustes'] = "El archivo es demasiado grande. El máximo es 2 MB.";
        header("Location: " . $redirect_page);
        exit;
    }
    $image_info = getimagesize($temp_file);
    if ($image_info === false) {
        $_SESSION['error_ajustes'] = "El archivo no es una imagen válida.";
        header("Location: " . $redirect_page);
        exit;
    }
    $mime = $image_info['mime'];
    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']; 
    if (!in_array($mime, $allowed_mimes)) {
        $_SESSION['error_ajustes'] = "Formato de imagen no permitido (solo JPG, PNG, GIF, WebP).";
        header("Location: " . $redirect_page);
        exit;
    }
    $extension = '';
    switch ($mime) {
        case 'image/jpeg': $extension = '.jpg'; break;
        case 'image/png': $extension = '.png'; break;
        case 'image/gif': $extension = '.gif'; break;
        case 'image/webp': $extension = '.webp'; break;
    }
    $target_dir = dirname(dirname(__DIR__)) . '/images/avatar/'; 
    $file_basename = "avatar_" . $matricula_profesor; 
    $new_filename_db = $file_basename . $extension; 
    $target_file_path = $target_dir . $new_filename_db;
    $old_files = glob($target_dir . $file_basename . ".*");
    if ($old_files) {
        foreach ($old_files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
    if (!is_dir($target_dir)) {
        $_SESSION['error_ajustes'] = "Error: El directorio de destino no existe. (Ruta: " . htmlspecialchars($target_dir) . ")";
        header("Location: " . $redirect_page);
        exit;
    }
    if (!is_writable($target_dir)) {
        $_SESSION['error_ajustes'] = "Error de permisos: El servidor no puede escribir en la carpeta de avatares. (Ruta: " . htmlspecialchars($target_dir) . ")";
        header("Location: " . $redirect_page);
        exit;
    }
    if (move_uploaded_file($temp_file, $target_file_path)) {
        $stmt = $conn->prepare("UPDATE usuarios SET avatar = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $new_filename_db, $id_profesor);
        if ($stmt->execute()) {
            $_SESSION['avatar'] = $new_filename_db; 
            $_SESSION['success_ajustes'] = "Avatar actualizado correctamente.";
        } else {
            $_SESSION['error_ajustes'] = "Error al actualizar la base de datos: " . $conn->error;
            if (file_exists($target_file_path)) {
                unlink($target_file_path);
            }
        }
        $stmt->close();
    } else {
        $_SESSION['error_ajustes'] = "Error desconocido al guardar el archivo de imagen en el servidor.";
    }
    $conn->close();
    header("Location: " . $redirect_page);
    exit;
?>
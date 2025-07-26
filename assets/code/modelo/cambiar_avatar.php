<?php
session_start();
require_once 'conexion.php'; // Ajusta si está en otra carpeta

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['nuevo_avatar'])) {
    $id = $_SESSION['id_usuario']; // ID en base de datos
    $numero_control = $_SESSION['nocontrol']; // ⚠️ Asegúrate de tenerlo en sesión
    $archivo = $_FILES['nuevo_avatar'];

    // Configuraciones
    $permitidos = ['image/jpeg', 'image/png', 'image/jpg'];
    $tamanio_maximo = 2 * 1024 * 1024; // 2 MB
    $carpeta_destino = __DIR__ . '/../../images/avatar/';
    $avatar_actual = $_SESSION['avatar'] ?? '';

    // Validaciones
    if (!in_array($archivo['type'], $permitidos)) {
        echo "<script>alert('Formato no permitido. Usa JPG o PNG.'); history.back();</script>";
        exit;
    }

    if ($archivo['size'] > $tamanio_maximo) {
        echo "<script>alert('Archivo demasiado grande. Máximo 2MB.'); history.back();</script>";
        exit;
    }

    // Obtener extensión
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nuevo_nombre = "avatar_" . $numero_control . "." . $extension;
    $ruta_completa = $carpeta_destino . $nuevo_nombre;

    // Eliminar avatar anterior (si no es el default)
    if (!empty($avatar_actual) && $avatar_actual !== 'avatar_default.jpg') {
        $ruta_anterior = $carpeta_destino . $avatar_actual;
        if (file_exists($ruta_anterior)) {
            unlink($ruta_anterior);
        }
    }

    // Mover archivo subido
    if (move_uploaded_file($archivo['tmp_name'], $ruta_completa)) {
        // Guardar en base de datos
        $stmt = $conn->prepare("UPDATE usuarios SET avatar = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $nuevo_nombre, $id);

        if ($stmt->execute()) {
            $_SESSION['avatar'] = $nuevo_nombre;

            echo "<script>
                alert('Avatar actualizado con éxito');
                window.location.href = '/assets/code/alumnos/temas/index_alumnos.php?lang={$_SESSION['idioma']}';
            </script>";
            exit;
        } else {
            echo "Error al guardar en base de datos: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error al guardar la imagen'); history.back();</script>";
    }

    $conn->close();
} else {
    header('Location: /index.php');
    exit;
}
?>
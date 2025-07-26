<?php
session_start();
require_once 'conexion.php'; // Ajusta la ruta
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id_usuario']; // Asegúrate de que esté en sesión

    if ($_POST['form_type'] === 'datos_personales') {
        // Datos personales
        $nombre = trim($_POST['nombre']);
        $apellido_p = trim($_POST['apellido_p']);
        $apellido_m = trim($_POST['apellido_m']);
        $campus = trim($_POST['campus']); // solo clave, como 'itcv'

        $stmt = $conn->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, campus = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssssi", $nombre, $apellido_p, $apellido_m, $campus, $id);

        if ($stmt->execute()) {
            // Actualiza variables de sesión
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido_paterno'] = $apellido_p;
            $_SESSION['apellido_materno'] = $apellido_m;
            $_SESSION['campus'] = $campus;
echo "<script>
    alert('¡Datos personales actualizados con éxito!');
    window.location.href = '/assets/code/alumnos/temas/index_alumnos.php';
</script>";
exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();

    } elseif ($_POST['form_type'] === 'cambio_contraseña') {
        // Cambio de contraseña
        $oldpass = trim($_POST['oldpass']);
        $newpass = trim($_POST['pass']);

        // Verificar contraseña anterior
        $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($hashed);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($oldpass, $hashed)) {
            echo "<script>alert('Contraseña antigua incorrecta'); history.back();</script>";
            exit;
        }

        // Encriptar y actualizar
        $newHashed = password_hash($newpass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET pass = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $newHashed, $id);

        if ($stmt->execute()) {
                // Opcional: destruir sesión y redirigir a logout
                echo "<script>
    alert('¡Contraseña actualizada con éxito! Se cerrará tu sesión.');
    window.location.href = '/logout.php';
</script>";
exit;
    session_destroy();
    header("Location: /logout.php");
    exit;
        } else {
            echo "Error al actualizar contraseña: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
}
?>

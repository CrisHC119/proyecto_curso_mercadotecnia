<?php
// --- INICIO DE CORRECCIONES ---

// 1. Iniciar la sesión
// Soluciona: "Warning: Undefined variable $_SESSION"
session_start();

// 2. Incluir la conexión (Ya la tenías)
require_once __DIR__ . '/../conexion.php'; 

// 3. Incluir el script de idioma
// Soluciona: "Warning: Undefined variable $textos"
require_once '../../code_alumnos/code_general/verificar_idioma.php'; 

// 4. Incluir el script de log
// Soluciona: "Fatal error: Call to undefined function escribirLog()"
include_once __DIR__ . '/../../scripts/script_registrar_log.php';

// 5. Opcional pero recomendado: Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- FIN DE CORRECCIONES ---


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id_usuario']; // <-- Ahora $_SESSION existe
    
    if ($_POST['form_type'] === 'datos_personales') {
        $nombre = trim($_POST['nombre']);
        $apellido_p = trim($_POST['apellido_p']);
        $apellido_m = trim($_POST['apellido_m']);
        $campus = trim($_POST['campus']);
        
        $stmt = $conn->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, campus = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssssi", $nombre, $apellido_p, $apellido_m, $campus, $id);
        
        if ($stmt->execute()) {
            // ¡CORRECCIÓN DE APELLIDOS!
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido_p'] = $apellido_p;
            $_SESSION['apellido_m'] = $apellido_m;
            $_SESSION['campus'] = $campus;

            // IMPLEMENTACIÓN DEL MODAL
            // Prepara el mensaje de éxito
            $_SESSION['show_success_modal'] = $textos['alert_datos_actualizados']; // <-- Ahora $textos existe
            
            escribirLog("Actualización de datos exitoso (" .$_SESSION['nocontrol'] ."): " . $nombre . " " . $apellido_p . " " . $apellido_m . " (Campus (Checar alias adjunto): " . $campus . ")"); // <-- Ahora escribirLog() existe
            
            // Redirige de vuelta a la página de perfil
            $redirect_page = '/assets/code_alumnos/alumnos/perfil.php';
            header("Location: " . $redirect_page . "?lang=" . $idioma); // <-- Ahora $idioma existe
            exit;

        } else {
            // Maneja el error
            $_SESSION['error_ajustes'] = "Error al actualizar: " . $stmt->error;
            $redirect_page = '/assets/code_alumnos/alumnos/perfil.php';
            header("Location: " . $redirect_page . "?lang=" . $idioma);
            exit;
        }
        $stmt->close();

    } elseif ($_POST['form_type'] === 'cambio_contraseña') {
        $oldpass = trim($_POST['oldpass']);
        $newpass = trim($_POST['pass']);

        $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($hashed);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($oldpass, $hashed)) {
            echo "<script>alert('" . $textos['pass_erronea_actualizar'] . "'); history.back();</script>";
            exit;
        }

        $newHashed = password_hash($newpass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET pass = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $newHashed, $id);

        if ($stmt->execute()) {
            session_destroy();
            echo "<script>
                    alert('" . $textos['pass_correcta_actualizada'] . "');
                    window.location.href = '/../logout.php';
                  </script>";
            // OJO: escribirLog() aquí fallará porque la sesión se destruyó.
            // Para que funcione, muévelo ANTES de session_destroy();
            // escribirLog("Actualización de contraseña exitoso (" .$_SESSION['nocontrol'] .")");
            exit;
        } else {
            echo $textos['pass_erronea'] . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
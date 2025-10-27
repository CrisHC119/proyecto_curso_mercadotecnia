<?php
    session_start();

    require_once __DIR__ . '/../conexion.php'; 

    require_once '../../code_alumnos/code_general/verificar_idioma.php'; 

    include_once __DIR__ . '/../../scripts/script_registrar_log.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id_usuario']; 
        
        if ($_POST['form_type'] === 'datos_personales') {
            $nombre = trim($_POST['nombre']);
            $apellido_p = trim($_POST['apellido_p']);
            $apellido_m = trim($_POST['apellido_m']);
            $campus = trim($_POST['campus']);
            
            $stmt = $conn->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, campus = ? WHERE id_usuario = ?");
            $stmt->bind_param("ssssi", $nombre, $apellido_p, $apellido_m, $campus, $id);
            
            if ($stmt->execute()) {
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido_p'] = $apellido_p;
                $_SESSION['apellido_m'] = $apellido_m;
                $_SESSION['campus'] = $campus;

                $_SESSION['show_success_modal'] = $textos['alert_datos_actualizados']; 
                
                escribirLog("Actualización de datos exitoso (" .$_SESSION['nocontrol'] ."): " . $nombre . " " . $apellido_p . " " . $apellido_m . " (Campus (Checar alias adjunto): " . $campus . ")"); // <-- Ahora escribirLog() existe
                
                $redirect_page = '/assets/code_alumnos/alumnos/perfil.php';
                header("Location: " . $redirect_page . "?lang=" . $idioma);
                exit;

            } else {
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
                
                $_SESSION['show_logout_modal'] = $textos['pass_correcta_actualizada']; 

                escribirLog("Actualización de contraseña exitosa (" .$_SESSION['nocontrol'] .")");

                $redirect_page = '/assets/code_alumnos/alumnos/perfil.php';
                header("Location: " . $redirect_page . "?lang=" . $idioma);
                exit;
            } else {
                echo $textos['pass_erronea'] . $stmt->error;
            }
            $stmt->close();

        }
        $conn->close();
    }
?>
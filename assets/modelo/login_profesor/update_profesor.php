<?php
    session_start();
    include_once __DIR__ . '/../../scripts/script_registrar_log.php';
    require_once '../conexion.php'; 
    require_once __DIR__ . '/../../code_general/verificar_idioma.php'; 

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id_usuario']; 

        // --- SECCIÓN PARA ACTUALIZAR DATOS PERSONALES ---
        if ($_POST['form_type'] === 'datos_personales') {
            $nombre = trim($_POST['nombre']);
            $apellido_p = trim($_POST['apellido_p']);
            $apellido_m = trim($_POST['apellido_m']);
            $campus = trim($_POST['campus']);

            $stmt = $conn->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, campus = ? WHERE id_usuario = ?");
            $stmt->bind_param("ssssi", $nombre, $apellido_p, $apellido_m, $campus, $id);

            if ($stmt->execute()) {
                // Actualizamos las variables de sesión con los nuevos datos
                $_SESSION['nombre'] = $nombre;
                // ✅ CORRECCIÓN: Usar los nombres de variable de sesión correctos
                $_SESSION['apellido_p'] = $apellido_p; 
                $_SESSION['apellido_m'] = $apellido_m;
                $_SESSION['campus'] = $campus;

                echo "<script>
                        alert('" . ($textos['alert_datos_actualizados'] ?? 'Datos actualizados con éxito.') . "');
                        window.location.href = '/assets/code_profesor/perfil_profesor.php';
                      </script>";
                
                escribirLog("Actualización de datos (Profesor: " .($_SESSION['matricula'] ?? 'N/A') ."): " . $nombre . " " . $apellido_p);
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } 
        
        // --- SECCIÓN PARA CAMBIAR CONTRASEÑA (sin cambios necesarios aquí) ---
        elseif ($_POST['form_type'] === 'cambio_contraseña') {
            $oldpass = trim($_POST['oldpass']);
            $newpass = trim($_POST['pass']);

            $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($hashed);
            $stmt->fetch();
            $stmt->close();

            if (!password_verify($oldpass, $hashed)) {
                echo "<script>alert('" . ($textos['pass_erronea_actualizar'] ?? 'La contraseña actual es incorrecta.') . "'); history.back();</script>";
                exit;
            }

            $newHashed = password_hash($newpass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE usuarios SET pass = ? WHERE id_usuario = ?");
            $stmt->bind_param("si", $newHashed, $id);

            if ($stmt->execute()) {
                session_destroy();
                echo "<script>
                        alert('" . ($textos['pass_correcta_actualizada'] ?? 'Contraseña actualizada. Por favor, inicie sesión de nuevo.') . "');
                        window.location.href = '/logout.php';
                      </script>";
                      
                escribirLog("Actualización de contraseña (Profesor: " .($_SESSION['matricula'] ?? 'N/A') .")");
                exit;
            } else {
                echo ($textos['pass_erronea'] ?? 'Error al actualizar contraseña: ') . $stmt->error;
            }
            $stmt->close();
        }
        $conn->close();
    }
?>
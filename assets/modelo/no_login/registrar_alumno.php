<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php';
$idioma = $_SESSION['lang'] ?? 'es';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $semestre = $_POST['semestre'];
    $campus = $_POST['campus'];
    $nocontrol = $_POST['nocontrol'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $nombreAvatarFinal = 'avatar_default.jpg';

    // --- INICIO DE LA NUEVA LÓGICA DE VERIFICACIÓN ---
    
    $conflictoEncontrado = false;
    $mensajeError = "";

    // 1. Verificación básica: ¿Ya existe este texto exacto en alumnos?
    // (Ej: Si existe "A123" y meten "A123")
    $verificarTexto = $conn->prepare("SELECT nocontrol FROM alumnos WHERE nocontrol = ?");
    $verificarTexto->bind_param("s", $nocontrol);
    $verificarTexto->execute();
    $verificarTexto->store_result();
    if ($verificarTexto->num_rows > 0) {
        $conflictoEncontrado = true;
        $mensajeError = "El número de control ya está registrado.";
    }
    $verificarTexto->close();

    // 2. Verificación Numérica (Aquí evitamos el 22 vs 0022 vs ID 22)
    // Solo ejecutamos esto si el nocontrol contiene SOLAMENTE números
    if (!$conflictoEncontrado && ctype_digit($nocontrol)) {
        
        $valorNumerico = intval($nocontrol); // Convierte "00022" a 22 (entero)

        // A) Verificar conflicto con IDs de usuario (Ej: Tu ejemplo del ID 22)
        // Buscamos si existe un usuario cuyo ID sea igual al nocontrol ingresado
        $verificarID = $conn->prepare("SELECT id_usuario FROM usuarios WHERE id_usuario = ?");
        $verificarID->bind_param("i", $valorNumerico);
        $verificarID->execute();
        $verificarID->store_result();
        
        if ($verificarID->num_rows > 0) {
            $conflictoEncontrado = true;
            $mensajeError = "El número de control ya se encuentra registrado.";
        }
        $verificarID->close();

        // B) Verificar variantes numéricas en Alumnos
        // (Ej: Si ya existe el alumno con nocontrol "22" y alguien intenta registrar "0022")
        if (!$conflictoEncontrado) {
            // Buscamos strings que matemáticamente sean iguales
            // NOTA: Esto asume que en la BD los numéricos están limpios, pero por seguridad checamos ambas formas:
            // 1. El valor como string simple ('22')
            // 2. El valor original con ceros ('00022') ya se checó arriba
            $valStr = (string)$valorNumerico; 
            
            // Si el input original era "0022" ($nocontrol) y el convertido es "22" ($valStr)
            // Verificamos si existe el "22" puro en la base de datos
            if ($nocontrol !== $valStr) {
                $verificarVariante = $conn->prepare("SELECT nocontrol FROM alumnos WHERE nocontrol = ?");
                $verificarVariante->bind_param("s", $valStr);
                $verificarVariante->execute();
                $verificarVariante->store_result();
                if ($verificarVariante->num_rows > 0) {
                    $conflictoEncontrado = true;
                    $mensajeError = "El número de control ya existe (variante numérica registrada).";
                }
                $verificarVariante->close();
            }
        }
    }

    // Si hubo algún error en las verificaciones, regresamos
    if ($conflictoEncontrado) {
        $conn->close();
        header("Location: /register.php?toast_msg=" . urlencode($mensajeError) . "&lang=" . $idioma);
        exit;
    }

    // --- FIN DE LA NUEVA LÓGICA ---

    // Si pasó todas las pruebas, procedemos a insertar
    $sqlUsuario = "INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, campus, idioma, pass, id_tipo_usuario, fecha_registro, avatar)
                   VALUES (?, ?, ?, ?, ?, ?, 3, NOW(), ?)";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("sssssss", $nombres, $apellido_paterno, $apellido_materno, $campus, $idioma, $pass, $nombreAvatarFinal);

    if ($stmtUsuario->execute()) {
        $id_usuario = $conn->insert_id;
        $stmtUsuario->close();

        $sqlAlumno = "INSERT INTO alumnos (id_usuario, nocontrol, semestre) VALUES (?, ?, ?)";
        $stmtAlumno = $conn->prepare($sqlAlumno);
        // Nota: nocontrol se pasa tal cual lo escribió el usuario (con ceros si quiere),
        // pero ya sabemos que es único matemáticamente.
        $stmtAlumno->bind_param("isi", $id_usuario, $nocontrol, $semestre); 
        
        if ($stmtAlumno->execute()) {
            $stmtAlumno->close();
            $conn->close();
            header("Location: /register.php?registro=exito&lang=" . $idioma);
            exit;
        } else {
            $error = "Error al registrar en Alumnos: " . $stmtAlumno->error;
            $stmtAlumno->close();
            $conn->close();
            header("Location: /register.php?toast_msg=" . urlencode($error) . "&lang=" . $idioma);
            exit;
        }
    } else {
        $error = "Error al registrar en Usuarios: " . $stmtUsuario->error;
        $stmtUsuario->close();
        $conn->close();
        header("Location: /register.php?toast_msg=" . urlencode($error) . "&lang=" . $idioma);
        exit;
    }
} else {
    // Si no es POST, no hacemos nada o redirigimos (aunque el HTML de abajo se encargará de mostrar el form)
    // Pero si se llama al archivo directamente para procesar datos sin POST:
    if (basename($_SERVER['PHP_SELF']) == 'registrar_alumno.php') { 
         header("Location: /register.php?toast_msg=" . urlencode("Método no permitido.") . "&lang=" . $idioma);
         exit;
    }
}
?>
<?php
    // guardar_examen.php
    session_start();
    require_once '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Acceso denegado.");

    if (!isset($_SESSION['id_usuario'])) {
        die("Error de sesión.");
    }

    $id_examen = intval($_POST['id_examen']);
    $conn->begin_transaction();

    try {
        if (isset($_POST['preguntas_eliminar']) && is_array($_POST['preguntas_eliminar'])) {
            foreach ($_POST['preguntas_eliminar'] as $idEliminar) {
                $idEliminar = intval($idEliminar);
                
                $stmtDelResp = $conn->prepare("DELETE FROM examen_respuesta WHERE id_pregunta = ?");
                $stmtDelResp->bind_param("i", $idEliminar);
                $stmtDelResp->execute();
                $stmtDelResp->close();

                $stmtDelPreg = $conn->prepare("DELETE FROM examen_pregunta WHERE id_pregunta = ?");
                $stmtDelPreg->bind_param("i", $idEliminar);
                $stmtDelPreg->execute();
                $stmtDelPreg->close();
            }
        }

        if (isset($_POST['pregunta_existente'])) {
            foreach ($_POST['pregunta_existente'] as $idPregunta => $datos) {
                if (isset($_POST['preguntas_eliminar']) && in_array($idPregunta, $_POST['preguntas_eliminar'])) {
                    continue; 
                }

                $textoPregunta = $datos['texto'];
                $esVF = isset($datos['tipo']) ? 1 : 0;
                $indiceCorrecto = intval($datos['correcto']);

                $stmtUpdPreg = $conn->prepare("UPDATE examen_pregunta SET pregunta = ?, pre_falso = ? WHERE id_pregunta = ?");
                $stmtUpdPreg->bind_param("sii", $textoPregunta, $esVF, $idPregunta);
                $stmtUpdPreg->execute();
                $stmtUpdPreg->close();

                if (isset($datos['respuestas'])) {
                    foreach ($datos['respuestas'] as $index => $respData) {
                        if ($esVF && $index > 1) continue; 

                        $idRespuesta = intval($respData['id']);
                        $textoRespuesta = $respData['texto'];
                        $esCorrecta = ($index === $indiceCorrecto) ? 1 : 0;

                        $stmtUpdResp = $conn->prepare("UPDATE examen_respuesta SET respuesta = ?, correcto = ? WHERE id_respuesta = ?");
                        $stmtUpdResp->bind_param("sii", $textoRespuesta, $esCorrecta, $idRespuesta);
                        $stmtUpdResp->execute();
                        $stmtUpdResp->close();
                    }
                }
            }
        }

        if (isset($_POST['pregunta_nueva'])) {
            $stmtInsPreg = $conn->prepare("INSERT INTO examen_pregunta (id_examen, pregunta, pre_falso) VALUES (?, ?, ?)");
            $stmtInsResp = $conn->prepare("INSERT INTO examen_respuesta (id_pregunta, respuesta, correcto) VALUES (?, ?, ?)");

            foreach ($_POST['pregunta_nueva'] as $datos) {
                $textoPregunta = $datos['texto'];
                $esVF = isset($datos['tipo']) ? 1 : 0;
                $indiceCorrecto = intval($datos['correcto']);

                $stmtInsPreg->bind_param("isi", $id_examen, $textoPregunta, $esVF);
                $stmtInsPreg->execute();
                $nuevoIdPregunta = $conn->insert_id;

                if (isset($datos['respuestas'])) {
                    foreach ($datos['respuestas'] as $index => $textoRespuesta) {
                        if ($esVF && $index > 1) continue;
                        
                        $esCorrecta = ($index === $indiceCorrecto) ? 1 : 0;
                        $stmtInsResp->bind_param("isi", $nuevoIdPregunta, $textoRespuesta, $esCorrecta);
                        $stmtInsResp->execute();
                    }
                }
            }
            $stmtInsPreg->close();
            $stmtInsResp->close();
        }

        $conn->commit();
        header("Location: ../../code_profesor/modificar_examen.php?unidad=$id_examen&success=1");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        die("Error crítico al guardar: " . $e->getMessage());
    }
?>
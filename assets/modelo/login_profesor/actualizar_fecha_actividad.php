<?php
    // verificar_examen_fecha.php

    session_start();
    require_once '../conexion.php'; 

    header('Content-Type: application/json');
    date_default_timezone_set('America/Monterrey');

    $id_profesor = $_SESSION['id_usuario'] ?? null; 
    if (!$id_profesor) {
        echo json_encode(['success' => false, 'message' => 'Sesión no válida. Inicie sesión de nuevo.']);
        exit;
    }

    $id_unidad = (int)($_POST['id_unidad'] ?? 0);
    $id_actividad_num = (int)($_POST['id_actividad'] ?? 0);
    $fecha_disponible_str = $_POST['fecha_disponible'] ?? null;
    $fecha_limite_str = $_POST['fecha_limite'] ?? null;
    $accion = $_POST['accion'] ?? null;
    $password_ingresada = $_POST['password'] ?? null;

    if (empty($id_unidad) || empty($id_actividad_num) || empty($accion) || empty($password_ingresada)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos (unidad, actividad, acción, contraseña).']);
        exit;
    }

    $stmtPass = $conn->prepare("SELECT pass FROM usuarios WHERE id_usuario = ?");

    if ($id_unidad < 1 || $id_unidad > 5 || $id_actividad_num < 1 || $id_actividad_num > 5) {
        echo json_encode(['success' => false, 'message' => 'ID de unidad o actividad no válido.']);
        $conn->close(); exit;
    }

    $col_inicio = "act_{$id_actividad_num}_fecha_inicial";
    $col_fin = "act_{$id_actividad_num}_fecha_final";

    $sql_update_unidad = "";
    $params_unidad = [];
    $types_unidad = "";

    $sql_update_maestra = "";
    $params_maestra = [];
    $types_maestra = "";

    if ($accion === 'guardar') {
        if (empty($fecha_disponible_str) || empty($fecha_limite_str)) {
            echo json_encode(['success' => false, 'message' => 'Se requieren ambas fechas (inicio y fin) para guardar.']);
            $conn->close(); exit;
        }
        
        try {
            $fecha_disponible_dt = new DateTime($fecha_disponible_str);
            $fecha_limite_dt = new DateTime($fecha_limite_str);

            if ($fecha_limite_dt <= $fecha_disponible_dt) {
                echo json_encode(['success' => false, 'message' => 'La fecha de finalización debe ser posterior a la fecha de inicio.']);
                $conn->close(); exit;
            }
            
            $fecha_disponible_db = $fecha_disponible_dt->format('Y-m-d H:i:s');
            $fecha_limite_db = $fecha_limite_dt->format('Y-m-d H:i:s');

            $sql_update_unidad = "UPDATE alumnos_actividad_fecha SET $col_inicio = ?, $col_fin = ? WHERE id_unidad = ?";
            $params_unidad = [$fecha_disponible_db, $fecha_limite_db, $id_unidad];
            $types_unidad = "ssi"; 
            
            if ($id_unidad != 1) {
                $sql_update_maestra = "UPDATE alumnos_actividad_fecha SET $col_inicio = ?, $col_fin = ? WHERE id_unidad = 1";
                $params_maestra = [$fecha_disponible_db, $fecha_limite_db];
                $types_maestra = "ss";
            }

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Formato de fecha inválido.']);
            $conn->close(); exit;
        }

    } elseif ($accion === 'reiniciar') {
        
        $sql_update_unidad = "UPDATE alumnos_actividad_fecha SET $col_inicio = NULL, $col_fin = NULL WHERE id_unidad = ?";
        $params_unidad = [$id_unidad];
        $types_unidad = "i";
        
        if ($id_unidad != 1) {
            $sql_update_maestra = "UPDATE alumnos_actividad_fecha SET $col_inicio = NULL, $col_fin = NULL WHERE id_unidad = 1";
            $params_maestra = []; 
            $types_maestra = "";
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
        $conn->close(); exit;
    }

    $conn->autocommit(false);
    $exito_unidad = false;
    $exito_maestra = true;

    $stmt_unidad = $conn->prepare($sql_update_unidad);
    if ($stmt_unidad) {
        $stmt_unidad->bind_param($types_unidad, ...$params_unidad); 
        if ($stmt_unidad->execute()) {
            $exito_unidad = true;
        }
        $stmt_unidad->close();
    }

    if ($id_unidad != 1 && $sql_update_maestra) {
        $stmt_maestra = $conn->prepare($sql_update_maestra);
        if ($stmt_maestra) {
            if ($accion == 'guardar') {
                $stmt_maestra->bind_param($types_maestra, ...$params_maestra);
            }
            
            if ($stmt_maestra->execute()) {
                $exito_maestra = true;
            } else {
                $exito_maestra = false;
            }
            $stmt_maestra->close();
        } else {
            $exito_maestra = false;
        }
    }

    if ($exito_unidad && $exito_maestra) {
        $conn->commit();
        echo json_encode(['success' => true]);
    } else {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar una o ambas actualizaciones en la base de datos.']);
    }

    $conn->autocommit(true);
    $conn->close();
?>
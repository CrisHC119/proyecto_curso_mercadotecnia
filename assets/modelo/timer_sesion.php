<?php
    // timer_sesion.php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/modelo/conexion.php'; 
    $INACTIVITY_TIMEOUT_MS = 300000; 

    if (isset($_SESSION['id_tipo_usuario']) && isset($conn)) {

        $stmt_timer = $conn->prepare("SELECT timer_profesor, timer_alumno FROM timer_login WHERE id = 1");
        
        if ($stmt_timer) {
            $stmt_timer->execute();
            $resultado_timer = $stmt_timer->get_result();
            
            if ($resultado_timer->num_rows > 0) {
                $fila_timer = $resultado_timer->fetch_assoc();
                
                if (in_array($_SESSION['id_tipo_usuario'], [1, 2])) {
                    $INACTIVITY_TIMEOUT_MS = (int)$fila_timer['timer_profesor'];
                } elseif ($_SESSION['id_tipo_usuario'] == 3) {
                    $INACTIVITY_TIMEOUT_MS = (int)$fila_timer['timer_alumno'];
                }
            }
            $stmt_timer->close();
        }
    }
?>
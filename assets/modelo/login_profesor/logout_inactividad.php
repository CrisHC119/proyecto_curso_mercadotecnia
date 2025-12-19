<?php
    // logout_inactividad.php
    $tiempo_inactividad = 60;

    if (isset($_SESSION['ultimo_movimiento'])) {
        if (time() - $_SESSION['ultimo_movimiento'] > $tiempo_inactividad) {
            session_unset();
            session_destroy();
            header("Location: ../../../login.php?msg=Sesion_expirada");
            exit();
        }
    }

    $_SESSION['ultimo_movimiento'] = time();
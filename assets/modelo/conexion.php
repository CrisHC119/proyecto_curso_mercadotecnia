<?php
    //conexion.php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    /*$servername = "34.71.24.92";
    $username = "root";
    $password = "N8516uCCY2gsdfWW7TRa8AF0cnSI9U";
    */
    $servername = "localhost";
    $username = "root";
    $password = "1234";

    $database = "curso_mercadotecnia";

    try {
        $conn = new mysqli($servername, $username, $password, $database);
        $conn->set_charset("utf8");
    } catch (mysqli_sql_exception $e) {
        error_log("Error de conexión a DB: " . $e->getMessage());
        session_start(); 
        $_SESSION['error_db'] = $e->getMessage();

        if (ob_get_length()) ob_end_clean();
        header("Location: /assets/code_404/lost_page_no_conexion.php?lang=" . $_SESSION['lang']);
        exit;
    }
?>
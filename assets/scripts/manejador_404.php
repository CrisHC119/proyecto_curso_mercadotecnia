<?php
    http_response_code(404);

    include_once __DIR__ . '/../../assets/code_general/verificar_session_apagado.php';

    $pagina_no_logueado = __DIR__ . '/../../assets/code_404/lost_page_NL.php';
    $pagina_alumno = __DIR__ . '/../../assets/code_404/lost_page_Alumnos.php';
    $pagina_profesor = __DIR__ . '/../../assets/code_404/lost_page_Profesor.php';

    if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_tipo_usuario'])) {
        
        $tipo = intval($_SESSION['id_tipo_usuario']);

        switch ($tipo) {
            case 3:
                include_once($pagina_alumno);
                break;
            case 1:
            case 2:
                include_once($pagina_profesor);
                break;
            
            default:
                include_once($pagina_no_logueado);
                break;
        }
    } else {
        include_once($pagina_no_logueado);
    }
exit;
?>
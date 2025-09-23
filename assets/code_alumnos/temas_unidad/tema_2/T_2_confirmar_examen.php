<?php
    include_once __DIR__ . '/../../../code_general/verificar_session_apagado.php';
    include_once __DIR__ . '/../../../code_general/bootstrap_5.php';
    include_once __DIR__ . '/../../../code_general/verificar_session_apagado.php';

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: /index.php");
        exit;
    }

    if (!isset($_SESSION['id_tipo_usuario'])) {
        header("Location: /index.php");
        exit;
    }

    $tipo = intval($_SESSION['id_tipo_usuario']);

    if ($tipo === 3) {
    } elseif ($tipo === 1 || $tipo === 2) {
        header("Location: /assets/code_profesor/index_profesor.php");
        exit;
    } else {
        header("Location: /index.php");
        exit;
    }

    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Confirmación de Examen - Unidad 2</title>
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }
    </style>
</head>
<body>

    <div class="container d-flex flex-column justify-content-center min-vh-100 py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                
                <div class="card shadow-lg border-0 rounded-4 text-center" style="max-width: 600px; margin: auto;">
                    <div class="card-body p-4 p-sm-5">

                        <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>

                        <h2 class="card-title mb-3">Confirmar Examen</h2>
                        <p class="text-muted">Estás a punto de iniciar el examen de la <strong>Unidad 2</strong>.</p>
                        
                        <div class="alert alert-info mt-4">
                            <h5 class="alert-heading">Reglas del Examen</h5>
                            <ul class="list-unstyled mb-0 text-start">
                                <li><i class="bi bi-alarm me-2"></i><strong>Tiempo Límite:</strong> 10 minutos.</li>
                                <li><i class="bi bi-exclamation-triangle me-2"></i><strong>Importante:</strong> El cronómetro no se detiene una vez iniciado.</li>
                            </ul>
                        </div>

                        <form action="T_2_Examen.php" method="post" class="mt-4">
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-play-circle me-2"></i>Comenzar Examen
                                </button>
                                <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Regresar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
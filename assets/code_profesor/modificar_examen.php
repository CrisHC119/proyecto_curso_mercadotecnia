<?php
    $page_5 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    require_once '../modelo/conexion.php';

    $unidad = isset($_GET['unidad']) ? intval($_GET['unidad']) : 0;
    if ($unidad < 1 || $unidad > 5) {
        die("Unidad inválida. Por favor, seleccione una unidad del 1 al 5.");
    }
    $id_examen = $unidad; // Asumimos que id_examen es igual a la unidad

    $stmtPreguntas = $conn->prepare("SELECT * FROM examen_pregunta WHERE id_examen = ? ORDER BY id_pregunta");
    $stmtPreguntas->bind_param("i", $id_examen);
    $stmtPreguntas->execute();
    $preguntas = $stmtPreguntas->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Examen - Unidad <?= $unidad ?></title>
    <style>
        /* Page-specific layout styles */
        .card-pregunta { margin-bottom: 1.5rem; }
        .pregunta-header { display: flex; align-items: center; gap: 1rem; }
        .pregunta-header span { font-size: 1.25rem; font-weight: 600; }
        .respuesta-item .input-group-text { padding: .375rem .6rem; }
        .respuesta-item input[type="radio"] { width: 1.25em; height: 1.25em; }

        /* --- THEME STYLES --- */
        /* Light Mode (Default) */
        body { 
            --bs-body-bg: #f8f9fa; 
            --bs-body-color: #212529; 
        }
        .card { 
            background-color: #fff; 
            border-color: #dee2e6;
        }
        .form-control, .input-group-text {
            background-color: #fff;
            border-color: #ced4da;
            color: #212529;
        }
        .alert-success {
            color: #0a3622;
            background-color: #d1e7dd;
            border-color: #a3cfbb;
        }

        /* Dark Mode (Night Mode) */
        body.light-mode { 
            --bs-body-bg: #121212; 
            --bs-body-color: #f1f1f1; 
        }
        body.light-mode .card { 
            background-color: #2c2c2c; 
            border-color: rgba(255,255,255,0.1); 
            color: var(--bs-body-color);
        }
        body.light-mode .form-control,
        body.light-mode .input-group-text { 
            background-color: #333; 
            border-color: #555; 
            color: #fff; 
        }
        body.light-mode .form-check-input {
            background-color: #333;
            border-color: rgba(255,255,255,0.25);
        }
        body.light-mode .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        body.light-mode .alert-success {
            color: #a3cfbb;
            background-color: #0a3622;
            border-color: #1a4a35;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<main class="flex-fill">
    <div class="container py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">📝 Editar Examen - Unidad <?= $unidad ?></h1>
            <a href="menu_examenes.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Regresar
            </a>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">✅ ¡Examen actualizado correctamente!</div>
        <?php endif; ?>

        <form action="../modelo/login_profesor/guardar_examen.php" method="POST">
            <input type="hidden" name="id_examen" value="<?= $id_examen ?>">
            
            <?php foreach ($preguntas as $index => $pregunta): ?>
                <div class="card card-pregunta shadow-sm">
                    <div class="card-body">
                        <div class="pregunta-header mb-3">
                            <span><?= ($index + 1) ?></span>
                            <textarea name="pregunta[<?= $pregunta['id_pregunta'] ?>]" class="form-control" rows="2"><?= htmlspecialchars($pregunta['pregunta']) ?></textarea>
                        </div>

                        <h6>Respuestas:</h6>
                        <?php
                        $stmtRespuestas = $conn->prepare("SELECT * FROM examen_respuesta WHERE id_pregunta = ? ORDER BY id_respuesta");
                        $stmtRespuestas->bind_param("i", $pregunta['id_pregunta']);
                        $stmtRespuestas->execute();
                        $respuestas = $stmtRespuestas->get_result()->fetch_all(MYSQLI_ASSOC);
                        
                        foreach ($respuestas as $respuesta):
                        ?>
                        <div class="respuesta-item input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" 
                                       name="correcto[<?= $pregunta['id_pregunta'] ?>]" 
                                       value="<?= $respuesta['id_respuesta'] ?>" 
                                       <?= $respuesta['correcto'] ? 'checked' : '' ?>
                                       aria-label="Marcar como correcta">
                            </div>
                            <input type="text" name="respuesta[<?= $respuesta['id_respuesta'] ?>]" class="form-control" value="<?= htmlspecialchars($respuesta['respuesta']) ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-circle-fill"></i> Guardar Cambios
                </button>
            </div>
        </form>

    </div>
</main>
<?php include_once __DIR__ . '/../code_general/footer.php'; ?>
</body>
</html>
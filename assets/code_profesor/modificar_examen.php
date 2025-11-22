<?php
    $page_5 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    require_once '../modelo/conexion.php';

    $unidad = isset($_GET['unidad']) ? intval($_GET['unidad']) : 0;
    if ($unidad < 1 || $unidad > 5) {
        die("Unidad inválida.");
    }
    $id_examen = $unidad;

    // Obtener preguntas existentes
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
        /* Estilos base */
        body { --bs-body-bg: #f8f9fa; --bs-body-color: #212529; }
        .card { background-color: #fff; border-color: #dee2e6; margin-bottom: 1.5rem; }
        .form-control, .input-group-text { background-color: #fff; border-color: #ced4da; color: #212529; }
        
        /* Modo Oscuro */
        body.light-mode { --bs-body-bg: #121212; --bs-body-color: #f1f1f1; }
        body.light-mode .card { background-color: #2c2c2c; border-color: rgba(255,255,255,0.1); color: #f1f1f1; }
        body.light-mode .form-control, body.light-mode .input-group-text, body.light-mode .form-select { 
            background-color: #333; border-color: #555; color: #fff; 
        }
        
        .btn-add-question { border-style: dashed; border-width: 2px; }
        .pregunta-deleted { display: none !important; } /* Clase para ocultar al borrar */
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<main class="flex-fill">
    <div class="container py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">📝 Editar Examen - Unidad <?= $unidad ?></h1>
            <a href="menu_examenes.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Regresar</a>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                ✅ Cambios guardados correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="../modelo/login_profesor/guardar_examen.php" method="POST" id="formExamen">
            <input type="hidden" name="id_examen" value="<?= $id_examen ?>">
            
            <div id="inputs-eliminados"></div>

            <div id="contenedor-preguntas">
                <?php 
                // --- BUCLE DE PREGUNTAS EXISTENTES ---
                foreach ($preguntas as $index => $pregunta): 
                    $esVF = $pregunta['pre_falso'] == 1;
                    $idP = $pregunta['id_pregunta'];
                    $numeroPregunta = $index + 1; // Numeración secuencial (1, 2, 3...)
                    
                    // Obtener respuestas
                    $stmtResp = $conn->prepare("SELECT * FROM examen_respuesta WHERE id_pregunta = ? ORDER BY id_respuesta");
                    $stmtResp->bind_param("i", $idP);
                    $stmtResp->execute();
                    $respuestas = $stmtResp->get_result()->fetch_all(MYSQLI_ASSOC);
                ?>
                <div class="card card-pregunta shadow-sm" id="card_pregunta_<?= $idP ?>">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-primary fs-6">Pregunta <?= $numeroPregunta ?></span>
                            
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input toggle-tipo" type="checkbox" role="switch" 
                                       id="switch_<?= $idP ?>" 
                                       name="pregunta_existente[<?= $idP ?>][tipo]" 
                                       value="1" 
                                       <?= $esVF ? 'checked' : '' ?> 
                                       onchange="cambiarTipo(this, 'cont_resp_<?= $idP ?>')">
                                <label class="form-check-label small" for="switch_<?= $idP ?>">Verdadero/Falso</label>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="marcarParaEliminar(<?= $idP ?>)">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>

                    <div class="card-body">
                        <textarea name="pregunta_existente[<?= $idP ?>][texto]" class="form-control mb-3 fw-bold" rows="2" required><?= htmlspecialchars($pregunta['pregunta']) ?></textarea>
                        
                        <div id="cont_resp_<?= $idP ?>">
                            <?php 
                            for ($i = 0; $i < 4; $i++): 
                                $respActual = $respuestas[$i] ?? ['id_respuesta' => 0, 'respuesta' => '', 'correcto' => 0];
                                $idR = $respActual['id_respuesta'];
                                $claseOculta = ($esVF && $i >= 2) ? 'd-none' : '';
                            ?>
                            <div class="respuesta-item input-group mb-2 <?= $claseOculta ?> slot-respuesta-<?= $i ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" 
                                           name="pregunta_existente[<?= $idP ?>][correcto]" 
                                           value="<?= $i ?>" 
                                           <?= $respActual['correcto'] ? 'checked' : '' ?> required>
                                </div>
                                <input type="hidden" name="pregunta_existente[<?= $idP ?>][respuestas][<?= $i ?>][id]" value="<?= $idR ?>">
                                <input type="text" name="pregunta_existente[<?= $idP ?>][respuestas][<?= $i ?>][texto]" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($respActual['respuesta']) ?>" 
                                       <?= ($esVF && $i >= 2) ? 'disabled' : '' ?>> 
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <button type="button" class="btn btn-outline-primary btn-add-question w-100 py-3 mb-4" onclick="agregarPregunta()">
                <i class="bi bi-plus-circle-fill display-6"></i><br>
                Agregar Nueva Pregunta
            </button>

            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save"></i> Guardar Todo
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    let contadorNuevas = 0;

    // --- FUNCIÓN PARA ELIMINAR PREGUNTAS EXISTENTES ---
    function marcarParaEliminar(idPregunta) {
        if (confirm("¿Estás seguro de que deseas eliminar esta pregunta y sus respuestas? Esta acción se aplicará al hacer clic en 'Guardar Todo'.")) {
            // 1. Ocultar visualmente la tarjeta
            const card = document.getElementById('card_pregunta_' + idPregunta);
            card.classList.add('pregunta-deleted');
            
            // 2. Agregar un input oculto al form para decirle a PHP que borre este ID
            const container = document.getElementById('inputs-eliminados');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'preguntas_eliminar[]'; // Array de IDs a eliminar
            input.value = idPregunta;
            container.appendChild(input);
        }
    }

    function agregarPregunta() {
        contadorNuevas++;
        const container = document.getElementById('contenedor-preguntas');
        // Calculamos el número visual (Total existentes visibles + nuevas)
        // Nota: Esto es solo visual, al guardar PHP reordenará los IDs internos
        const numeroVisual = document.querySelectorAll('.card-pregunta:not(.pregunta-deleted)').length + 1;

        const html = `
        <div class="card card-pregunta shadow-sm border-primary">
            <div class="card-header bg-primary bg-opacity-10 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary">Nueva Pregunta (${numeroVisual})</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" 
                               id="switch_new_${contadorNuevas}" 
                               name="pregunta_nueva[${contadorNuevas}][tipo]" 
                               value="1"
                               onchange="cambiarTipo(this, 'cont_resp_new_${contadorNuevas}')">
                        <label class="form-check-label small" for="switch_new_${contadorNuevas}">Verdadero/Falso</label>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.card').remove()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="card-body">
                <textarea name="pregunta_nueva[${contadorNuevas}][texto]" class="form-control mb-3 fw-bold" rows="2" placeholder="Escribe la pregunta aquí..." required></textarea>
                
                <div id="cont_resp_new_${contadorNuevas}">
                    ${generarInputRespuesta(contadorNuevas, 0, 'Opción 1 / Verdadero')}
                    ${generarInputRespuesta(contadorNuevas, 1, 'Opción 2 / Falso')}
                    ${generarInputRespuesta(contadorNuevas, 2, 'Opción 3')}
                    ${generarInputRespuesta(contadorNuevas, 3, 'Opción 4')}
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
    }

    function generarInputRespuesta(idPregunta, indexResp, placeholder) {
        return `
        <div class="respuesta-item input-group mb-2 slot-respuesta-${indexResp}">
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="radio" 
                       name="pregunta_nueva[${idPregunta}][correcto]" 
                       value="${indexResp}" required>
            </div>
            <input type="text" name="pregunta_nueva[${idPregunta}][respuestas][${indexResp}]" 
                   class="form-control" placeholder="${placeholder}">
        </div>`;
    }

    function cambiarTipo(checkbox, idContenedor) {
        const contenedor = document.getElementById(idContenedor);
        const slots3 = contenedor.querySelector('.slot-respuesta-2');
        const slots4 = contenedor.querySelector('.slot-respuesta-3');
        const input3 = slots3.querySelector('input[type="text"]');
        const input4 = slots4.querySelector('input[type="text"]');

        if (checkbox.checked) {
            slots3.classList.add('d-none');
            slots4.classList.add('d-none');
            input3.disabled = true;
            input4.disabled = true;
            
            const input1 = contenedor.querySelector('.slot-respuesta-0 input[type="text"]');
            const input2 = contenedor.querySelector('.slot-respuesta-1 input[type="text"]');
            if(input1.value === '') input1.value = 'Verdadero';
            if(input2.value === '') input2.value = 'Falso';
        } else {
            slots3.classList.remove('d-none');
            slots4.classList.remove('d-none');
            input3.disabled = false;
            input4.disabled = false;
        }
    }
</script>
<?php include_once __DIR__ . '/../code_general/footer.php'; ?>
</body>
</html>